<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

namespace Magento\Customer\Model;

class CustomerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Customer\Model\Customer
     */
    protected $customerModel;

    /**
     * @var \Magento\Customer\Api\Data\CustomerDataBuilder
     */
    protected $customerBuilder;

    protected function setUp()
    {
        $this->customerModel = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->create(
            'Magento\Customer\Model\Customer'
        );
        $this->customerBuilder = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->create(
            'Magento\Customer\Api\Data\CustomerDataBuilder'
        );
    }

    public function testUpdateDataSetDataOnEmptyModel()
    {
        /** @var \Magento\Customer\Model\Data\Customer $customerData */
        $customerData = $this->customerBuilder
            ->setId(1)
            ->setFirstname('John')
            ->setLastname('Doe')
            ->setDefaultBilling(1)
            ->create();
        $customerData = $this->customerModel->updateData($customerData)->getDataModel();

        $this->assertEquals(1, $customerData->getId());
        $this->assertEquals('John', $customerData->getFirstname());
        $this->assertEquals('Doe', $customerData->getLastname());
        $this->assertEquals(1, $customerData->getDefaultBilling());
    }

    public function testUpdateDataOverrideExistingData()
    {
        /** @var \Magento\Customer\Model\Data\Customer $customerData */
        $customerData = $this->customerBuilder
            ->setId(2)
            ->setFirstname('John')
            ->setLastname('Doe')
            ->setDefaultBilling(1)
            ->create();
        $this->customerModel->updateData($customerData);

        /** @var \Magento\Customer\Model\Data\Customer $customerData */
        $updatedCustomerData = $this->customerBuilder
            ->setId(3)
            ->setFirstname('Jane')
            ->setLastname('Smith')
            ->setDefaultBilling(0)
            ->create();
        $updatedCustomerData = $this->customerModel->updateData($updatedCustomerData)->getDataModel();

        $this->assertEquals(3, $updatedCustomerData->getId());
        $this->assertEquals('Jane', $updatedCustomerData->getFirstname());
        $this->assertEquals('Smith', $updatedCustomerData->getLastname());
        $this->assertEquals(0, $updatedCustomerData->getDefaultBilling());
    }
}
