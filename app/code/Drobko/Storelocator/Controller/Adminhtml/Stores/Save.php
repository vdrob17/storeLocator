<?php

namespace Drobko\Storelocator\Controller\Adminhtml\Stores;

use Drobko\Storelocator\Api\StoreLocatorRepositoryInterface;
use Drobko\Storelocator\Model\StoreLocator;
use Drobko\Storelocator\Model\StoreLocatorFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Save store review action.
 */
class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var StoreLocatorFactory\
     */
    private $storeLocatorFactory;

    /**
     * @var StoreLocatorRepositoryInterface
     */
    private $storeLocatorRepository;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param StoreLocatorFactory\|null $storeLocatorFactory
     * @param StoreLocatorRepositoryInterface|null $storeLocatorRepository
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        StoreLocatorFactory $storeLocatorFactory = null,
        StoreLocatorRepositoryInterface $storeLocatorRepository = null
    )
    {
        $this->dataPersistor = $dataPersistor;
        $this->storeLocatorFactory = $storeLocatorFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(StoreLocatorFactory::class);
        $this->storeLocatorRepository = $storeLocatorRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(StoreLocatorRepositoryInterface::class);
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (isset($data['visible']) && $data['visible'] === 'true') {
                $data['visible'] = StoreLocator::STATUS_ENABLED;
            }
            if (empty($data['store_id'])) {
                $data['store_id'] = null;
            }

            /** @var \Drobko\Storelocator\Model\StoreLocator $model */
            $model = $this->storeLocatorFactory->create();

            $id = $this->getRequest()->getParam('store_id');
            if ($id) {
                try {
                    $model = $this->storeLocatorRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This store no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            if (isset($data['image']) && is_array($data['image'])) {
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                $storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
                $currentStore = $storeManager->getStore();
                $media_url = $currentStore->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
                $data['image'] = $data['image'][0]['name'];
            } else {
                $data['image'] = null;
            }

            $model->setData($data);
            try {
                $this->storeLocatorRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved store.'));
                $this->dataPersistor->clear('stores_list');
                return $resultRedirect->setPath('*/*/edit', ['store_id' => $model->getId()]);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the store.'));
            }

            $this->dataPersistor->set('stores_list', $data);
            return $resultRedirect->setPath('*/*/edit', ['store_id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
