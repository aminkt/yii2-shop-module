<?php
/**
 * Categories template functions.
 *
 * Created by Amin Keshavarz
 * Date: 23/03/2017
 * Time: 11:10 AM
 * Created in telbit project
 */
use yii\helpers\Html;

/**
 * Return category model.
 *
 *
 * @param array $args {
 *
 *      @type int           $id               Category ID to retrieve
 *
 * }
 * @return \aminkt\shop\interfaces\CategoryInterface|null
 */
function get_category( $args = []){
    $id = get_args_value('id', $args);
    if(!$id)
        return null;

    $categoryModal = \aminkt\shop\Shop::getInstance()->categoryModel;
    $category = $categoryModal::getCategoryById($id);
    return $category;
}

/**
 * Return Categories grouped as array.
 *
 *
 * @param array $args {
 *
 *      @type string           $status               Categories whit special status
 *      @type string           $pre_group            Text before group name
 *      @type string           $post_parent          Text after parent name
 *
 * }
 * @return array
 */
function get_categories_grouped($args = []){
    $categoryModal = \aminkt\shop\Shop::getInstance()->categoryModel;
    $categories = $categoryModal::getCategoriesGroupedAsArray(
        get_args_value('status', $args, null),
        get_args_value('pre_group', $args, ''),
        get_args_value('post_parent', $args, '')
    );
    return $categories;
}

/**
 * Display or retrieve the HTML list of categories.
 *
 *
 * @param array $args {
 * Array of optional arguments.
 *
 *      @type int           $child_of               Category ID to retrieve child categorise of. See get_category(). Default 0.
 *      @type array         $current_categories       Array of IDs of categories
 *
 *      @type array         $htmlOptions    {
 *          Array of optional arguments.
 *          @type string    $a_before_content   html content that you would print before cat name.
 *          @type string    $a_after_content    html content that you would print after cat name.
 *          @type array     $ul                 Use an array same as Yii2 helper tag options array.
 *          @type array     $li                 Use an array same as Yii2 helper tag options array.
 *          @type array     $parent_li          The li tag that have a child ul. Use an array same as Yii2 helper tag options array.
 *          @type array     $child_ul           Use an array same as Yii2 helper tag options array.
 *          @type array     $child_li           Use an array same as Yii2 helper tag options array.
 *          @type array     $active_li          Options of active li tag. Use an array same as Yii2 helper tag options array.
 *
 *      }
 *
 *
 * }
 * @return false|string HTML content only if 'echo' argument is 0.
 */
function list_categories( $args = [] ) {
    $categoryModal = \aminkt\shop\Shop::getInstance()->categoryModel;
    if($catId = get_args_value('child_of', $args) == 0)
        $categories = $categoryModal::getCategoriesAsArray();
    else{
        $category = get_category(['id'=>$catId]);
        $categories = $categoryModal::getCategoriesAsArray($category);
    }


    return out_list_categories([
        'categories'=>$categories,
        'current_categories'=>get_args_value('current_categories', $args),
        'htmlOptions'=>get_args_value('htmlOptions', $args)
    ]);
}


/**
 * Display or retrieve the HTML list of categories.
 *
 *
 * @param array $args {
 *
 *      @type array     $categories         Array of categories. output of aminkt\shop\interfaces\CategoryInterface::getCategoriesAsArray() accepted here.
 *      @type array     $current_categories   Array of IDs of categories.
 *
 *
 *      @type array         $htmlOptions    {
 *          Array of optional arguments.
 *          @type string    $a_before_content   html content that you would print before cat name.
 *          @type string    $a_after_content    html content that you would print after cat name.
 *          @type array     $ul                 Use an array same as Yii2 helper tag options array.
 *          @type array     $li                 Use an array same as Yii2 helper tag options array.
 *          @type array     $parent_li          The li tag that have a child ul. Use an array same as Yii2 helper tag options array.
 *          @type array     $child_ul           Use an array same as Yii2 helper tag options array.
 *          @type array     $child_li           Use an array same as Yii2 helper tag options array.
 *          @type array     $active_li          Options of active li tag. Use an array same as Yii2 helper tag options array.
 *
 *      }
 *
 *
 * }
 *
 * @param boolean $child_list   If list that want to create is a child list. Default is false.
 * @return false|string HTML content only if 'echo' argument is 0.
 */
function out_list_categories( $args = [] , $child_list=false) {
    $categories = get_args_value('categories', $args);
    $current_cat = get_args_value('current_categories', $args, []);
    $options = get_args_value('htmlOptions', $args, []);
    $ul_options = get_args_value('ul', $options, []);
    $li_options = get_args_value('li', $options, []);
    $child_ul_options = get_args_value('child_ul', $options, []);
    $child_li_options = get_args_value('child_li', $options, []);
    $parent_li_options = get_args_value('parent_li', $options, []);
    $active_li_options = get_args_value('active_li', $options, []);

    $a_before_content = get_args_value('a_before_content', $options, '');
    $a_after_content = get_args_value('a_after_content', $options, '');
    if($child_list)
        $out = Html::beginTag('ul', $child_ul_options);
    else
        $out = Html::beginTag('ul', $ul_options);

    foreach ($categories as $category){
        /** @var \aminkt\shop\interfaces\CategoryInterface $cat */
        $parent = get_args_value('parent', $category);
        $cat = $category['category'];
        if(in_array($cat->getId(), $current_cat))
            $out .= Html::beginTag('li', $active_li_options?$active_li_options:$li_options);
        elseif($parent)
            $out .= Html::beginTag('li', $parent_li_options);
        elseif($child_list)
            $out .= Html::beginTag('li', $child_li_options);
        else
            $out .= Html::beginTag('li', $li_options);
        $out .= Html::a($a_before_content.$cat->getName().$a_after_content, $cat->getLink());
        if($parent){
            $out .= out_list_categories([
                'categories'=> $parent,
                'current_categories'=>$current_cat,
                'htmlOptions'=>$options
            ], true);
        }
        $out .= Html::endTag('li');

    }
    $out .= Html::endTag('ul');
    return $out;
}