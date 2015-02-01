<?php
$installer = $this;

$attributeCode = 'customer_nick_name';

$installer->startSetup();

$installer->addAttribute('customer', 'customer_nick_name', array(
'label' => 'Customer Nick Name',
'visible' => true,
'required' => false,
'type' => 'text',
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
$attribute->setData('is_system', false);
$attribute->setData('is_unique', false);
$attribute->setData('sort_order', 250);
$attribute->setData('validate_rules', '');

$attribute->save();


$installer->endSetup();

