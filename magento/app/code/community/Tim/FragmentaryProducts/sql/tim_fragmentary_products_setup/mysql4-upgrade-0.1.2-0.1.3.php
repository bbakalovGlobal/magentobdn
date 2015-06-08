<?php

$installer = $this;

$installer->startSetup();

$installer->run("
    ALTER TABLE `{$installer->getTable('sales_flat_quote_item')}` CHANGE `fragments` `tim_fragments` VARCHAR(255);
");

$installer->endSetup();