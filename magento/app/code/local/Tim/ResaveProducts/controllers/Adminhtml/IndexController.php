<?php
/**
 * Tim
 *
 * @category   Tim
 * @package    Tim_ResaveProducts
 * @copyright  Copyright (c) 2015 Tim (http://tim.pl)
 * @author     Bogdan Bakalov
 */
class Tim_ResaveProducts_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @var int
     */
    protected $lastItem;

    /**
     * Run Resave Products process
     */
    public function indexAction()
    {
        $this->lastItem = 0;
        while ($collection = Mage::getModel('tim_resaveproducts/adminhtml_product')->getCollection($this->lastItem)) {
            if ($collection->getSize() < 1 || is_null($collection)) {
                break;
            }
            foreach ($collection as $item) {
                try {
                    $item->save();
                    $this->lastItem = $item->getId();
                } catch (Exception $e) {
                    $this->_getSession()->addError(sprintf('Unable to save product %s', $item->getId()));
                    Mage::throwException($e->getMessage());
                }
                $item = null;
                unset($item);
            }
            $collection = array();
            unset($collection);
        }
        $count = Mage::getModel('tim_resaveproducts/adminhtml_product')->getCountCollection();
        $this->_getSession()->addSuccess(sprintf('%s products where resaved', $count));
        $this->_redirectReferer();
    }
}