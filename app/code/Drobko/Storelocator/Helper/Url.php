<?php

namespace Drobko\Storelocator\Helper;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Url\EncoderInterface;
use Magento\Framework\UrlInterface;

class Url
{

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var EncoderInterface
     */
    protected $urlEncoder;


    /**
     * @param Session $customerSession
     * @param ScopeConfigInterface $scopeConfig
     * @param RequestInterface $request
     * @param UrlInterface $urlBuilder
     * @param EncoderInterface $urlEncoder
     * @param \Magento\Framework\Url\DecoderInterface|null $urlDecoder
     * @param \Magento\Framework\Url\HostChecker|null $hostChecker
     */
    public function __construct(
        Session $customerSession,
        ScopeConfigInterface $scopeConfig,
        RequestInterface $request,
        UrlInterface $urlBuilder,
        EncoderInterface $urlEncoder
    ) {
        $this->request = $request;
        $this->urlBuilder = $urlBuilder;
        $this->scopeConfig = $scopeConfig;
        $this->customerSession = $customerSession;
        $this->urlEncoder = $urlEncoder;
    }

    /**
     * @return string
     */
    public function getViewUrl($id)
    {
        return $this->urlBuilder->getUrl('*/store/view/', ['id' => $id]);
    }

    /**
     * Retrieve customer register form url
     *
     * @return string
     */

    /**
     * @param $param
     * @return integer
     */
    public function getPageUrl($page, $name=null)
    {
        if ($name!=null) {
            return $this->urlBuilder->getUrl('*/', ['p' => $page,'name'=>$name]);
        } else {
            return $this->urlBuilder->getUrl('*/', ['p' => $page]);
        }
    }
}
