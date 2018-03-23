<?php
/**
 * @copyright Copyright © 2018 FitForMe. All rights reserved.
 * @author    n.sala@fitforme.nl
 */

namespace Ffm\SmtpConfigurator\Block\Adminhtml\System\Config;

class TestButton extends \Magento\Config\Block\System\Config\Form\Field
{
    /**
     * Validate VAT Button Label
     *
     * @var string
     */
    protected $_vatButtonLabel = 'Test connection';

    /**
     * @return string
     */
    public function getTestEmailField():string
    {
        return 'smtp_general_testemail';
    }

    /**
     * Set template to itself
     *
     * @return \Magento\Customer\Block\Adminhtml\System\Config\Validatevat
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (!$this->getTemplate()) {
            $this->setTemplate('system/config/testbutton.phtml');
        }
        return $this;
    }

    /**
     * Unset some non-related element parameters
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * Get the button and scripts contents
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $originalData = $element->getOriginalData();
        $buttonLabel = !empty($originalData['button_label']) ? $originalData['button_label'] : $this->_vatButtonLabel;
        $this->addData(
            [
                'button_label' => __($buttonLabel),
                'html_id' => $element->getHtmlId(),
                'ajax_url' => $this->_urlBuilder->getUrl('smptconfigurator/system_config_test/index'),
            ]
        );

        return $this->_toHtml();
    }
}
