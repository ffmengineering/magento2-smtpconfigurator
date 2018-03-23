<?php

namespace Ffm\SmtpConfigurator\Plugin\Magento\Framework\Mail;

/**
 * Class Message
 * @package Ffm\SmtpConfigurator\Plugin\Magento\Framework\Mail
 */
class Message
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(\Magento\Framework\Registry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * Register message in registry
     *
     * @param \Magento\Framework\Mail\Message $subject
     * @param $result
     * @return mixed
     */
    public function afterSetBody(\Magento\Framework\Mail\Message $subject, $result)
    {
        $this->registry->unregister(\Ffm\SmtpConfigurator\Helper\Data::REGISTRY_KEY_MESSAGE);
        $this->registry->register(\Ffm\SmtpConfigurator\Helper\Data::REGISTRY_KEY_MESSAGE, $subject);
        return $result;
    }
}