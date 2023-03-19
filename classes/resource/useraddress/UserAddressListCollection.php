<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\UserAddress;

/**
 * Class ListCollection
 *
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\UserAddress
 */
class UserAddressListCollection extends UserAddressIndexCollection
{
    public $collects = UserAddressItemResource::class;
}
