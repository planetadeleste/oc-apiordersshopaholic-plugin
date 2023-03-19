<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Store\Order;

use Lovata\Toolbox\Classes\Store\AbstractStoreWithParam;
use Lovata\OrdersShopaholic\Models\Order;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Store\OrderListStore;
use PlanetaDelEste\ApiToolbox\Traits\Store\SortingListTrait;

/**
 * Class SortingListStore
 *
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Store\Order
 */
class SortingListStore extends AbstractStoreWithParam
{
    use SortingListTrait;

    protected static $instance;

    public $arListFromDB = ['created_at'];

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return Order::class;
    }
}
