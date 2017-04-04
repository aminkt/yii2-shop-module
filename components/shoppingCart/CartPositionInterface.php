<?php

namespace aminkt\shop\components\shoppingCart;
use aminkt\shop\interfaces\ProductInterface;


/**
 * Interface CartItemInterface
 * @property int $price
 * @property int $cost
 * @property string $id
 * @property int $quantity
 * @package yz\shoppingcart
 */
interface CartPositionInterface
{
    /** Triggered on cost calculation */
    const EVENT_COST_CALCULATION = 'costCalculation';


    /**
     * Return product model.
     * @return ProductInterface
     */
    public function getProduct();

    /**
     * Final price
     * @return integer
     */
    public function getPrice();

    /**
     * Price * Quantity
     * @param bool $withDiscount
     * @return integer
     */
    public function getCost($withDiscount = true);

    /**
     * @return string
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getTax();

    /**
     * @return mixed
     */
    public function getDiscount();

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity);

    /**
     * @return int
     */
    public function getQuantity();
} 