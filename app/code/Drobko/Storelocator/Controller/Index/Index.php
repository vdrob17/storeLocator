<?php

namespace Drobko\Storelocator\Controller\Index;

use Drobko\Storelocator\Helper\Data as Helper;
use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    private $helper;

    public function __construct(
        Context $context,
        Helper $helper
    )
    {
        parent::__construct($context);
        $this->helper = $helper;
    }

    /**
     * Index action
     *
     * @return $this
     */
    public function execute()
    {

        $this->_view->loadLayout();
        $this->_view->getLayout()->getBlock('page.main.title')->setPageTitle('Store Locator');
        $this->_view->renderLayout();
    }

}
