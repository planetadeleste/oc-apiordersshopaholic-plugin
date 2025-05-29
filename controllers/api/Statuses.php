<?php

namespace PlanetaDelEste\ApiOrdersShopaholic\Controllers\Api;

use Lovata\OrdersShopaholic\Models\Status;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Status\StatusIndexCollection;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Status\StatusListCollection;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Status\StatusShowResource;
use PlanetaDelEste\ApiToolbox\Classes\Api\Base;

/**
 * Class Statuses
 *
 * @package PlanetaDelEste\ApiShopaholic\Controllers\Api
 */
class Statuses extends Base
{
    /**
     * @var array
     */
    protected array $arFileList = [];

    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return Status::class;
    }

    /**
     * @return string
     */
    public function getSortColumn(): string
    {
        return 'name|asc';
    }

    /**
     * @return string
     */
    public function getShowResource(): string
    {
        return StatusShowResource::class;
    }

    /**
     * @return string
     */
    public function getIndexResource(): string
    {
        return StatusIndexCollection::class;
    }

    /**
     * @return string
     */
    public function getListResource(): string
    {
        return StatusListCollection::class;
    }
}
