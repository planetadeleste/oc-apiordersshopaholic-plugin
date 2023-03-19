<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\ShippingType;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class IndexCollection
 *
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\ShippingType
 */
class ShippingTypeIndexCollection extends ResourceCollection
{
    public $collects = ShippingTypeShowResource::class;

    public function toArray($request)
    {
        return $this->collection;
    }
}
