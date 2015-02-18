<?php
ini_set('display_errors', 1);
require '../../app/Mage.php';
Mage::app();

$process = Mage::getModel('tim_resaveproducts/adminhtml_resave');
$process->run();
exit;
