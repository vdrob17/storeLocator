<?php

namespace Drobko\Storelocator\Model\ResourceModel\StoreLocator;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'store_id';
    protected function _construct()
    {
        $this->_init(\Drobko\Storelocator\Model\StoreLocator::class, \Drobko\Storelocator\Model\ResourceModel\StoreLocator::class);
    }
}
