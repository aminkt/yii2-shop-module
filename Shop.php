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

    /** Global access to current data provider. */
    const GLOBAL_VAR_DATA_PROVIDER = 'shop-dataProvider';

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

    /**
     * Return an global var.
     * @param string $name  Var name
     * @return mixed
     */
    public static function getGlobalVar($name){
        return \Yii::$app->params[$name];
    }

    /**
     * Set a global var.
     * @param string $name Var name.
     * @param mixed $value  Var value.
     */
    public static function setGlobalVar($name, $value){
        \Yii::$app->params[$name]=$value;
    }
}
