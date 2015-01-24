<?php

class DS_News_Block_Adminhtml_Guestbook_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected function _construct()
    {
        $this->_blockGroup = 'guestbook';
        $this->_controller = 'adminhtml_guestbook';
    }

    public function getHeaderText()
    {
        $helper = Mage::helper('guestbook');
        $model = Mage::registry('current_news');

        if ($model->getId()) {
            return $helper->__("Edit News item '%s'", $this->escapeHtml($model->getTitle()));
        } else {
            return $helper->__("Add News item");
        }
    }

}