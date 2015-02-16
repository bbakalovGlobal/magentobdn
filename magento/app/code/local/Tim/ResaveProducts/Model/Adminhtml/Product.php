<?php
/**
 * Tim
 *
 * @category   Tim
 * @package    Tim_ResaveProducts
 * @copyright  Copyright (c) 2015 Tim (http://tim.pl)
 * @author     Bogdan Bakalov
 */
class Tim_ResaveProducts_Model_Adminhtml_Product extends Mage_Core_Model_Abstract
{
    const XML_COLLECTION_LIMIT = 100;

    /**
     * @return int
     */
    public function getCountCollection()
    {
        return Mage::getModel('catalog/product')->getCollection()->getSize();
    }

    /**
     * @param int $lastItem
     * @return Mage_Catalog_Model_Resource_Product_Collection
     */
    public function getCollection($lastItem)
    {
        $collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('entity_id', array('gt' => $lastItem));
        $collection->getSelect()->limit(self::XML_COLLECTION_LIMIT);
        return $collection;
    }
}