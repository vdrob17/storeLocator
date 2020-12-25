<?php

namespace Drobko\Storelocator\Block;

use Drobko\Storelocator\Helper\Data as Helper;
use Drobko\Storelocator\Helper\Image as ImageHelper;
use Drobko\Storelocator\Model\ResourceModel\StoreLocator\CollectionFactory;
use Magento\Framework\View\Element\Template;

class StoreLocatorView extends Template
{
    protected $collectionFactory;
    protected $url;
    public $storeLocatorHelper;
    protected $imageHelper;

    public function __construct(
        Helper $storeLocatorHelper,
        Template\Context $context,
        ImageHelper $imageHelper,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->storeLocatorHelper = $storeLocatorHelper;
        $this->imageHelper = $imageHelper;
    }

    /**Get Stores
     * @return array
     */
    public function getIdStore()
    {
        return $this
            ->getRequest()
            ->getParam('id');
    }
    public function getStore()
    {
        return
            $this->collectionFactory
                ->create()
                ->addFieldToFilter('store_id', ['eq' => $this->getIdStore() ])
                ->getFirstItem();
    }
    public function getStoreImageUrl($store)
    {
        return $this->imageHelper->getImageUrl($store->getImage());
    }
}
