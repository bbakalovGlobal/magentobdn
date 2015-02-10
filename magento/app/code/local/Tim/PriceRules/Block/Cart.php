<?php
/**
 * Tim
 *
 * @category   Tim
 * @package    Tim_PriceRules
 * @copyright  Copyright (c) 2013 Tim (http://tim.pl)
 * @author     Bogdan Bakalov
 */
class Tim_PriceRules_Block_Cart extends Mage_Checkout_Block_Cart
{
    /**
     * Get item row html
     *
     * @param   Mage_Sales_Model_Quote_Item $item
     * @return  string
     */
    public function getItemHtml(Mage_Sales_Model_Quote_Item $item)
    {
        if ($item->getPrice() < $item->getProduct()->getPrice()) {
            $item->setCustomPrice($item->getPrice());
            $item->setOriginalRowTotal($item->getProduct()->getPrice() * $item->getQty());
            $item->setRowTotal($item->getPrice() * $item->getQty());
        }
        $renderer = $this->getItemRenderer($item->getProductType())->setItem($item);
        return $renderer->toHtml();
    }
}