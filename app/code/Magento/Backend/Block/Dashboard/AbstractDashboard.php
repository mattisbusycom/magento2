<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Backend\Block\Dashboard;

/**
 * Adminhtml dashboard tab abstract
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
abstract class AbstractDashboard extends \Magento\Backend\Block\Widget
{
    /**
     * @var \Magento\Backend\Helper\Dashboard\AbstractDashboard
     */
    protected $_dataHelper = null;

    /**
     * @var \Magento\Reports\Model\Resource\Order\CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Reports\Model\Resource\Order\CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Reports\Model\Resource\Order\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return array|\Magento\Framework\Model\Resource\Db\Collection\AbstractCollection|\Magento\Eav\Model\Entity\Collection\Abstract
     */
    public function getCollection()
    {
        return $this->getDataHelper()->getCollection();
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->getDataHelper()->getCount();
    }

    /**
     * Get data helper
     *
     * @return \Magento\Backend\Helper\Dashboard\AbstractDashboard
     */
    public function getDataHelper()
    {
        return $this->_dataHelper;
    }

    /**
     * @return $this
     */
    protected function _prepareData()
    {
        return $this;
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        $this->_prepareData();
        return parent::_prepareLayout();
    }
}
