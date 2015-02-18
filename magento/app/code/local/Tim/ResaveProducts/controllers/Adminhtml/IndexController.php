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
     * Run Resave Products process
     */
    public function indexAction()
    {
        Mage::getModel('tim_resaveproducts/adminhtml_resave')->run();
    }
}