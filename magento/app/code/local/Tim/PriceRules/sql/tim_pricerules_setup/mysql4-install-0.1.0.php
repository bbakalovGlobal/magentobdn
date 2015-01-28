<?php

$installer = $this;
$installer->startSetup();

$installer->run("
    ALTER TABLE {$this->getTable('catalogrule/rule')}
        ADD `hide_old_price` smallint UNSIGNED NOT NULL DEFAULT 0;
");

$installer->endSetup();