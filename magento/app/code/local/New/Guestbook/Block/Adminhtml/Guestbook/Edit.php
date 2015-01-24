<?php

class New_Guestbook_Block_Adminhtml_Guestbook_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected function _construct()
    {
        $this->_blockGroup = 'guestbook';
        $this->_controller = 'adminhtml_guestbook';
    }

    public function getHeaderText()
    {
        $helper = Mage::helper('guestbook');
        $model = Mage::registry('current_posts');

        if ($model->getId()) {
            return $helper->__("Edit comment with id '%s'", $this->escapeHtml($model->getId()));
        } else {
            return $helper->__("Add comment");
        }
    }

}