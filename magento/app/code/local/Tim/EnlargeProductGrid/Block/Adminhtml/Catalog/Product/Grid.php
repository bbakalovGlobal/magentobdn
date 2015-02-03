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
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright  Copyright (c) 2006-2014 X.commerce, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml customer grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Tim_EnlargeProductGrid_Block_Adminhtml_Catalog_Product_Grid extends Mage_Adminhtml_Block_Catalog_Product_Grid
{
    protected function _prepareColumns()
    {
        $this->addColumnAfter('tim_nr_katalogowy_producenta',
            array(
                'header' => Mage::helper('catalog')->__('Nr referencyjny'), //in at.dev.local change helper on Mage::helper('tim_catalog')
                'index' => 'tim_nr_katalogowy_producenta',
                'type' => 'options',
            ),'name'
        );
        $this->addColumnAfter('tim_ean',
            array(
                'header' => Mage::helper('catalog')->__('EAN'),
                'index' => 'tim_ean',
                'type' => 'options',
            ),'tim_nr_katalogowy_producenta'
        );
        $this->addColumnAfter('tim_producent',
            array(
                'header' => Mage::helper('catalog')->__('Producent'),
                'index' => 'tim_producent',
                'type' => 'options',
            ),'tim_ean'
        );
        parent::_prepareColumns();

        $this->removeColumn('type');
        $this->removeColumn('set_name');
        $this->removeColumn('visibility');
    }
}