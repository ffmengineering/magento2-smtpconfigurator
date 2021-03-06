<?php
namespace Ffm\SmtpConfigurator\Controller\Adminhtml\System\Config\Test;

use Magento\Framework\Controller\Result\JsonFactory;

/**
 * Class Index
 * @package Ffm\SmtpConfigurator\Controller\Adminhtml\System\Config\Test
 */
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var \Magento\Framework\Mail\Template\TransportBuilder
     */
    protected $transportBuilder;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
     * @param JsonFactory $resultJsonFactory,
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        JsonFactory $resultJsonFactory
    ) {
        parent::__construct($context);

        $this->resultJsonFactory = $resultJsonFactory;
        $this->transportBuilder = $transportBuilder;
    }

    /**
     * Test sending email
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $to = $this->getRequest()->getParam('testmail');

        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        if (!$to) {
            return $resultJson->setData([
                'valid' => 0,
                'message' => "Specify the test email address",
            ]);
        }

        $templateOptions = [
            'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
            'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID
        ];

        $transport = $this->transportBuilder
            ->setTemplateIdentifier('smtpconfigurator_test_template')
            ->setTemplateOptions($templateOptions)
            ->setTemplateVars([])
            ->setFrom('general')
            ->addTo($to, 'test')
            ->getTransport();

        $transport->sendMessage();


        return $resultJson->setData([
            'valid' => 1,
            'message' => "Test mail sent to $to",
        ]);
    }
}
