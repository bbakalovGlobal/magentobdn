<?php
/**
 * Tim
 *
 * @category   Tim
 * @package    Tim_IncreasePrice
 * @copyright  Copyright (c) 2015 Tim (http://tim.pl)
 * @author     Bogdan Bakalov
 */
class Tim_IncreasePrice_Block_Adminhtml_Catalog_Edit_Tab_Actions
    extends Mage_Adminhtml_Block_Promo_Catalog_Edit_Tab_Actions
{
    protected function _prepareForm()
    {
        parent::_prepareForm();
        $model = Mage::registry('current_promo_catalog_rule');

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('rule_');

        $fieldset = $form->addFieldset('action_fieldset', array(
                'legend' => Mage::helper('catalogrule')->__('Update Prices Using the Following Information')
            )
        );

        $fieldset->addField('simple_action', 'select', array(
            'label'     => Mage::helper('catalogrule')->__('Apply'),
            'name'      => 'simple_action',
            'options'   => array(
                'by_percent'    => Mage::helper('catalogrule')->__('By Percentage of the Original Price'),
                'by_fixed'      => Mage::helper('catalogrule')->__('By Fixed Amount'),
                'to_percent'    => Mage::helper('catalogrule')->__('To Percentage of the Original Price'),
                'to_fixed'      => Mage::helper('catalogrule')->__('To Fixed Amount'),
            ),
        ));

        $fieldset->addField('discount_amount', 'text', array(
            'name'      => 'discount_amount',
            'required'  => true,
            'class'     => 'validate-not-negative-number',
            'label'     => Mage::helper('catalogrule')->__('Discount Amount'),
        ));

        $fieldset->addField('is_increase', 'select', array(
            'name'      => 'is_increase',
            'label'     => Mage::helper('catalogrule')->__('Increase Amount'),
            'title'     => Mage::helper('catalogrule')->__('Increase Amount'),
            'values'    => array(
                0 => Mage::helper('catalogrule')->__('No'),
                1 => Mage::helper('catalogrule')->__('Yes')
            )
        ));

        $fieldset->addField('sub_is_enable', 'select', array(
            'name'      => 'sub_is_enable',
            'label'     => Mage::helper('catalogrule')->__('Enable Discount\Increase to Subproducts'),
            'title'     => Mage::helper('catalogrule')->__('Enable Discount\Increase to Subproducts'),
            'onchange'  => 'hideShowSubproductOptions(this);',
            'values'    => array(
                0 => Mage::helper('catalogrule')->__('No'),
                1 => Mage::helper('catalogrule')->__('Yes')
            )
        ));

        $fieldset->addField('sub_simple_action', 'select', array(
            'label'     => Mage::helper('catalogrule')->__('Apply'),
            'name'      => 'sub_simple_action',
            'options'   => array(
                'by_percent'    => Mage::helper('catalogrule')->__('By Percentage of the Original Price'),
                'by_fixed'      => Mage::helper('catalogrule')->__('By Fixed Amount'),
                'to_percent'    => Mage::helper('catalogrule')->__('To Percentage of the Original Price'),
                'to_fixed'      => Mage::helper('catalogrule')->__('To Fixed Amount'),
            ),
        ));

        $fieldset->addField('sub_discount_amount', 'text', array(
            'name'      => 'sub_discount_amount',
            'required'  => true,
            'class'     => 'validate-not-negative-number',
            'label'     => Mage::helper('catalogrule')->__('Discount Amount'),
        ));

        $fieldset->addField('stop_rules_processing', 'select', array(
            'label'     => Mage::helper('catalogrule')->__('Stop Further Rules Processing'),
            'title'     => Mage::helper('catalogrule')->__('Stop Further Rules Processing'),
            'name'      => 'stop_rules_processing',
            'options'   => array(
                '1' => Mage::helper('catalogrule')->__('Yes'),
                '0' => Mage::helper('catalogrule')->__('No'),
            ),
        ));

        $form->setValues($model->getData());

        //$form->setUseContainer(true);

        if ($model->isReadonly()) {
            foreach ($fieldset->getElements() as $element) {
                $element->setReadonly(true, true);
            }
        }

        $this->setForm($form);

        return $this;
    }
}