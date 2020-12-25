<?php

namespace Drobko\Storelocator\Controller\Adminhtml\Stores;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Drobko_Storelocator::view';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor.
     * @param Action\Context $context
     * @param PageFactory $resultFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magento_Cms::cms_page');
        $resultPage->getConfig()->getTitle()->prepend(__("Store Locator"));
        return $resultPage;
    }
}
