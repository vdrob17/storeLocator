<?php

namespace Drobko\Storelocator\Observer;

use Drobko\Storelocator\Helper\Data as Helper;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class StorelocatorBeforeSave implements ObserverInterface
{
    protected $helper;

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        $storeLocator = $observer->getEvent()->getObject();
        if ($storeLocator->getLongitude() == null || $storeLocator->getLatitude() == null) {
            $address = $storeLocator->getZip() . ' ' . $storeLocator->getCountry() . ' ' . $storeLocator->getState() . ' ' . $storeLocator->getCity() . ' ' . $storeLocator->getAddress();
            if ($coordinates = $this->helper->getGeo($address)) {
                $storeLocator->setLatitude($coordinates[0]);
                $storeLocator->setLongitude($coordinates[1]);
            }
        }
    }
}
