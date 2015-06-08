<?php

/**
 * Tim
 *
 * @category   Tim
 * @package    Tim_FragmentaryProducts
 * @copyright  Copyright (c) 2015 Tim (http://tim.pl)
 * @author     Bogdan Bakalov
 */
class Tim_FragmentaryProducts_Block_Calculator extends Mage_Catalog_Block_Product_List
{
    /**
     * Return available fragments
     * @return string
     */
    public function getAvailableFragments($product)
    {
        $timFragments = explode(',', $product->getTimFragments());

        $fragments = array();
        foreach ($timFragments as $fragment) {
            $fragments[] = $fragment;
        }

        $sumValues = array_count_values($fragments);
        $items = array();
        foreach ($sumValues as $k => $v) {
            $items[] = $v . 'x' . $k;
        }
        asort($items);
        $availableFragments = implode(', ', $items);

        return $availableFragments;
    }

    /**
     * Return price excluding tax
     * @return int
     */
    public function getPriceWithoutTax($productId)
    {
        $product = Mage::getModel('catalog/product')->load($productId);
        $priceWithoutTax = Mage::helper('tax')->getPrice($product, $product->getFinalPrice(), false);

        return $priceWithoutTax;
    }

    /**
     * Return price including tax
     * @return int
     */
    public function getPriceWithTax($productId)
    {
        $product = Mage::getModel('catalog/product')->load($productId);
        $priceWithTax = Mage::helper('tax')->getPrice($product, $product->getFinalPrice(), true);

        return $priceWithTax;
    }

    /**
     * Return higher fragment's value
     * @return int
     */
    public function getMaxFragment($fragments)
    {
        $fragments = explode(',', $fragments);
        return max($fragments);
    }

    /**
     * Return sum of fragments
     * @return int
     */
    public function getFragmentsAmount($fragments)
    {
        $fragments = explode(',', $fragments);
        return array_sum($fragments);
    }
}