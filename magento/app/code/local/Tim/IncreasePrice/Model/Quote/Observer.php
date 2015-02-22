<?php
/**
 * Tim
 *
 * @category   Tim
 * @package    Tim_IncreasePrice
 * @copyright  Copyright (c) 2015 Tim (http://tim.pl)
 * @author     Bogdan Bakalov
 */
class Tim_IncreasePrice_Model_Quote_Observer
{
    public function increasePrice($observer)
    {
        $quote = $observer->getQuote();
        $item = $observer->getItem();
        $rule = $observer->getRule();
        $result = $observer->getResult();
        if ($rule->getIsIncrease() == 1) {
            $amount = $rule->getDiscountAmount();
            $item->setPrice($item->getBasePrice() + $amount);
            $item->setRowTotal(($item->getBasePrice() + $amount) * $item->getQty());
            $item->setBaseRowTotal(($item->getBasePrice() + $amount) * $item->getQty());
            $item->setSubtotal(($item->getBasePrice() + $amount) * $item->getQty());
            $item->setBaseSubtotal(($item->getBasePrice() + $amount) * $item->getQty());
            $item->setBasePrice($item->getBasePrice() + $amount);
            $result->setDiscountAmount(0);
        }
        return $this;
    }

    public function salesQuoteCollectTotalsBefore($observer)
    {
//        foreach ($observer->getEvent()->getQuote()->getAllItems() as $item) {
//
//        }
    }
}