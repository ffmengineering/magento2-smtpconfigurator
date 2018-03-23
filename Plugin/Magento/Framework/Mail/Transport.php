<?php

namespace Ffm\SmtpConfigurator\Plugin\Magento\Framework\Mail;

class Transport extends \Zend_Mail_Transport_Smtp
{
    /**
     * @var \Ffm\SmtpConfigurator\Helper\Data
     */
    private $helper;

    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * Transport constructor.
     * @param \Ffm\SmtpConfigurator\Helper\Data $helper
     * @param \Magento\Framework\Registry $registry
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Ffm\SmtpConfigurator\Helper\Data $helper,
        \Magento\Framework\Registry $registry,
        \Psr\Log\LoggerInterface $logger
    ){
        $this->helper = $helper;
        $this->registry = $registry;
        $this->logger = $logger;

        if ($this->helper->getConfigSmtpEnabled() ||
            $this->registry->registry(\Ffm\SmtpConfigurator\Helper\Data::REGISTRY_KEY_TESTMODE)) {
            $smtpHost = $helper->getConfigSmtpHost();
            $smtpProtocol = $helper->getConfigSmtpProtocol();

            $smtpConf = [
                'auth' => $helper->getConfigSmtpAuthentication(),
                'port' => $helper->getConfigSmtpPort(),
                'username' => $helper->getConfigSmtpUsername(),
                'password' => $helper->getConfigSmtpPassword()
            ];

            if ($smtpProtocol === \Ffm\SmtpConfigurator\Model\Config\Source\Protocol::PROTOCOL_SSL ||
                $smtpProtocol === \Ffm\SmtpConfigurator\Model\Config\Source\Protocol::PROTOCOL_TLS
            ) {
                $smtpConf['ssl'] = $smtpProtocol;
            }

            parent::__construct($smtpHost, $smtpConf);

        } else {
            parent::__construct();
        }
    }

    /**
     * @param \Magento\Framework\Mail\TransportInterface $subject
     * @param \Closure $proceed
     */
    public function aroundSendMessage(\Magento\Framework\Mail\TransportInterface $subject, \Closure $proceed)
    {
        if ($this->helper->getConfigSmtpEnabled() ||
            $this->registry->registry(\Ffm\SmtpConfigurator\Helper\Data::REGISTRY_KEY_TESTMODE)) {

            $message = $this->registry->registry(\Ffm\SmtpConfigurator\Helper\Data::REGISTRY_KEY_MESSAGE);
            try {
                parent::send($subject->getMessage());
            } catch (\Exception $e) {
                throw new \Magento\Framework\Exception\MailException(new \Magento\Framework\Phrase($e->getMessage()), $e);
            }

        } else {
            $proceed();
        }
    }

}