<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\PaymentMethod;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class IndexCollection
 *
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\PaymentMethod
 */
class PaymentMethodIndexCollection extends ResourceCollection
{
    public $collects = PaymentMethodShowResource::class;

    public function toArray($request)
    {
        return $this->collection;
    }
}
