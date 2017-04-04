<?php

namespace aminkt\shop\controllers;

use yii\web\Controller;

/**
 * Class AccountController
 * @package aminkt\shop\controllers
 */
class CheckOutController extends Controller
{
    public function beforeAction($action)
    {
        $this->renderPartial('/template_helpers/helper.php');
        return parent::beforeAction($action);
    }

    /**
     * Renders the index view for the module.
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
