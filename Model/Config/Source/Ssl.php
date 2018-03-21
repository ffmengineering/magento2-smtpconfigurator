<?php
/**
 * @copyright Copyright © 2018 FitForMe. All rights reserved.
 * @author    n.sala@fitforme.nl
 */
namespace Ffm\SmtpConfigurator\Model\Config\Source;

/**
 * Source model for element with smtp ssl variants.
 */
class Ssl implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Value for none
     */
    const SSL_NONE = '';

    /**
     * Value for SSL type
     */
    const SSL_SSL = 'SSL';

    /**
     * Value for TLS type
     */
    const SSL_TLS = 'tls';

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::SSL_NONE, 'label' => __('None')],
            ['value' => self::SSL_SSL, 'label' => __('SSL')],
            ['value' => self::SSL_TLS, 'label' => __('TLS')],
        ];
    }
}
