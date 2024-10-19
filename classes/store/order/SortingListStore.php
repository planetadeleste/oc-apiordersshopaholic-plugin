<?php

namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Store\Order;

use Lovata\OrdersShopaholic\Models\Order;
use Lovata\Toolbox\Classes\Store\AbstractStoreWithParam;
use PlanetaDelEste\ApiToolbox\Traits\Store\SortingListTrait;

/**
 * Class SortingListStore
 */
class SortingListStore extends AbstractStoreWithParam
{
    use SortingListTrait;

    protected static $instance;

    public $arListFromDB = ['created_at'];

    protected function getModelClass(): string
    {
        return Order::class;
    }
}
