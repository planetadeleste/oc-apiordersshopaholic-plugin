<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Status;

/**
 * Class ListCollection
 *
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Status
 */
class StatusListCollection extends StatusIndexCollection
{
    public $collects = StatusItemResource::class;
}
