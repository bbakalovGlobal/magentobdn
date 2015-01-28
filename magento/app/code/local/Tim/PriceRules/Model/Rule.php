<?php
/**
 * Tim
 *
 * @category   Tim
 * @package    Tim_PriceRules
 * @copyright  Copyright (c) 2015 Tim (http://tim.pl)
 * @author     Bogdan Bakalov
 */
class Tim_PriceRules_Model_Rule extends Mage_Core_Model_Abstract
{
    /**
     * Adapter init
     *
     * @return mixed
     */
    protected function _getReadAdapter()
    {
        return Mage::getSingleton('core/resource')->getConnection('read');
    }

    /**
     * @param Mage_Catalog_Model_Product $product
     * @return bool
     */
    public function isOldPrice(Mage_Catalog_Model_Product $product)
    {
        $productId  = $product->getId();
        $storeId    = $product->getStoreId();
        $websiteId  = Mage::app()->getStore($storeId)->getWebsiteId();
        if ($product->hasCustomerGroupId()) {
            $customerGroupId = $product->getCustomerGroupId();
        } else {
            $customerGroupId = Mage::getSingleton('customer/session')->getCustomerGroupId();
        }
        $dateTs = Mage::app()->getLocale()->date()->getTimestamp();
        $productRule = $this->getRuleFromProduct($dateTs, $websiteId, $customerGroupId, $productId);
        $productRule = new Varien_Object($productRule);
        if ($productRule->getRuleId()) {
            $rule = $this->getHideOldPrice($productRule->getRuleId());
            $rule = new Varien_Object($rule);
            if ($rule->getHideOldPrice()) {
                return ((int)$rule->getHideOldPrice() == 1) ? false : true;
            }
        }
        return true;
    }

    /**
     * Get active rule data based on few filters
     *
     * @param int|string $date
     * @param int $websiteId
     * @param int $customerGroupId
     * @param int $productId
     * @return array
     */
    public function getRuleFromProduct($date, $websiteId, $customerGroupId, $productId)
    {
        $adapter = $this->_getReadAdapter();
        if (is_string($date)) {
            $date = strtotime($date);
        }
        $select = $adapter->select()
            ->from($adapter->getTableName('catalogrule_product'))
            ->where('website_id = ?', $websiteId)
            ->where('customer_group_id = ?', $customerGroupId)
            ->where('product_id = ?', $productId)
            ->where('from_time = 0 or from_time < ?', $date)
            ->where('to_time = 0 or to_time > ?', $date)
            ->order('sort_order ASC');

        return $adapter->raw_fetchRow($select);
    }

    /**
     * Get hide_old_price for specific rule
     *
     * @param int $ruleId
     * @return array
     */
    public function getHideOldPrice($ruleId)
    {
        $adapter = $this->_getReadAdapter();
        $select = $adapter->select()->from($adapter->getTableName('catalogrule'), 'hide_old_price');
        $select->where('rule_id = ?', $ruleId);
        return $adapter->raw_fetchRow($select);
    }
}