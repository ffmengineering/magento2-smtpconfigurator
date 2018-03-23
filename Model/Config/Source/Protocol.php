<?php
/**
 * @copyright Copyright © 2018 FitForMe. All rights reserved.
 * @author    n.sala@fitforme.nl
 */
namespace Ffm\SmtpConfigurator\Model\Config\Source;

/**
 * Source model for element with smtp ssl variants.
 */
class Protocol implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Value for none
     */
    const PROTOCOL_NONE = '';

    /**
     * Value for SSL type
     */
    const PROTOCOL_SSL = 'SSL';

    /**
     * Value for TLS type
     */
    const PROTOCOL_TLS = 'tls';

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::PROTOCOL_NONE, 'label' => __('None')],
            ['value' => self::PROTOCOL_SSL, 'label' => __('SSL')],
            ['value' => self::PROTOCOL_TLS, 'label' => __('TLS')],
        ];
    }
}
