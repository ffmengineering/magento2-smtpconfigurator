<?php
/**
 * @copyright Copyright © 2018 FitForMe. All rights reserved.
 * @author    n.sala@fitforme.nl
 */
namespace Ffm\SmtpConfigurator\Helper;

/**
 * Ffm SmtpConfigurator helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_SMTP_ENABLED = 'smtp/general/enabled';
    const XML_PATH_SMTP_HOST = 'smtp/general/host';
    const XML_PATH_SMTP_PORT = 'smtp/general/port';

    /**
     * @return bool
     */
    public function getConfigSmtpEnabled():bool
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->isSetFlag(self::XML_PATH_SMTP_ENABLED, $storeScope);
    }

    /**
     * @return string
     */
    public function getConfigSmtpHost():string
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_PATH_SMTP_HOST, $storeScope);
    }

    /**
     * @return string
     */
    public function getConfigSmtpPort():string
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_PATH_SMTP_PORT, $storeScope);
    }
}