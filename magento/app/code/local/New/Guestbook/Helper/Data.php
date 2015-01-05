<?php
class New_Guestbook_Helper_Data extends Mage_Core_Helper_Abstract
{
    function __construct(){
    }

    public function getGuestbookUrl()
    {
        return $this->_getUrl('guestbook');
    }
    public function getTestUrl()
    {
        return $this->_getUrl('test/test');
    }
}