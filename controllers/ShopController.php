<?php

namespace aminkt\shop\controllers;

use yii\web\Controller;

/**
 * Shop controller for the `Shop` module
 */
class ShopController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
