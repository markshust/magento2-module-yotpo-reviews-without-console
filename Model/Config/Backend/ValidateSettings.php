<?php

namespace Yotpo\Yotpo\Model\Config\Backend;

use Magento\Framework\App\Config\Value;

class ValidateSettings extends Value
{
    /**
     * @var \Magento\Framework\Model\Context
     */
    protected $_context;

    /**
     * @method __construct
     * @param  \Magento\Framework\Model\Context                         $context
     * @param  \Magento\Framework\Registry                              $registry
     * @param  \Magento\Framework\App\Config\ScopeConfigInterface       $config
     * @param  \Magento\Framework\App\Cache\TypeListInterface           $cacheTypeList
     * @param  \Magento\Framework\Model\ResourceModel\AbstractResource  $resource
     * @param  \Magento\Framework\Data\Collection\AbstractDb            $resourceCollection
     * @param  array                                                    $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Config\ScopeConfigInterface $config,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        ?\Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        ?\Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->_context = $context;
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }

    public function afterSave()
    {
        if ($this->isValueChanged()) {
            $this->_context->getCacheManager()->clean();
        }
        return $this;
    }
}
