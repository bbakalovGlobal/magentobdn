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
//        $model = Mage::getResourceModel('guestbook/guestbookposts');;
//        var_dump($model);
        $this->loadLayout(); //загрузка обьектов для отображения
        $this->renderLayout(); //отображение этих обьектов
    }

    /**
     *
     *  @return array with message and content
     */
    public function createNewPostAction()
    {
        $today = date("Y-m-d H:i:s");
        $error = '';
        $result = array();
        $guestpost = Mage::getModel('guestbook/guestbookposts');
        $data = $this->getRequest()->getPost();
        if (!empty($data['name']) || !empty($data['comment'])) {
            $guestpost->setName($data['name']);
            $guestpost->setPost($data['comment']);
            $guestpost->setTimestamp($today);
            try {
                $guestpost->save();
            } catch(Exception $e) {
                $error = $e->getMessage();
            }

            $content = $this->getLayout()->createBlock('guestbook/posts')->setTemplate('new/guestbook/showall_page.phtml')->toHtml();

            if ($error == '') {
                $message = 'Saved successfully';
                $result = array('message' => $message, 'content' => $content);
            } else {
                $result = array('message' => $error, 'content' => $content);
            }

            die(json_encode($result));
        }
    }

//    public function testAction()
//    {
//        //echo 'Setup!';
//        $params = $this->getRequest()->getParams();
//        $blogpost = Mage::getModel('guestbook/guestbookposts');
//        echo("Loading the blogpost with an ID of ".$params['id']);
//        $blogpost->load($params['id']);
//        $data = $blogpost->getData();
//        var_dump($data);
//    }

    public function showAllPostsAction()
    {
//        echo 111;
//        $post = Mage::getModel('guestbook/guestbookposts');
//        echo 'post with ID ' . $post->getId() . ' created';
//        $this->loadLayout();
//        $posts = Mage::getModel('guestbook/guestbookposts')->getCollection();
//        foreach($posts as $guestpost){
//            echo 'Id:'.$guestpost->getId() .'<br>';
//            echo 'Name: ' . $guestpost->getName() . '<br>';
//            echo 'Post: ' .nl2br($guestpost->getPost()) . '<hr>';
//        }
        $this->renderLayout();
    }

    public function deletePostAction()
    {
//        $guestpost = Mage::getModel('guestbook/guestbookposts');
//        $guestpost->load(3); //нужный id записи
//        $guestpost->delete();
//        echo 'post with ID ' . $guestpost->getId() . ' was removed';
    }
}