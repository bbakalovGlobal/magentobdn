<?php

class New_Guestbook_Block_Adminhtml_Guestbook_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('guestbook/guestbookposts')->getCollection();
        //var_dump($collection);exit;
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $helper = Mage::helper('guestbook');
        $this->addColumn('post_id', array(
            'header' => $helper->__('Post ID'),
            'index' => 'post_id'
        ));

        $this->addColumn('name', array(
            'header' => $helper->__('Name'),
            'index' => 'name',
            'type' => 'text',
        ));

        $this->addColumn('timestamp', array(
            'header' => $helper->__('Created'),
            'index' => 'timestamp',
            'type' => 'date',
        ));

        return parent::_prepareColumns();
    }

}