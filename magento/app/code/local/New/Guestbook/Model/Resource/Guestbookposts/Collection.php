<?php
class New_Guestbook_Model_Resource_Guestbookposts_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {
    protected function _construct()
    {
        $this->_init('guestbook/guestbookposts');
    }
}