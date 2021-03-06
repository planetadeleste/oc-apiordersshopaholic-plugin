<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Controllers\Api;

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
}
