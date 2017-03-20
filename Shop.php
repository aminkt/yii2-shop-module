<?php

namespace aminkt\shop;

/**
 * Shop module definition class
 */
class Shop extends \yii\base\Module
{
    const THEME_PATH = '@shop/views/shop';
    /** @var null $theme theme mapping */
    public $theme = null;
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'aminkt\shop\controllers';

    public $defaultRoute = 'shop';

    /**
     * @inheritdoc
     */
    public function init()
    {
        \Yii::setAlias("@shop", __DIR__);
        parent::init();

        if($this->theme){
            \Yii::$app->view->theme = new \yii\base\Theme($this->theme);
        }
        // custom initialization code goes here
    }
}
