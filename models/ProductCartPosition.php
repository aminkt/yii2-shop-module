<?php
/**
 * Created by Amin Keshavarz
 * Date: 29/03/2017
 * Time: 11:41 PM
 * Created in telbit project
 */

namespace aminkt\shop\models;

use aminkt\shop\components\shoppingCart\CartPositionInterface;
use aminkt\shop\interfaces\ProductInterface;
use aminkt\shop\Shop;
use yii\base\Object;

/**
 * Class ProductCartPosition
 * @package aminkt\shop\models
 */
class ProductCartPosition extends Object implements CartPositionInterface
{
    /**
     * @var ProductInterface $_product Product model.
     */
    protected $_product;

    /**
     * @var mixed $id Product id.
     */
    public $id;

    /**
     * @var int $quantity Item quantity
     */
    public $quantity=0;


    /**
     * Return product model.
     * @return ProductInterface
     */
    public function getProduct()
    {
        if ($this->_product === null) {
            $productModal = Shop::getInstance()->productModel;
            $this->_product = $productModal::getProductById($this->id);
        }
        return $this->_product;
    }

    /**
     * Final price
     * @return integer
     */
    public function getPrice()
    {
        return max(0,$this->getProduct()->getPrice() - $this->getProduct()->getDiscount());
    }

    /**
     * Price * Quantity
     * @param bool $withDiscount
     * @return integer
     */
    public function getCost($withDiscount = true)
    {
        return $this->getPrice()*$this->getQuantity();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTax()
    {
        return 0;
    }

    /**
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->getProduct()->getDiscount();
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        if($this->quantity>=0)
            $this->quantity += $quantity;
        else
            $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}