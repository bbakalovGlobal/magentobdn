<?php

$installer = $this;

$installer->startSetup();

$attribute = array(
    'attribute_set' => 'Default',
    'group' => 'General',
    'label' => 'Field for fun comments',
    'visible' => true,
    'type' => 'varchar',
    'input' => 'text',
    'system' => true,
    'required' => false,
    'user_defined' => 1,
);

$installer->addAttribute('catalog_product', 'field_fun_comments', $attribute);

$installer->endSetup();