<?php
/**
 * Tim
 *
 * @category   Tim
 * @package    Tim_ResaveProducts
 * @copyright  Copyright (c) 2015 Tim (http://tim.pl)
 * @author     Bogdan Bakalov
 */
class Tim_ResaveProducts_Model_Adminhtml_Resave extends Mage_Core_Model_Abstract
{
    /**
     * @var int
     */
    protected $lastItem;

    /**
     * Run Resave Products process
     */
    public function run()
    {
        $this->lastItem = 0;
        $collectionCount = Mage::getModel('tim_resaveproducts/adminhtml_product')->getCountCollection();
        $count = 1;
        while ($collection = Mage::getModel('tim_resaveproducts/adminhtml_product')->getProductCollection($this->lastItem)) {
            if ($collection->getSize() < 1 || is_null($collection)) {
                break;
            }
            foreach ($collection as $item) {
                try {
                    $item->save();
                    $this->lastItem = $item->getId();
                    $this->progressBar($count, $collectionCount);
                    $count++;
                } catch (Exception $e) {
                    echo sprintf('Unable to save product %s', $item->getId());
                    //$this->_getSession()->addError(sprintf('Unable to save product %s', $item->getId()));
                    //Mage::throwException($e->getMessage());
                    echo $e->getMessage();
                    exit;
                }
                $item = null;
                unset($item);
            }
            $collection = array();
            unset($collection);
        }

        echo PHP_EOL;
        echo sprintf('%s products were resaved', $collectionCount);
        echo PHP_EOL;
        //$this->_getSession()->addSuccess(sprintf('%s products where resaved', $count));
        //$this->_redirectReferer();
        exit;
    }

    /**
     * @param int $done
     * @param int $total
     */
    public function progressBar($done, $total){
        $perc = ($done / $total) * 1000;
        $bar  = "[" . str_repeat("=", $perc);
        $bar  = substr($bar, 0, strlen($bar) - 1) . ">"; // Change the last = to > for aesthetics
        $bar .= str_repeat(" ", 1000 - $perc) . "] - $perc% - $done/$total";
        echo "$bar\r"; // Note the \r. Put the cursor at the beginning of the line
    }
}