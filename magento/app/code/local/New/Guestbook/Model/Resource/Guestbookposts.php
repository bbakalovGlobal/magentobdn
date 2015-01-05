<?php
class New_Guestbook_Model_Resource_Guestbookposts extends Mage_Core_Model_Resource_Db_Abstract{
    protected function _construct()
    {
        $this->_init('guestbook/guestbookposts', 'post_id');
    }
}