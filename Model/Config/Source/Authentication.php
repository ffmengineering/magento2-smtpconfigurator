<?php
/**
 * @copyright Copyright © 2018 FitForMe. All rights reserved.
 * @author    n.sala@fitforme.nl
 */
namespace Ffm\SmtpConfigurator\Model\Config\Source;

/**
 * Source model for element with smtp authentication type variants.
 */
class Authentication implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Value for Login auth type
     */
    const AUTH_LOGIN = 'login';

    /**
     * Value for Plain auth type
     */
    const AUTH_PLAIN = 'plain';

    /**
     * Value for CRAM-MD5 auth type
     */
    const AUTH_CRAMMD5 = 'crammd5';

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::AUTH_LOGIN, 'label' => __('Login')],
            ['value' => self::AUTH_PLAIN, 'label' => __('Plain')],
            ['value' => self::AUTH_CRAMMD5, 'label' => __('CRAM-MD5')],
        ];
    }
}
