<?php
class New_Guestbook_Adminhtml_GuestbookController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout()->_setActiveMenu('guestbook');
        $this->_addContent($this->getLayout()->createBlock('guestbook/adminhtml_guestbook'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {

        $id = (int) $this->getRequest()->getParam('id');
        Mage::register('current_posts', Mage::getModel('guestbook/guestbookposts')->load($id));

        $this->loadLayout()->_setActiveMenu('guestbook');
        $this->_addContent($this->getLayout()->createBlock('guestbook/adminhtml_guestbook_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            try {
                $model = Mage::getModel('guestbook/guestbookposts');
                $model->setData($data)->setId($this->getRequest()->getParam('id'));
                if(!$model->getCreated()){
                    $model->setCreated(now());
                }
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Comment was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('id')
                ));
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('guestbook/guestbookposts')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Comment was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $posts = $this->getRequest()->getParam('posts', null); // param 'posts' take from $this->getMassactionBlock()->setFormFieldName('posts');

        if (is_array($posts) && sizeof($posts) > 0) {
            try {
                foreach ($posts as $id) {
                    Mage::getModel('guestbook/guestbookposts')->setId($id)->delete();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d comment(s) have been deleted', sizeof($posts)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select comment(s)'));
        }
        $this->_redirect('*/*');
    }

}