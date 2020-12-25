<?php


namespace Drobko\Storelocator\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class StoreLocator extends AbstractDb
{
    /**
     * Initialize resource model
     * @return void
     */
    protected function _construct()
    {
        $this->_init('stores_list', 'store_id');
    }
}
