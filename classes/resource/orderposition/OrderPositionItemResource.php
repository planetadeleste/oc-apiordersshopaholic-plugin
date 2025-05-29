<?php

namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\OrderPosition;

use Lovata\OrdersShopaholic\Classes\Item\OrderPositionItem;
use PlanetaDelEste\ApiOrdersShopaholic\Plugin;
use PlanetaDelEste\ApiShopaholic\Classes\Resource\Offer\ItemResource as ItemResourceOffer;
use PlanetaDelEste\ApiToolbox\Classes\Resource\Base;

/**
 * Class ItemResource
 *
 * @mixin OrderPositionItem
 *
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\OrderPosition
 */
class OrderPositionItemResource extends Base
{
    /**
     * @inheritDoc
     */
    public function getData(): array
    {
        return [
            'offer' => ItemResourceOffer::make($this->offer),
        ];
    }

    public function getDataKeys(): array
    {
        return [
            'id',
            'order_id',
            'item_id',
            'item_type',
            'quantity',
            'weight',
            'height',
            'length',
            'width',
            'created_at',
            'updated_at',
        ];
    }

    protected function getEvent(): string
    {
        // Paste below code in PlanetaDelEste\ApiOrdersShopaholic\Plugin class
        // const EVENT_ITEMRESOURCE_DATA = 'planetadeleste.apiordersshopaholic.resource.itemData';
        return Plugin::EVENT_ITEMRESOURCE_DATA.'.orderposition';
    }
}
