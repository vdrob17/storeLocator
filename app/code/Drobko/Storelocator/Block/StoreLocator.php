<?php

namespace Drobko\Storelocator\Block;

use Drobko\Storelocator\Helper\Data as Helper;
use Drobko\Storelocator\Helper\Image as ImageHelper;
use Drobko\Storelocator\Model\ResourceModel\StoreLocator\CollectionFactory;
use Drobko\Storelocator\Helper\Url;
use Magento\Framework\View\Element\Template;

class StoreLocator extends Template
{
    protected $collectionFactory;
    protected $url;
    public $storeLocatorHelper;
    protected $imageHelper;

    public function __construct(
        Helper $storeLocatorHelper,
        ImageHelper $imageHelper,
        Template\Context $context,
        CollectionFactory $collectionFactory,
        Url $url,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->url = $url;
        $this->storeLocatorHelper = $storeLocatorHelper;
        $this->imageHelper = $imageHelper;
    }

    /**Get Stores
     * @return array
     */
    public function getNameForSearch()
    {
        if ($this->getRequest()->getParam('name_post')) {
            return $this->getRequest()->getParam('name_post');
        } else {
            return $this->getRequest()->getParam('name');
        }
    }

    public function getNumPage()
    {
        return $this
            ->getRequest()
            ->getParam('p');
    }

    public function getStoresList()
    {
        $stores = $this->collectionFactory
            ->create()
            ->setOrder('name', \Zend_Db_Select::SQL_ASC)
            ->addFieldToFilter('visible', ['eq' => 1]);
        if ($name = $this->getNameForSearch()) {
            $stores->addFieldToFilter('name', [
                ['like' => '% ' . $name . ' %'], //spaces on each side
                ['like' => '% ' . $name], //space before and ends with $needle
                ['like' => $name . ' %'],
                ['like' => $name]// starts with needle and space after
            ]);
        }
        return $stores->setPageSize(3)
            ->setCurPage(intval($this->getNumPage()));
    }

    public function resetSearch()
    {
        return $this->url->getPageUrl(1);
    }

    public function getPageUrl($i)
    {
        return $this->url->getPageUrl($i, $this->getNameForSearch());
    }

    public function getViewStore($id)
    {
        return $this->url->getViewUrl($id);
    }

    public function getCount()
    {
        $count = $this->collectionFactory
            ->create()
            ->addFieldToFilter('visible', ['eq' => 1]);
        if ($name = $this->getNameForSearch()) {
            $count->addFieldToFilter('name', [
                ['like' => '% ' . $name . ' %'], //spaces on each side
                ['like' => '% ' . $name], //space before and ends with $needle
                ['like' => $name . ' %'],
                ['like' => $name]// starts with needle and space after
            ]);
        }
        return $count->count();
    }

    public function getCountPages()
    {
        return ceil($this->getCount() / 3);
    }

    /**
     * @param \Drobko\Storelocator\Model\StoreLocator $store
     * @return string
     */
    public function getStoreImageUrl($store)
    {
        return $this->imageHelper->getImageUrl($store->getImage());
    }
}
