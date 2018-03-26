<?php

namespace Ffm\SmtpConfigurator\Plugin\Magento\Framework\Mail;

class Transport extends \Zend_Mail_Transport_Smtp
{
    /**
     * @var \Ffm\SmtpConfigurator\Helper\Data
     */
    private $helper;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * Transport constructor.
     * @param \Ffm\SmtpConfigurator\Helper\Data $helper
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Ffm\SmtpConfigurator\Helper\Data $helper,
        \Psr\Log\LoggerInterface $logger
    ){
        $this->helper = $helper;
        $this->logger = $logger;

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
    }

    /**
     * @param \Magento\Framework\Mail\TransportInterface $subject
     * @param \Closure $proceed
     */
    public function aroundSendMessage(\Magento\Framework\Mail\TransportInterface $subject, \Closure $proceed)
    {
        try {
            parent::send($subject->getMessage());
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\MailException(new \Magento\Framework\Phrase($e->getMessage()), $e);
        }
    }

}