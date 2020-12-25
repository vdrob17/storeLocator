<?php

namespace Drobko\Storelocator\Api;


interface StoreLocatorRepositoryInterface
{
    /**
     * Save store.
     *
     * @param \Drobko\Storelocator\Api\Data\StoreLocatorInterface $storeLocator
     * @return \Drobko\StoreLocator\Api\Data\StoreLocatorInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\StoreLocatorInterface $storeLocator);

    /**
     * Retrieve store.
     *
     * @param int $storeLocatorId
     * @return \Drobko\StoreLocator\Api\Data\StoreLocatorInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($storeLocatorId);

    /**
     * Retrieve stores matching the specified criteria.
     *
     * @param \Drobko\StoreLocator\Api\Data\StoreLocatorInterface $storeLocator
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */

    public function delete(Data\StoreLocatorInterface $storeLocator);

    /**
     * Delete store by ID.
     *
     * @param int $storeLocatorId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($storeLocatorId);
}
