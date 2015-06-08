<?php
class Tim_FragmentaryProducts_Model_Product_Url extends Mage_Catalog_Model_Product_Url
{
    public function getUrl(Mage_Catalog_Model_Product $product, $params = array())
    {
        $url = $product->getData('url');
        if (!empty($url)) {
            return $url;
        }

        $requestPath = $product->getData('request_path');
        if (empty($requestPath)) {
            $requestPath = $this->_getRequestPath($product, $this->_getCategoryIdForUrl($product, $params));
            $product->setRequestPath($requestPath);
        }

        if (isset($params['_store'])) {
            $storeId = $this->_getStoreId($params['_store']);
        } else {
            $storeId = $product->getStoreId();
        }

        if ($storeId != $this->_getStoreId()) {
            $params['_store_to_url'] = true;
        }

        // reset cached URL instance GET query params
        if (!isset($params['_query'])) {
            $params['_query'] = array();
        }

        $this->getUrlInstance()->setStore($storeId);
        $productUrl = $this->_getProductUrl($product, $requestPath, $params);
        $product->setData('url', $productUrl);
        return $product->getData('url');
    }
}