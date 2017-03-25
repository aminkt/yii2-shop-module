<?php

namespace aminkt\shop;
use aminkt\shop\interfaces\CategoryInterface;
use aminkt\shop\interfaces\ProductInterface;

/**
 * Shop module definition class
 */
class Shop extends \yii\base\Module
{
    const THEME_PATH = '@shop/views';

    /** @var null $theme theme mapping */
    public $theme = null;


    /** @var  ProductInterface $productModel */
    public $productModel;

    /** @var  CategoryInterface $categoryModel */
    public $categoryModel;

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'aminkt\shop\controllers';

    public $defaultRoute = 'shop';

    public $layout = 'layout';

    /**
     * @inheritdoc
     */
    public function init()
    {
        \Yii::setAlias("@shop", __DIR__);
        $this->setLayoutPath($this->theme['basePath']);
        parent::init();

        if($this->theme){
            \Yii::$app->view->theme = new \yii\base\Theme($this->theme);
        }
        // custom initialization code goes here
    }
}
