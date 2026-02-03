<?php

namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\UserAddress;

use PlanetaDelEste\ApiToolbox\Classes\Resource\ResourceCollection;

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
