<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\OrderPosition;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class IndexCollection
 *
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\OrderPosition
 */
class OrderPositionIndexCollection extends ResourceCollection
{
    public $collects = OrderPositionShowResource::class;

    public function toArray($request)
    {
        return $this->collection;
    }
}
