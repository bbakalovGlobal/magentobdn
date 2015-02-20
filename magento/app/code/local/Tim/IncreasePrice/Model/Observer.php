<?php
/**
 * Tim
 *
 * @category   Tim
 * @package    Tim_IncreasePrice
 * @copyright  Copyright (c) 2015 Tim (http://tim.pl)
 * @author     Bogdan Bakalov
 */
class Tim_IncreasePrice_Model_Observer extends Mage_CatalogRule_Model_Observer
{
    /**
     * Apply catalog price rules to product on frontend
     *
     * @return Mage_CatalogRule_Model_Observer
     */
    public function processFrontFinalPrice($observer)
    {
        $product = $observer->getEvent()->getProduct();
        $pId = $product->getId();
        $storeId = $product->getStoreId();
        if ($observer->hasDate()) {
            $date = $observer->getEvent()->getDate();
        } else {
            $date = Mage::app()->getLocale()->storeTimeStamp($storeId);
        }
        if ($observer->hasWebsiteId()) {
            $wId = $observer->getEvent()->getWebsiteId();
        } else {
            $wId = Mage::app()->getStore($storeId)->getWebsiteId();
        }
        if ($observer->hasCustomerGroupId()) {
            $gId = $observer->getEvent()->getCustomerGroupId();
        } elseif ($product->hasCustomerGroupId()) {
            $gId = $product->getCustomerGroupId();
        } else {
            $gId = Mage::getSingleton('customer/session')->getCustomerGroupId();
        }
        $key = "$date|$wId|$gId|$pId";
        if (!isset($this->_rulePrices[$key])) {
            $rulePrice = Mage::getResourceModel('catalogrule/rule')
                ->getRulePrice($date, $wId, $gId, $pId);
            $this->_rulePrices[$key] = $rulePrice;
        }
        if ($this->_rulePrices[$key]!==false) {
// THIS LINE WAS CHANGED
            $finalPrice = $this->_rulePrices[$key];
            $product->setFinalPrice($finalPrice);
        }
        return $this;
    }
    /**
     * Apply catalog price rules to product in admin
     *
     * @return Mage_CatalogRule_Model_Observer
     */
    public function processAdminFinalPrice($observer)
    {
        $product = $observer->getEvent()->getProduct();
        $storeId = $product->getStoreId();
        $date = Mage::app()->getLocale()->storeDate($storeId);
        $key = false;
        if ($ruleData = Mage::registry('rule_data')) {
            $wId = $ruleData->getWebsiteId();
            $gId = $ruleData->getCustomerGroupId();
            $pId = $product->getId();
            $key = "$date|$wId|$gId|$pId";
        }
        elseif ($product->getWebsiteId() != null && $product->getCustomerGroupId() != null) {
            $wId = $product->getWebsiteId();
            $gId = $product->getCustomerGroupId();
            $pId = $product->getId();
            $key = "$date|$wId|$gId|$pId";
        }
        if ($key) {
            if (!isset($this->_rulePrices[$key])) {
                $rulePrice = Mage::getResourceModel('catalogrule/rule')
                    ->getRulePrice($date, $wId, $gId, $pId);
                $this->_rulePrices[$key] = $rulePrice;
            }
            if ($this->_rulePrices[$key]!==false) {
// THIS LINE WAS CHANGED
                $finalPrice = $this->_rulePrices[$key];
                $product->setFinalPrice($finalPrice);
            }
        }
        return $this;
    }
}