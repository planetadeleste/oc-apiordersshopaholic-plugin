<?php

namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Store;

use Lovata\OrdersShopaholic\Classes\Store\OrderListStore as ShopaholicOrderListStore;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Store\Order\SortingListStore;

/**
 * Class OrderListStore
 *
 * @property SortingListStore $sorting
 */
class OrderListStore extends ShopaholicOrderListStore
{
    const SORT_CREATED_AT_ASC  = 'created_at|asc';
    const SORT_CREATED_AT_DESC = 'created_at|desc';

    protected static $instance;

    /**
     * Init store method
     */
    protected function init(): void
    {
        parent::init();
        $this->addToStoreList('sorting', SortingListStore::class);
    }
}
