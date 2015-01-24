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
        Mage::register('current_news', Mage::getModel('guestbook/guestbookposts')->load($id));

        $this->loadLayout()->_setActiveMenu('guestbook');
        $this->_addContent($this->getLayout()->createBlock('guestbook/adminhtml_guestbook_edit')); // обрати внимание
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

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('News was saved successfully'));
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
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('News was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $news = $this->getRequest()->getParam('news', null); // откуда берёт параметр news
        if (is_array($news) && sizeof($news) > 0) {
            try {
                foreach ($news as $id) {
                    Mage::getModel('guestbook/guestbookposts')->setId($id)->delete();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d news have been deleted', sizeof($news)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select comment(s)'));
        }
        $this->_redirect('*/*');
    }

}