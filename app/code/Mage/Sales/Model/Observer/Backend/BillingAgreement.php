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
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Mage_Sales_Model_Observer_Backend_BillingAgreement
{
    /**
     * @var Magento_AuthorizationInterface
     */
    protected $_authorization;

    /**
     * @param Magento_AuthorizationInterface $authorization
     */
    public function __construct(Magento_AuthorizationInterface $authorization)
    {
        $this->_authorization = $authorization;
    }

    /**
     * Block admin ability to use customer billing agreements
     *
     * @param Varien_Event_Observer $observer
     */
    public function dispatch($observer)
    {
        $event = $observer->getEvent();
        $methodInstance = $event->getMethodInstance();
        if ($methodInstance instanceof Mage_Sales_Model_Payment_Method_Billing_AgreementAbstract
            && false == $this->_authorization->isAllowed('Mage_Sales::use')
        ) {
            $event->getResult()->isAvailable = false;
        }
    }
}