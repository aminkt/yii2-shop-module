<?php
/**
 * Products template functions.
 *
 * Created by Amin Keshavarz
 * Date: 23/03/2017
 * Time: 11:10 AM
 * Created in telbit project
 */
use aminkt\shop\interfaces\ProductInterface;

/**
 * Return new products
 * @param integer $limit Number of results.
 * @return ProductInterface[]
 */
function new_products_list($limit=10) {
    $productModel = \aminkt\shop\Shop::getInstance()->productModel;
    return $productModel::newProducts($limit);
}

/**
 * Return bestsellers products.
 * @param $limit
 * @return ProductInterface[]
 */
function bestsellers_products_list($limit){
    $productModel = \aminkt\shop\Shop::getInstance()->productModel;
    return $productModel::bestsellersProducts($limit);
}

/**
 * Return popular products
 * @param $limit
 * @return ProductInterface[]
 */
function popular_products_list($limit){
    $productModel = \aminkt\shop\Shop::getInstance()->productModel;
    return $productModel::popularProducts($limit);
}