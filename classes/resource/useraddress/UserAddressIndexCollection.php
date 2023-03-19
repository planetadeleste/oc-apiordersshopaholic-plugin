<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\UserAddress;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class IndexCollection
 *
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\UserAddress
 */
class UserAddressIndexCollection extends ResourceCollection
{
    public $collects = UserAddressShowResource::class;

    public function toArray($request)
    {
        return $this->collection;
    }
}
