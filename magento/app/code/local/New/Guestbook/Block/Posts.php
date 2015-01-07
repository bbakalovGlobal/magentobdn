<?php
class New_Guestbook_Block_Posts extends Mage_Core_Block_Template
{

    public function getPostsCollection()
    {
        $posts = Mage::getModel('guestbook/guestbookposts')->getCollection();
        $posts->setOrder('post_id', 'DESC');
        return $posts;
    }
}