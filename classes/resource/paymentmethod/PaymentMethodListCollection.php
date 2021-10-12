<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\PaymentMethod;

/**
 * Class ListCollection
 *
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\PaymentMethod
 */
class PaymentMethodListCollection extends PaymentMethodIndexCollection
{
    public $collects = PaymentMethodItemResource::class;
}
