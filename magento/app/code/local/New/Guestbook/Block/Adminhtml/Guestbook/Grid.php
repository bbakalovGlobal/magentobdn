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

        $this->addColumn('post', array(
            'header' => $helper->__('Comment'),
            'index' => 'post',
            'type' => 'text',
        ));

        $this->addColumn('timestamp', array(
            'header' => $helper->__('Created'),
            'index' => 'timestamp',
            'type' => 'date',
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('post_id');
        $this->getMassactionBlock()->setFormFieldName('posts');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => $this->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
        ));
        return $this;
    }

    public function getRowUrl($model)
    {
        return $this->getUrl('*/*/edit', array(
            'id' => $model->getId(),
        ));
    }

}