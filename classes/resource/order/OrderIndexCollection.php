<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class IndexCollection
 *
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order
 */
class OrderIndexCollection extends ResourceCollection
{
    public $collects = OrderShowResource::class;

    public function toArray($request)
    {
        return $this->collection;
    }
}
