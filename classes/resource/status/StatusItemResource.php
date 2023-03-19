<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Status;

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
        return [
            'offer' => ItemResourceOffer::make($this->offer)
        ];
    }

    public function getDataKeys(): array
    {
        return [
            'id',
            'order_id',
            'quantity',
            'weight',
            'height',
            'length',
            'width',
        ];
    }

    protected function getEvent(): string
    {
        // Paste below code in PlanetaDelEste\ApiOrdersShopaholic\Plugin class
        // const EVENT_ITEMRESOURCE_DATA = 'planetadeleste.apiordersshopaholic.resource.itemData';
        return Plugin::EVENT_ITEMRESOURCE_DATA.'.orderposition';
    }
}
