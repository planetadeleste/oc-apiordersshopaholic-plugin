<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Controllers\Api;

use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Status\StatusIndexCollection;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Status\StatusListCollection;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Status\StatusShowResource;
use PlanetaDelEste\ApiToolbox\Classes\Api\Base;
use Lovata\OrdersShopaholic\Models\Status;

/**
 * Class Statuses
 *
 * @package PlanetaDelEste\ApiShopaholic\Controllers\Api
 */
class Statuses extends Base
{
    public function getModelClass(): string
    {
        return Status::class;
    }

    public function getSortColumn(): string
    {
        return 'sort';
    }

    public function getShowResource(): string
    {
        return StatusShowResource::class;
    }

    public function getIndexResource(): string
    {
        return StatusIndexCollection::class;
    }

    public function getListResource(): string
    {
        return StatusListCollection::class;
    }
}
