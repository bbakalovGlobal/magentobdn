<?php
/**
 * Tim
 *
 * @category   Tim
 * @package    Tim_CustomerGroups
 * @copyright  Copyright (c) 2015 Tim (http://tim.pl)
 * @author     Bogdan Bakalov
 */
class Tim_CustomerGroups_Model_Observer
{
    public function addSuffixFromGroup($observer)
    {
        $customer = $observer->getCustomer();
        $groupId = $customer->getData('group_id');

        $model = Mage::getSingleton('customer/customer_attribute_source_group');
        $options = $model->getAllOptions();
        foreach ($options as $value) {
            if ($groupId == $value['value']) {
                $groupLable = $value['label'];
            }
        }

        $customer->setData("suffix", $groupLable);

        return $this;
    }
}