<?php

namespace aminkt\shop;

/**
 * Shop module definition class
 */
class Shop extends \yii\base\Module
{
    const THEME_PATH = '@aminkt/shop/views/default';
    /** @var null $theme theme mapping */
    public $theme = null;
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'common\modules\shop\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if($this->theme){
            \Yii::$app->view->theme = new \yii\base\Theme($this->theme);
        }
        // custom initialization code goes here
    }
}
