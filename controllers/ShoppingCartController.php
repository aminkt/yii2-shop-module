<?php

namespace aminkt\shop\controllers;

use aminkt\shop\components\shoppingCart\CartPositionInterface;
use aminkt\shop\components\shoppingCart\ShoppingCart;
use aminkt\shop\models\ProductCartPosition;
use aminkt\shop\Shop;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class ShoppingCartController
 * @package aminkt\shop\controllers
 */
class ShoppingCartController extends Controller
{
    public function beforeAction($action)
    {
        $this->renderPartial('/template_helpers/helper.php');
        return parent::beforeAction($action);
    }

    /**
     * Renders the index view for the module.
     * This action can be used to create a json formatted response for ajax requests to show cart details.
     * @return string
     */
    public function actionIndex()
    {
        $cart = new ShoppingCart();
        if(\Yii::$app->getRequest()->isAjax){
            $items = [];
            if(!$cart->isEmpty){
                foreach ($cart->getPositions() as $position){
                    $items[] = $this->getPositionAsArray($position);
                }
                $items['items']=$items;
                $items['cost']= $cart->getCost();
                $items['count']= $cart->getCount();
            }
            return json_encode($items);
        }

        return $this->render('index', [
            'cart'=>$cart
        ]);
    }

    /**
     * Take add to cart action.
     * This page also can be used for ajax requests.
     * @param string $product Product id
     * @param int $quantity Product quantity. If product is not available in store action become fail.
     * @param null|string $details If need more information about product, this param can be used.
     * @throws NotFoundHttpException
     */
    public function actionAddToCart($product, $quantity=1, $details=null){
        $productModel = Shop::getInstance()->productModel;
        $product = $productModel::getProductById($product);
        if(!$product)
            throw new NotFoundHttpException("محصول مورد نظر وجود ندارد");

        $cart = new ShoppingCart();
        $cart->put($product->getCartPosition(), $quantity);
    }

    /**
     * Change cart item quantity.
     * This page also can be used for ajax requests.
     * @param string $id cart item id.
     * @param integer $quantity New quantity
     * @return array|\yii\web\Response
     */
    public function actionUpdate($id, $quantity){
        $cart = new ShoppingCart();
        $productModel = Shop::getInstance()->productModel;
        $product = $productModel::getProductById($id);
        $cart->update($product->getCartPosition(), $quantity);
        if(!\Yii::$app->getRequest()->isAjax){
            return $this->redirect(['index']);
        }
        return json_encode($this->getPositionAsArray($cart->getPositionById($product->getId())));
    }

    /**
     * Remove an item from cart.
     * This page also can be used for ajax requests.
     * @param string $id cart item id .
     * @return \yii\web\Response
     */
    public function actionRemoveFromCart($id){
        $cart = new ShoppingCart();
        $productModel = Shop::getInstance()->productModel;
        $product = $productModel::getProductById($id);
        $cart->remove($product->getCartPosition());

        if(!\Yii::$app->getRequest()->isAjax){
            return $this->redirect(['index']);
        }
    }

    /**
     * Remove all items from cart.
     * This page also can be used for ajax requests.
     */
    public function actionRemoveAll(){
        $cart = new ShoppingCart();
        $cart->removeAll();
    }

    /**
     * Return cart position as array
     * @param CartPositionInterface $position
     * @return array
     */
    private function getPositionAsArray($position){
        return [
            'id'=>$position->getId(),
            'name'=>$position->getProduct()->getName(),
            'link'=>$position->getProduct()->getLink(),
            'picture'=>$position->getProduct()->getMainPicture('thumb'),
            'code'=>$position->getProduct()->getCode(),
            'price'=>$position->getPrice(),
            'cost'=>$position->getCost(),
            'quantity'=>$position->getQuantity(),
        ];
    }
}
