<?php
namespace aminkt\shop\interfaces;

/**
 * Interface ProductInterface
 * @package aminkt\shop\interfaces
 *
 * Define an interface for product model in app to grantee some important data be available for ordering module.
 */
interface ProductInterface extends \aminkt\ordering\interfaces\ProductInterface
{
    /**
     * Return product by code
     * @param $code
     * @return ProductInterface|null
     */
    public static function getProductByCode($code);

    /**
     * Return Product by id.
     * @param $id
     * @return ProductInterface|null
     */
    public static function getProductById($id);

    /**
     * Return product slug
     * @return string
     */
    public function getSlug();

    /**
     * Return Store status as string
     * @return string
     */
    public function getStoreStatusString();

    /**
     * Return product summary
     * @return string
     */
    public function getSummary();

    /**
     * Return complete product description
     * @return string
     */
    public function getDescription();

    /**
     * Return urls of product pictures as array
     * @param $size string size of picture
     * @param bool $path Return address as path or url
     * @return null|\string[]
     */
    public function getPictures($size=null, $path=null);

    /**
     * Return product primary link.
     * @return string
     */
    public function getLink();

    /**
     * Retrun product categories
     * @param int $depth number of parent categories to show
     * @return CategoryInterface[]
     */
    public function getCategories($depth = 1);


    /**
     * Return product category.
     * @return CategoryInterface
     */
    public function getCategory();

    /**
     * Return related products as array
     * @param $limit integer
     * @return ProductInterface[]
     */
    public function relatedProducts($limit);

    /**
     * Return bestsellers products.
     * @param $limit
     * @return ProductInterface[]
     */
    public static function bestsellersProducts($limit);

    /**
     * Return new products
     * @param $limit
     * @return ProductInterface[]
     */
    public static function newProducts($limit);

    /**
     * Return popular products
     * @param $limit
     * @return ProductInterface[]
     */
    public static function popularProducts($limit);

}