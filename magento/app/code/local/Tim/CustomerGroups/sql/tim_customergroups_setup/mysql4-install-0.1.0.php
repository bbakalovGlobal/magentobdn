<?php
$installer = $this;

$attributeCode = 'customer_age';

$installer->startSetup();

$installer->addAttribute('customer', 'customer_age', array(
    'label' => 'Customer Age',
    'visible' => true,
    'required' => false,
    'type' => 'int',
    'input' => 'text',
    'global' => 1,
    'user_defined' => 1,
));
$eavConfig = Mage::getSingleton('eav/config');

$usedInForms = array(
    'customer_account_edit',
    'adminhtml_customer'
);
$attribute = $eavConfig->getAttribute('customer', $attributeCode);
$attribute->setData('is_used_for_customer_segment', true);
$attribute->setData('used_in_forms', $usedInForms);
$attribute->setData('backend_type', 'int');
$attribute->setData('is_user_defined', true);
$attribute->setData('is_system', false);
$attribute->setData('is_visible', true);
$attribute->setData('is_unique', false);
$attribute->setData('sort_order', 250);
$attribute->setData('validate_rules', '');

$attribute->save();


$installer->endSetup();