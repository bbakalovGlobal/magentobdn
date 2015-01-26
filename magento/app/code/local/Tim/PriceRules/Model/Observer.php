<?php
/**
 * Tim
 *
 * @category   Tim
 * @package    Tim_PriceRules
 * @copyright  Copyright (c) 2015 Tim (http://tim.pl)
 * @author     Bogdan Bakalov
 */
class Tim_PriceRules_Model_Observer
{
    /**
     * @param Mage_Sales_Model_Order $observer
     * @return $this
     */
    public function updateOrderPrice($observer)
    {
        $order = $observer->getOrder();
        foreach ($order->getAllItems() as $item) {
            $discountPrice = $item->getPrice() - ($item->getDiscountAmount()/$item->getQtyOrdered());
            $item->setPrice($discountPrice);
            $item->setBasePrice($discountPrice);
        }
        return $this;
    }
}