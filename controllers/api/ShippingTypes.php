<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Controllers\Api;

use PlanetaDelEste\ApiToolbox\Classes\Api\Base;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\ShippingType\ShippingTypeIndexCollection;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\ShippingType\ShippingTypeListCollection;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\ShippingType\ShippingTypeShowResource;
use Lovata\OrdersShopaholic\Models\ShippingType;

/**
 * Class ShippingTypes
 *
 * @package PlanetaDelEste\ApiOrdersShopaholic\Controllers\Api
 */
class ShippingTypes extends Base
{
    public function getModelClass(): string
    {
        return ShippingType::class;
    }

    public function getSortColumn(): string
    {
        return 'sort';
    }

    public function getShowResource(): string
    {
        return ShippingTypeShowResource::class;
    }

    public function getIndexResource(): string
    {
        return ShippingTypeIndexCollection::class;
    }

    public function getListResource(): string
    {
        return ShippingTypeListCollection::class;
    }
}
