<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Controllers\Api;

use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\PaymentMethod\PaymentMethodIndexCollection;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\PaymentMethod\PaymentMethodListCollection;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\PaymentMethod\PaymentMethodShowResource;
use PlanetaDelEste\ApiToolbox\Classes\Api\Base;
use Lovata\OrdersShopaholic\Models\PaymentMethod;

/**
 * Class PaymentMethods
 *
 * @package PlanetaDelEste\ApiShopaholic\Controllers\Api
 */
class PaymentMethods extends Base
{
    public function getModelClass(): string
    {
        return PaymentMethod::class;
    }

    public function getIndexResource(): string
    {
        return PaymentMethodIndexCollection::class;
    }

    public function getListResource(): string
    {
        return PaymentMethodListCollection::class;
    }

    public function getShowResource(): string
    {
        return PaymentMethodShowResource::class;
    }

    public function getSortColumn(): string
    {
        return 'sort';
    }
}
