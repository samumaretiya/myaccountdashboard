<?php
/**
 * Copyright © 2023 SamUmaretiya. All rights reserved.
 * Skype: samumaretiya
 * Email: samumaretiya@gmail.com
**/

namespace Zealouscommerce\MyAccountDashboard\Model\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Http\Context as HttpContext;

class RemoveBlock implements ObserverInterface
{
    /**
     * @var HttpContext
     */
    protected $httpContext;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\App\RequestInterface $requestInterface,
        HttpContext $httpContext
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->httpContext = $httpContext;
        $this->request = $request;
        $this->requestInterface = $requestInterface;
    }

    public function execute(Observer $observer)
    {
        $fullAction = $this->requestInterface->getFullActionName();
        if($fullAction && $fullAction === 'customer_account_index'){
            /** @var \Magento\Framework\View\Layout $layout */
            $list = $this->scopeConfig->getValue("account_tab_setting/account_dashboard_tab/selected_tab",
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,$this->storeManager->getStore()->getStoreId());

            if($list !== null){
            $linkList =  explode(',', $list);}
            else{
                return;
            }
            $layout = $observer->getLayout();
            $isCustomerLoggedIn = (bool)$this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
            if ($isCustomerLoggedIn) {
                for($i = 0; $i<count($linkList); $i++){
                    $blockName = $linkList[$i];
                    $block = $layout->getBlock($blockName);
                        if ($block) {
                            $layout->unsetElement($blockName);
                        }
                }
            }
        }else{
            return;
        }
    }
}