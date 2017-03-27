<?php
/**
 * Created by Amin Keshavarz
 * Date: 25/03/2017
 * Time: 12:49 PM
 * Created in telbit project
 */
use aminkt\shop\Shop;
use ruskid\nouislider\Slider;
use yii\helpers\Inflector;
use yii\widgets\LinkPager;

/**
 * Load header template.
 *
 * Includes the header template for a theme or if a name is specified then a
 * specialised header will be included.
 *
 * For the parameter, if the file is called "header-special.php" then specify
 * "special".
 *
 *
 * @param string $name The name of the specialised header.
 */
function get_header( $name = null ) {}

/**
 * Load footer template.
 *
 * Includes the footer template for a theme or if a name is specified then a
 * specialised footer will be included.
 *
 * For the parameter, if the file is called "footer-special.php" then specify
 * "special".
 *
 * @param string $name The name of the specialised footer.
 */
function get_footer( $name = null ) {}

/**
 * Retrieve paginated link for archive post and categories pages.
 *
 *
 * @param string|array $args {
 *     Optional. Array or string of arguments for generating paginated links for archives.
 *
 *     @type boolean            $hide_on_single_page        Hide widget when only one page exist.
 *     @type array              $options                    HTML attributes for the pager container tag. See also yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
 *     @type array              $link_options               HTML attributes for the link in a pager container tag. See also yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
 *     @type int                $max_button_count           Maximum number of page buttons that can be displayed.
 *     @type string             $active_page_css_class      The CSS class for the active (currently selected) page button.
 *     @type string             $disabled_page_css_class    The CSS class for the disabled page buttons.
 *     @type string             $first_page_css_class       The CSS class for the "first" page button..
 *     @type string             $last_page_css_class        The CSS class for the "last" page button..
 *     @type string             $page_css_class             The CSS class for the each page button.
 *     @type string|boolean     $first_page_text            The first page text. Default false.
 *     @type string|boolean     $last_page_text             The last page text. Default false.
 *     @type string|boolean     $next_text                  The next page text. Default '&raquo;'.
 *     @type string|boolean     $next_page_css_class        The CSS class for the "next" page button.
 *     @type string|boolean     $prev_text                  The previous page text. Default '&laquo;'.
 *     @type string|boolean     $prev_page_css_class        The CSS class for the "previous" page button.
 *
 * }
 * @return array|string|void String of page links or array of page links.
 */
function paginate_links( $args = [] ) {
    /** @var \yii\data\ActiveDataProvider $dataProvider */
    $dataProvider = Shop::getGlobalVar(Shop::GLOBAL_VAR_DATA_PROVIDER);
    return LinkPager::widget([
        'pagination' => $dataProvider->getPagination(),
        'hideOnSinglePage'=>get_args_value('hide_on_single_page', $args, true),
        'options'=>get_args_value('options', $args, ['class' => 'pagination']),
        'linkOptions'=>get_args_value('link_options', $args, []),
        'activePageCssClass'=>get_args_value('active_page_css_class', $args, 'active'),
        'disabledPageCssClass'=>get_args_value('disabled_page_css_class', $args, 'disabled'),
        'firstPageCssClass'=>get_args_value('first_page_css_class', $args, 'first'),
        'firstPageLabel'=>get_args_value('first_page_text', $args, false),
        'lastPageCssClass'=>get_args_value('last_page_css_class', $args, 'last'),
        'lastPageLabel'=>get_args_value('last_page_text', $args, false),
        'maxButtonCount'=>get_args_value('max_button_count', $args, 10),
        'pageCssClass'=>get_args_value('page_css_class', $args, null),
        'nextPageLabel'=>get_args_value('next_text', $args, '&raquo;'),
        'nextPageCssClass'=>get_args_value('next_page_css_class', $args, 'next;'),
        'prevPageLabel'=>get_args_value('prev_text', $args, '&laquo;'),
        'prevPageCssClass'=>get_args_value('prev_page_css_class', $args, 'prev'),
    ]);
}

/**
 * Return pagination size url.
 * @param $size
 * @return string
 */
function paginate_size_url($size){
    /** @var \yii\data\ActiveDataProvider $dataProvider */
    $dataProvider = Shop::getGlobalVar(Shop::GLOBAL_VAR_DATA_PROVIDER);
    return $dataProvider->pagination->createUrl(Yii::$app->getRequest()->get('page', 1)-1, $size);
}

/**
 * Check if pagination size is equal to prepared value.
 * @param integer $size Check value.
 * @return bool
 */
function is_paginate_size($size){
    /** @var \yii\data\ActiveDataProvider $dataProvider */
    $dataProvider = Shop::getGlobalVar(Shop::GLOBAL_VAR_DATA_PROVIDER);
    $pagination = $dataProvider->pagination;
    if($pagination->getPageSize()==$size)
        return true;
    return false;
}

/**
 * Retrieve sort link for archive products and categories pages.
 *
 *
 * @param array $args {
 *     Optional. Array or string of arguments for generating paginated links for archives.
 *
 *     @type boolean            $disable-url-sorting        Remove '-' before value of sort param.
 *     @type boolean            $absolute-url               Show absolute url.
 *
 * }
 * @return array    sorting items.
 */
