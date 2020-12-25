<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Drobko\Storelocator\Block\Adminhtml\StoreLocator\Edit;

use Magento\Backend\Block\Widget\Context;
use Drobko\Storelocator\Api\StoreLocatorRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var StoreLocatorRepositoryInterface
     */
    protected $storeLocatorRepository;

    /**
     * @param Context $context
     * @param StoreLocatorRepositoryInterface $storeLocatorRepository
     */
    public function __construct(
        Context $context,
        StoreLocatorRepositoryInterface $storeLocatorRepository
    )
    {
        $this->context = $context;
        $this->storeLocatorRepository = $storeLocatorRepository;
    }

    /**
     * Return Store ID
     *
     * @return int|null
     */
    public function getStoreId()
    {
        if ($this->context->getRequest()->getParam('store_id')) {
            try {
                return $this->storeLocatorRepository->getById(
                    $this->context->getRequest()->getParam('store_id')
                )->getId();
            } catch (NoSuchEntityException $e) {
            }
            return null;
        }
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
