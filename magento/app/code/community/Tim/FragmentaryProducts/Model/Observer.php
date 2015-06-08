<?php

class Tim_FragmentaryProducts_Model_Observer
{
    /**
     * Update cart after save
     *
     * @param $observer
     */
    public function cartUpdate($observer)
    {
        $formData = Mage::app()->getRequest()->getParams();
        $cart = $observer->getData('cart');
        $quote = $cart->getData('quote');
        $items = $quote->getAllVisibleItems();
        foreach ($items as $item) {
            $qty = 0;
            if ($item->getProductType() == 'fragmentary') {
                // set item fragments from post
                if (isset($formData['fragment_values_'.$item->getId()])) {
                    $item->setTimFragments($formData['fragment_values_'.$item->getId()]);
                }
                $fragments = explode(',', $item->getTimFragments());
                if (is_array($fragments)) {
                    foreach ($fragments as $value) {
                        $qty = $qty + (int)$value;
                    }
                }
                $item->setQty($qty);
                $item->save();
            }
        }
        $quote->save();
        $quote->setTotalsCollectedFlag(false)->collectTotals();
    }
}