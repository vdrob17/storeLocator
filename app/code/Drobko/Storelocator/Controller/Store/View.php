<?php
namespace Drobko\Storelocator\Controller\Store;

class View extends \Magento\Framework\App\Action\Action
{
    /**
     * Index action
     *
     * @return $this
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getLayout()->getBlock('page.main.title')->setPageTitle('Store View');
        $this->_view->renderLayout();
    }
}
