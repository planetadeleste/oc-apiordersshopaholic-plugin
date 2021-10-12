<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\PaymentMethod;

use PlanetaDelEste\ApiToolbox\Classes\Resource\Base;
use PlanetaDelEste\ApiOrdersShopaholic\Plugin;

/**
 * Class ItemResource
 *
 * @mixin \Lovata\OrdersShopaholic\Classes\Item\PaymentMethodItem
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\PaymentMethod
 */
class PaymentMethodItemResource extends Base
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
            'preview_text',
            'restriction',
        ];
    }

    protected function getEvent(): string
    {
        // Paste below code in PlanetaDelEste\ApiOrdersShopaholic\Plugin class
        // const EVENT_ITEMRESOURCE_DATA = 'planetadeleste.apiordersshopaholic.resource.itemData';
        return Plugin::EVENT_ITEMRESOURCE_DATA.'.paymentmethod';
    }
}
