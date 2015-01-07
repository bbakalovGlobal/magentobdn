<?php
class New_Guestbook_Block_News extends Mage_Core_Block_Template
{

    public function getPostsCollection()
    {
        $newsCollection = Mage::getModel('guestbook/guestbookposts')->getCollection();
        return $newsCollection;
    }
    public function _toHtml()
    {
        return '<h1>BLABLABLA</h1>';
    }

}