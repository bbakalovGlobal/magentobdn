<?php

class New_Guestbook_IndexController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
//        $test = Mage::helper('guestbook')->getGuestbookUrl();
//        var_dump($test);
//        die();
        /*$helper = Mage::helper('customer/data');
        var_dump($helper);*/

        $this->loadLayout(); //загрузка обьектов для отображения
        $this->renderLayout(); //отображение этих обьектов
    }

    public function testAction() {
        echo 'Setup!';
    }

//    public function testModelAction()
//    {
//        $guespost = Mage::getModel('guestbook/guestbookpost');
//        var_dump($guespost);
//    }

}