function sort_items($args = []){
    /** @var \yii\data\ActiveDataProvider $dataProvider */
    $dataProvider = Shop::getGlobalVar(Shop::GLOBAL_VAR_DATA_PROVIDER);
    $sort=$dataProvider->getSort();
    $attributes = $sort->attributes;
    $items = [];
    foreach ($attributes as $key=>$value){
        if (($direction = $sort->getAttributeOrder($key)) !== null) {
            $class = $direction === SORT_DESC ? 'desc' : 'asc';
        }else
            $class = 'none';
        $label = $value['label'];
        if(get_args_value('disable-url-sorting', $args, false)){
            $url = \yii\helpers\Url::current(['sort'=>$key], get_args_value('absolute-url ', $args, false));
        }else{
            $url = $sort->createUrl($key, get_args_value('absolute-url ', $args, false));
        }

        $items[] = [
            'attribute'=>$key,
            'direction'=>$class,
            'label'=>$label,
            'url'=>$url,
            'selected'=>str_replace('-', '', Yii::$app->getRequest()->get('sort'))==$key,
        ];
    }
    return $items;
}
/**
 * Check if sort direction is equal to prepared value.
 * @param integer|string $direction Check value.
 * @return bool
 */
function is_sort_direction($direction){
    /** @var \yii\data\ActiveDataProvider $dataProvider */
    $dataProvider = Shop::getGlobalVar(Shop::GLOBAL_VAR_DATA_PROVIDER);
    $sort=$dataProvider->getSort();
    if($attr = Yii::$app->getRequest()->get('sort')){
        $attr = str_replace('-', '', $attr);
        Yii::warning($sortDirection = $sort->getAttributeOrder($attr));
        if (($sortDirection = $sort->getAttributeOrder($attr)) !== null) {
            $class = $sortDirection === SORT_DESC ? 'desc' : 'asc';
        }else
            $class = 'none';
        if($direction == $class or $sortDirection == $direction)
            return true;
    }
    return false;
}

/**
 * Show paginate information.
 * user {first}, {last}, {total} to format your message.
 * @param string $text formation text.
 * @return string
 */
function paginate_info($text = 'نمایش {first} تا {last} از {total} نتیجه'){
    /** @var \yii\data\ActiveDataProvider $dataProvider */
    $dataProvider = Shop::getGlobalVar(Shop::GLOBAL_VAR_DATA_PROVIDER);
    $pagination = $dataProvider->getPagination();
    $total = $pagination->totalCount;
    $itemRange = [$pagination->getOffset()+1, $pagination->getPageCount()+$pagination->getOffset()];
    return  str_replace(['{first}', '{last}', '{total}'], [$itemRange[0], $itemRange[1], $total], $text);
}

/**
 * Create a ui slider for amount filtering.
 *
 *
 * @param array $args {
 *     Optional. Array or string of arguments for generating paginated links for archives.
 *
 *     @type string           $id                                   Id of slider.
 *     @type integer          $min                                  Minimum amount.
 *     @type integer          $max                                  Max amount.
 *     @type array            $amount_label_container_options       Label container tag html options.
 *     @type array            $amount_min_label_options             Min label container tag html options.
 *     @type array            $amount_max_label_options             Max label container tag html options.
 *
 * }
 * @return string    Html data.
 */
function amount_filter_slider($args = []){
    $id = get_args_value('id', $args, 'amount_filter');
    $min = get_args_value('min', $args, 0);
    $max = get_args_value('max', $args, 1000000);
    $minLabelOptions =  get_args_value('amount_min_label_options', $args, []);
    if(key_exists('class', $minLabelOptions))
        $minLabelOptions['class'] .= " min_lable_$id";
    else
        $minLabelOptions['class'] = "min_lable_$id";
    $maxLabelOptions = get_args_value('amount_max_label_options', $args, []);
    if(key_exists('class', $maxLabelOptions))
        $maxLabelOptions['class'] .= " max_lable_$id";
    else
        $maxLabelOptions['class'] = "max_lable_$id";

    $html = Slider::widget([
        'name'=>'amount-filter',
        'id'=>$id,
        'upperValueContainerId'=>'max-amount-input',
        'updateSliderEventExpression'=>new \yii\web\JsExpression("
                    function( values, handle ) {
                        $('#min_input_$id').val(values[0]);
                        $('#max_input_$id').val(values[1]);
                        var val0 = values[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, \",\"); 
                        var val1 = values[1].toString().replace(/\B(?=(\d{3})+(?!\d))/g, \",\"); 
                        $('.".$minLabelOptions['class']."').text(val0+' تومان');
                        $('.".$maxLabelOptions['class']."').text(val1+' تومان');
                    }
                "),
        'pluginOptions' => [
            'direction'=> 'rtl',
            'start' => [$min, $max],
            'format'=> new \yii\web\JsExpression('
                {
                    to: function ( value ) {
                        return parseInt(value);
                    },
                    from: function ( value ) {
                        return parseInt(value);
                    }
                }
            '),
            'connect' => true,
            'range' => [
                'min' => $min,
                'max' => $max
            ]
        ]
    ]);
    $html .= \yii\helpers\Html::hiddenInput('min-amount', $min, ['id'=>'min_input_'.$id]);
    $html .= \yii\helpers\Html::hiddenInput('max-amount', $max, ['id'=>'max_input_'.$id]);

    $html .= \yii\helpers\Html::beginTag('div', get_args_value('amount_label_container_options', $args, []));
    $html .= \yii\helpers\Html::tag('span', '', $minLabelOptions);
    $html .= \yii\helpers\Html::tag('span', '', $maxLabelOptions);
    $html .= \yii\helpers\Html::endTag('div');

    return $html;
}