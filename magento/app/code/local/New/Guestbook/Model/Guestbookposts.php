<?php
class New_Guestbook_Model_Guestbookposts extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('guestbook/guestbookposts');
    }
    public function run()
    {
        $guestpost = Mage::getModel('guestbook/guestbookposts');
        $guestpost->setName("cron wrote it");
        $guestpost->save();
        var_dump("OK");
    }
}