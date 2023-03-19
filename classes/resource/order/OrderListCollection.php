<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order;

/**
 * Class ListCollection
 *
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order
 */
class OrderListCollection extends OrderIndexCollection
{
    public $collects = OrderItemResource::class;
}
