<?php
/**
 * Tim
 *
 * @category   Tim
 * @package    Tim_PriceRules
 * @copyright  Copyright (c) 2013 Tim (http://tim.pl)
 * @author     Bogdan Bakalov
 */
class Tim_PriceRules_Block_Onepage_Review_Info extends Mage_Checkout_Block_Onepage_Review_Info
{
    /**
     * Get item row html
     *
     * @param   Varien_Object $item
     * @return  string
     */
    public function getItemHtml(Varien_Object $item)
    {
        if (($item->getDiscountAmount() > 0) || ($item->getPrice() < $item->getProduct()->getPrice())) {
            if ($item->getDiscountAmount() > 0) {
                $discountPrice = $item->getPrice() - ($item->getDiscountAmount() / $item->getQty());
                $item->setCustomPrice($discountPrice);
                $item->setRowTotal($discountPrice * $item->getQty());
            } else {
                $item->setCustomPrice($item->getPrice());
                $item->setRowTotal($item->getPrice() * $item->getQty());
            }
            $item->setOriginalRowTotal($item->getProduct()->getPrice() * $item->getQty());
        }
        $type = $this->_getItemType($item);

        $block = $this->getItemRenderer($type)
            ->setItem($item);
        $this->_prepareItem($block);
        return $block->toHtml();
    }
}