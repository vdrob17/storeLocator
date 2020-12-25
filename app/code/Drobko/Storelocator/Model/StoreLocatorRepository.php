<?php

namespace Drobko\Storelocator\Model;

use Drobko\Storelocator\Api\Data;
use Drobko\Storelocator\Api\StoreLocatorRepositoryInterface;
use Drobko\Storelocator\Model\ResourceModel\StoreLocator as ResourceStoreLocator;
use Magento\Framework\Exception\CouldNotSaveException;

class StoreLocatorRepository implements StoreLocatorRepositoryInterface
{
    /**
     * @var ResourceStoreLocator
     */
    protected $resource;

    /**
     * @var StoreLocatorFactory
     */
    protected $storeLocatorFactory;

    /**
     * StoreReviewRepository constructor.
     * @param ResourceStoreLocator $resourceStoreLocator
     * @param StoreLocatorFactory $storeLocatorFactory
     */
    public function __construct(
        ResourceStoreLocator $resourceStoreLocator,
        StoreLocatorFactory $storeLocatorFactory
    ) {
        $this->resource = $resourceStoreLocator;
        $this->storeLocatorFactory = $storeLocatorFactory;
    }
    /**
     * Save store .
     *
     * @param \Drobko\Storelocator\Api\Data\StoreLocatorInterface $storeLocator
     * @return \Drobko\Storelocator\Api\Data\StoreLocatorInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\StoreLocatorInterface $storeLocator)
    {
        try {
            /** @var $storeLocator \Drobko\Storelocator\Model\StoreLocator */
            $this->resource->save($storeLocator);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $storeLocator;
    }

    /**
     * Retrieve store .
     *
     * @param int $storeLocatorId
     * @return \Drobko\Storelocator\Api\Data\StoreLocatorInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($storeLocatorId)
    {
        $storeLocator = $this->storeLocatorFactory->create();
        $this->resource->load($storeLocator, $storeLocatorId);
        if (!$storeLocator->getId()) {
            throw new NoSuchEntityException(__('The CMS block with the "%1" ID doesn\'t exist.', $storeLocatorId));
        }
        return $storeLocator;
    }

    /**
     * Delete store .
     *
     * @param \Drobko\Storelocator\Api\Data\StoreLocatorInterface $storeLocator
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\StoreLocatorInterface $storeLocator)
    {
        try {
            /** @var $storeLocator \Drobko\Storelocator\Model\StoreLocator */
            $this->resource->delete($storeLocator);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete store  by ID.
     *
     * @param int $storeLocatorId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($storeLocatorId)
    {
        return $this->delete($this->getById($storeLocatorId));
    }
}
