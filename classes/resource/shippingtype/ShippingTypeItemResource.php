<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\ShippingType;

use Lovata\OrdersShopaholic\Classes\Item\ShippingTypeItem;
use PlanetaDelEste\ApiToolbox\Classes\Resource\Base;
use PlanetaDelEste\ApiOrdersShopaholic\Plugin;

/**
 * Class ItemResource
 *
 * @mixin ShippingTypeItem
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\ShippingType
 */
class ShippingTypeItemResource extends Base
{
    /**
     * @return array|void
     */
    public function getData(): array
    {
        return [

        ];
    }

    public function getDataKeys(): array
    {
        return [
            'id',
            'name',
            'code',
            'price_value',
            'preview_text',
            'property',
            'api_class',

        ];
    }

    protected function getEvent(): string
    {
        // Paste below code in PlanetaDelEste\ApiOrdersShopaholic\Plugin class
        // const EVENT_ITEMRESOURCE_DATA = 'planetadeleste.apiordersshopaholic.resource.itemData';
        return Plugin::EVENT_ITEMRESOURCE_DATA.'.shippingtype';
    }
}
