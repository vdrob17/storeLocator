<?php

namespace Drobko\Storelocator\Model\StoreLocator;

use Drobko\Storelocator\Model\ResourceModel\StoreLocator\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;

class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{
    /**
     * @var Drobko\Storelocator\Model\ResourceModel\StoreLocator\CollectionFactory
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $storeLocatorCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $storeLocatorCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    )
    {
        $this->collection = $storeLocatorCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $store) {
            $this->loadedData[$store->getId()] = $store->getData();
        }

        $data = $this->dataPersistor->get('stores_list');

        if (!empty($data)) {
            $store = $this->collection->getNewEmptyItem();
            $store->setData($data);
            $this->loadedData[$store->getId()] = $store->getData();
            $this->dataPersistor->clear('stores_list');
        }
        if (!empty($this->loadedData)) {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
            $currentStore = $storeManager->getStore();
            $media_url = $currentStore->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

            if($image_name = $this->loadedData[$store->getId()]['image']) {
                unset($this->loadedData[$store->getId()]['image']);
                $this->loadedData[$store->getId()]['image'][0]['name'] = $image_name;
                $this->loadedData[$store->getId()]['image'][0]['url'] = $media_url . "" . $image_name;
            }
        }
        return $this->loadedData;
    }
}
