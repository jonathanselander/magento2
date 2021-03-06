<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Magento_Paypal
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml paypal settlement reports grid block
 *
 * @category    Magento
 * @package     Magento_Paypal
 * @author      Magento Core Team <core@magentocommerce.com>
 */
namespace Magento\Paypal\Block\Adminhtml\Settlement;

class Report extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Prepare grid container, add additional buttons
     */
    protected function _construct()
    {
        $this->_blockGroup = 'Magento_Paypal';
        $this->_controller = 'adminhtml_settlement_report';
        $this->_headerText = __('PayPal Settlement Reports');
        parent::_construct();
        $this->_removeButton('add');
        $message = __('We are connecting to the PayPal SFTP server to retrieve new reports. Are you sure you want to continue?');
        if (true == $this->_authorization->isAllowed('Magento_Paypal::fetch')) {
            $this->_addButton('fetch', array(
                'label'   => __('Fetch Updates'),
                'onclick' => "confirmSetLocation('{$message}', '{$this->getUrl('adminhtml/*/fetch')}')",
                'class'   => 'task'
            ));
        }
    }
}
