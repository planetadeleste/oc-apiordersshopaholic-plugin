<?php

namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Status;

use Lovata\OrdersShopaholic\Classes\Item\StatusItem;
use PlanetaDelEste\ApiShopaholic\Classes\Resource\Offer\ItemResource as ItemResourceOffer;
use PlanetaDelEste\ApiToolbox\Classes\Resource\Base;
use PlanetaDelEste\ApiOrdersShopaholic\Plugin;

/**
 * Class ItemResource
 *
 * @mixin StatusItem
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Status
 */
class StatusItemResource extends Base
{
    /**
     * @inheritDoc
     */
    public function getData(): array
    {
        // Prevent infinite recursion: don't serialize nested user_status
        return [];
    }

    public function getDataKeys(): array
    {
        return [
            'id',
            'code',
            'name',
            'is_user_show',
            'user_status_id',
            'preview_text',
            'color',
            'user_status',
            'created_at',
            'updated_at',
        ];
    }

    protected function getEvent(): string
    {
        // Paste below code in PlanetaDelEste\ApiOrdersShopaholic\Plugin class
        // const EVENT_ITEMRESOURCE_DATA = 'planetadeleste.apiordersshopaholic.resource.itemData';
        return Plugin::EVENT_ITEMRESOURCE_DATA . '.status';
    }
}
