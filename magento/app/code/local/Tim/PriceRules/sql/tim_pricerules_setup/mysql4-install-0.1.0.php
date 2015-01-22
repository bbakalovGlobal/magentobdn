<?php

$installer = $this;
$installer->startSetup();

$installer->run("
    ALTER TABLE {$this->getTable('sales/order_item')}
        ADD `tim_clearancesales_parameters` TEXT NULL,
        ADD `tim_custom_parameters` TEXT NULL;
");

$installer->endSetup();