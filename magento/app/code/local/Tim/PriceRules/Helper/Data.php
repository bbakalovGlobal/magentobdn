<?php
/**
 * Tim
 *
 * @category   Tim
 * @package    Tim_PriceRules
 * @copyright  Copyright (c) 2015 Tim (http://tim.pl)
 * @author     Bogdan Bakalov
 */
class Tim_PriceRules_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_CART_DISCOUNT_RULE = 'checkout/cart/show_old_price';

    public function isShowOldPrice()
    {
        return (bool) Mage::getStoreConfig(self::XML_CART_DISCOUNT_RULE);
    }
}