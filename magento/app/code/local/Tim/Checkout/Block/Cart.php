<?php
/**
 * Tim
 *
 * @category   Tim
 * @package    Tim_Checkout
 * @copyright  Copyright (c) 2013 Tim (http://tim.pl)
 * @author     Jacek Kiernicki (j.kiernicki@tim.pl)
 */

class Tim_Checkout_Block_Cart extends Mage_Checkout_Block_Cart
{
    /**
     * Get item row html
     *
     * @param   Mage_Sales_Model_Quote_Item $item
     * @return  string
     */
    public function getItemHtml(Mage_Sales_Model_Quote_Item $item)
    {
        $discountPrice = $item->getPrice() - ($item->getDiscountAmount()/$item->getQty());
        $item->setRowTotal($discountPrice * $item->getQty());
        $renderer = $this->getItemRenderer($item->getProductType())->setItem($item);
        return $renderer->toHtml();
    }
}