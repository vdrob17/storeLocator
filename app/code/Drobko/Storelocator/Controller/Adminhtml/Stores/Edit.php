<?php

namespace Drobko\Storelocator\Controller\Adminhtml\Stores;

use Drobko\Storelocator\Api\StoreLocatorRepositoryInterface;
use Drobko\Storelocator\Model\StoreLocatorFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;

/**
 * Edit CMS block action.
 */
class Edit extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    protected $storeLocatorRepository;
    protected $storeLocatorFactory;
    protected $coreRegistry;
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        StoreLocatorRepositoryInterface $storeLocatorRepository,
        StoreLocatorFactory $storeLocatorFactory
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->storeLocatorFactory = $storeLocatorFactory;
        $this->storeLocatorRepository = $storeLocatorRepository;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Edit CMS block
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('store_id');

        // 2. Initial checking
        if ($id) {
            $model= $this->storeLocatorRepository->getById($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This store no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        } else {
            $model = $this->storeLocatorFactory->create();
        }
        $this->coreRegistry->register('stores_list', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Drobko_Storelocator::stores')
            ->addBreadcrumb(__('StoreLocator'), __('StoreLocator'));
        $resultPage->getConfig()->getTitle()->prepend(__('Store'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getId() : __('New Store'));
        return $resultPage;
    }
}
