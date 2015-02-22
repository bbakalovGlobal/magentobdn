<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$ruleProductTable = $installer->getTable('salesrule/rule');
$columnOptions = array(
    'TYPE' => Varien_Db_Ddl_Table::TYPE_INTEGER,
    'NULLABLE' => false,
    'DEFAULT' => 0,
    'COMMENT' => 'Is Increase',
);
$installer->getConnection()->addColumn($ruleProductTable, 'is_increase', $columnOptions);
$installer->endSetup();
