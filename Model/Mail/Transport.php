<?php
/**
 * @copyright Copyright © 2018 FitForMe. All rights reserved.
 * @author    n.sala@fitforme.nl
 */
namespace Ffm\SmtpConfigurator\Model\Mail;

/**
 * Class Transport
 * @package Ffm\SmtpConfigurator\Model
 */
class Transport extends \Zend_Mail_Transport_Smtp implements \Magento\Framework\Mail\TransportInterface
{
    /**
     * @var \Magento\Framework\Mail\MessageInterface
     */
    protected $message;

    /**
     * @param MessageInterface $message
     * @param null $parameters
     * @throws \InvalidArgumentException
     */
    public function __construct(
        \Magento\Framework\Mail\MessageInterface $message,
        \Ffm\SmtpConfigurator\Helper\Data $helper
    ){

        if (!$message instanceof \Zend_Mail) {
            throw new \InvalidArgumentException('The message should be an instance of \Zend_Mail');
        }

        $smtpHost= $helper->getConfigSmtpHost();
        $smtpConf = [
            'auth' => $helper->getConfigSmtpAuthentication(),
            'port' => $helper->getConfigSmtpPort(),
            'username' => $helper->getConfigSmtpUsername(),
            'password' => $helper->getConfigSmtpPassword()
        ];

        parent::__construct($smtpHost, $smtpConf);

        $this->message = $message;
    }

    /**
     * Send a mail using this transport
     * @return void
     * @throws \Magento\Framework\Exception\MailException
     */
    public function sendMessage()
    {
        try {
            parent::send($this->message);
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\MailException(new \Magento\Framework\Phrase($e->getMessage()), $e);
        }
    }

    /**
     * @inheritdoc
     */
    public function getMessage()
    {
        return $this->message;
    }
}
