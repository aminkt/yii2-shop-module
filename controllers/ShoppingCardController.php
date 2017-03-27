<?php

namespace aminkt\shop\controllers;

use yii\web\Controller;

/**
 * Class ShoppingcardController
 * @package aminkt\shop\controllers
 */
class ShoppingCardController extends Controller
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

    /**
     * Take add to card action.
     * This page also can be used for ajax requests.
     * @param string        $product        Product id
     * @param int           $quantity       Product quantity. If product is not available in store action become fail.
     * @param null|string   $details        If need more information about product, this param can be used.
     */
    public function actionAddToCard($product, $quantity=1, $details=null){

    }

    /**
     * Change card item quantity.
     * This page also can be used for ajax requests.
     * @param string $id    Card item id.
     * @param integer $quantity New quantity
     */
    public function actionChangeItemQuantity($id, $quantity){

    }

    /**
     * Remove an item from card.
     * This page also can be used for ajax requests.
     * @param string $id    Card item id .
     */
    public function actionRemoveFromCard($id){

    }

    /**
     * Remove all items from card.
     * This page also can be used for ajax requests.
     */
    public function actionEmptyCard(){

    }

    /**
     * This action prepare a json formatted response for ajax requests to show card details.
     */
    public function actionGetCardDetails(){

    }
}
