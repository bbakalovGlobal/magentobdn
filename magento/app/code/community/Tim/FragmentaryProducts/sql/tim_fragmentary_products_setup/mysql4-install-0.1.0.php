<?php
/** @var $installer Mage_Catalog_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$installer->addAttribute(
    Mage_Catalog_Model_Product::ENTITY,
    'tim_fragments',
    array(
        'type' => 'text',
        'backend' => '',
        'frontend' => '',
        'label' => 'Tim Fragments',
        'input' => 'text',
        'class' => '',
        'source' => '',
        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'visible' => true,
        'required' => true,
        'user_defined' => false,
        'default' => '',
        'searchable' => false,
        'filterable' => false,
        'comparable' => false,
        'visible_on_front' => false,
        'unique' => false,
        'apply_to' => 'fragmentary',
        'is_configurable' => false,
        'used_in_product_listing' => true
    )
);

$fieldList = array(
    'price', 'group_price', 'special_price', 'special_from_date', 'special_to_date', 'tier_price', 'msrp_enabled',
    'msrp_display_actual_price_type', 'msrp', 'tax_class_id'
);
foreach ($fieldList as $field) {
    $applyTo = explode(',', $installer->getAttribute(Mage_Catalog_Model_Product::ENTITY, $field, 'apply_to'));
    if (!in_array('fragmentary', $applyTo)) {
        $applyTo[] = 'fragmentary';
        $installer->updateAttribute(Mage_Catalog_Model_Product::ENTITY, $field, 'apply_to', implode(',', $applyTo));
    }
}

$installer->endSetup();