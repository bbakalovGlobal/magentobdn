<?php
class New_Guestbook_Block_Adminhtml_Guestbook extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();

        $helper = Mage::helper('guestbook');
        $this->_blockGroup = 'guestbook';
        $this->_controller = 'adminhtml_guestbook';

        $this->_headerText = $helper->__('News Management');
        $this->_addButtonLabel = $helper->__('Add News');

    }

}