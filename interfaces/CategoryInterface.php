<?php
/**
 * Created by Amin Keshavarz
 * Date: 22/03/2017
 * Time: 03:58 AM
 * Created in telbit project
 */

namespace aminkt\shop\interfaces;
use yii\db\ActiveQuery;

/**
 * Interface CategoryInterface
 * @package aminkt\shop\interfaces
 */
interface CategoryInterface
{
    /**
     * Find category by id
     * @param $id integer
     * @return CategoryInterface|null
     */
    public static function getCategoryById($id);

    /**
     * Return category id
     * @return mixed
     */
    public function getId();

    /**
     * Return category name
     * @return string
     */
    public function getName();

    /**
     * Return parent category
     * @return CategoryInterface|null
     */
    public function getParentCategory();

    /**
     * Return parent categories as array
     * @param int $depth number of parent categories to show
     * @return CategoryInterface[]
     */
    public function getParentCategories($depth=1);

    /**
     * Return category description
     * @return string
     */
    public function getDescription();

    /**
     * Return depth of current category
     * @return integer
     */
    public function getDepth();

    /**
     * Return category link.
     * @return mixed
     */
    public function getLink();

    /**
     * Return category slug
     * @return mixed
     */
    public function getSlug();

    /**
     * Return a category parents as array.
     * @param CategoryInterface $category
     * @param int $depth
     * @return CategoryInterface[]
     */
    public static function getCategoryInheritance($category, $depth=5);

    /**
     * Return child of a category.
     * @param CategoryInterface $category
     * @param int $depth
     * @return CategoryInterface[]
     */
    public static function getCategoryChild($category, $depth=1);

    /**
     * Return categories structure as array.
     * @param CategoryInterface $category
     * @return array
     *
     *  Result should be in below structure :
     *  [
     *      [
     *          category' =>  CategoryInterface $category ,
     *          'parent'=>[
     *              [
     *                  [
     *                      'category' =>  CategoryInterface $category ,
     *                      'parent'=> ...
     *                  ]
     *                  ...
     *              ]
     *          ]
     *      ],
     *      ...
     *  ]
     */
    public static function getCategoriesAsArray($category = null);

    /**
     * Return products of category as Query
     * @return ActiveQuery
     */
    public function getCategoryProductsQuery();


    /**
     * Return categories grouped by their parent.
     * @param null $status Status of category
     * @param string $preGroup Text before group name
     * @param string $posParent Text after parent name
     * @return array    result should be like below :
     *
     * {
     *      'group name' => [
     *
     *           ProductInterface $category     Category object.
     *           ProductInterface $category     Category object.
     *           ProductInterface $category     Category object.
     *
     *      ],
     *      'group name' => [
     *
     *           ProductInterface $category     Category object.
     *           ProductInterface $category     Category object.
     *           ProductInterface $category     Category object.
     *
     *      ],
     *      'group name' => [
     *
     *           ProductInterface $category     Category object.
     *           ProductInterface $category     Category object.
     *           ProductInterface $category     Category object.
     *
     *      ]
     * }
     */
    public static function getCategoriesGroupedAsArray($status = null, $preGroup = "فرزندان دسته ", $posParent = " (دسته پدر)");
}