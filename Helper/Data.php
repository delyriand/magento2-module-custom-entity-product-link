<?php
/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future.
 *
 * @category  Smile
 * @package   Smile\CustomEntityProductLink
 * @author    Aurelien FOUCRET <aurelien.foucret@smile.fr>
 * @copyright 2019 Smile
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Smile\CustomEntityProductLink\Helper;

use Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory as ProductAttributeCollectionFactory;
use Magento\Catalog\Api\Data\ProductAttributeInterface;

/**
 * Custom entity helper.
 *
 * @category Smile
 * @package  Smile\CustomEntityProductLink
 * @author   Aurelien FOUCRET <aurelien.foucret@smile.fr>
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Catalog\Api\Data\ProductAttributeInterface[]
     */
    private $customEntityProductAttributes;

    /**
     * Constructor.
     *
     * @param \Magento\Framework\App\Helper\Context $context                           Context.
     * @param ProductAttributeCollectionFactory     $productAttributeCollectionFactory Product attribute collection factory.
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        ProductAttributeCollectionFactory $productAttributeCollectionFactory
    ) {
        parent::__construct($context);
        $this->initAttributes($productAttributeCollectionFactory);
    }

    /**
     * List of product attributes using custom entities as frontend input.
     *
     * @return \Magento\Catalog\Api\Data\ProductAttributeInterface[]
     */
    public function getCustomEntityProductAttributes()
    {
        return $this->customEntityProductAttributes;
    }

    /**
     * Init attribute list.
     *
     * @param ProductAttributeCollectionFactory $attributeCollectionFactory Product attribute collection factory.
     *
     * @return void
     */
    private function initAttributes(ProductAttributeCollectionFactory $attributeCollectionFactory)
    {
        $attributeCollection = $attributeCollectionFactory->create();
        $attributeCollection->addFieldToFilter(ProductAttributeInterface::FRONTEND_INPUT, 'smile_custom_entity');

        $this->customEntityProductAttributes = $attributeCollection->getItems();
    }
}
