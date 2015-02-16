<?php
/**
 * Tim
 *
 * @category   Tim
 * @package    Tim_ResaveProducts
 * @copyright  Copyright (c) 2015 Tim (http://tim.pl)
 * @author     Bogdan Bakalov
 */
class Tim_ResaveProducts_Block_Adminhtml_Button extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->setElement($element);
        $url = Mage::helper("adminhtml")->getUrl('tim_resaveproducts/adminhtml_index');

        $html = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setType('button')
            ->setClass('scalable')
            ->setLabel('Run')
            ->setOnClick("setLocation('$url')")
            ->toHtml();

        return $html;
    }
}