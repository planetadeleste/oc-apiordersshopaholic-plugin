<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\ShippingType;

/**
 * Class ListCollection
 *
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\ShippingType
 */
class ShippingTypeListCollection extends ShippingTypeIndexCollection
{
    public $collects = ShippingTypeItemResource::class;
}
