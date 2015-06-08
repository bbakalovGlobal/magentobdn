<?php

$installer = $this;

$installer->startSetup();
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

$staticBlock = array(
    'title' => 'calculator_fragments_description',
    'identifier' => 'calculator_fragments_description',
    'content' => 'Example for description in fragmentary products',
    'is_active' => 1,
    'stores' => array(0),
);

Mage::getModel('cms/block')->setData($staticBlock)->save();

$installer->endSetup();