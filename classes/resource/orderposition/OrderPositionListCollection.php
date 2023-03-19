<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\OrderPosition;

/**
 * Class ListCollection
 *
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\OrderPosition
 */
class OrderPositionListCollection extends OrderPositionIndexCollection
{
    public $collects = OrderPositionItemResource::class;
}
