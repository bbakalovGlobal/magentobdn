<?php
class New_Guestbook_Adminhtml_GuestbookController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('guestbook');

        $contentBlock = $this->getLayout()->createBlock('guestbook/adminhtml_guestbook');
        $this->_addContent($contentBlock);
        $this->renderLayout();
    }

}