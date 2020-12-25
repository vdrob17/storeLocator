<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Drobko\Storelocator\Controller\Adminhtml\Stores;

use Drobko\Storelocator\Api\StoreLocatorRepositoryInterface;
use Magento\Backend\App\Action;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Drobko_Storelocator::view';

    private $storeLocatorRepository;
    public function __construct(
        Action\Context $context,
        StoreLocatorRepositoryInterface $storeLocatorRepository
    ) {
        $this->storeLocatorRepository = $storeLocatorRepository;
        parent::__construct($context);
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('store_id');
        if ($id) {
            try {
                $this->storeLocatorRepository->deleteById($id);

                $this->messageManager->addSuccessMessage(__('You deleted the store.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/');
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a store to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
