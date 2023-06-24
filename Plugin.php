<?php

namespace PlanetaDelEste\ApiOrdersShopaholic;

use Event;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Event\ApiShopaholicHandler;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Event\Order\OrderModelHandler;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Event\Status\StatusModelHandler;
use System\Classes\PluginBase;

/**
 * Class Plugin
 * @package PlanetaDelEste\ApiOrdersShopaholic
 */
class Plugin extends PluginBase
{
    public const EVENT_ITEMRESOURCE_DATA = 'planetadeleste.apiordersshopaholic.resource.itemData';
    public const EVENT_API_ORDER_RESPONSE_DATA = 'planetadeleste.apiordersshopaholic.apiOrderResponseData';
    public const EVENT_API_GATEWAY_IPN_RESPONSE = 'planetadeleste.apiordersshopaholic.apiGatewayIpnResponse';

    public $require = [
        'Lovata.OrdersShopaholic',
        'PlanetaDelEste.ApiToolbox'
    ];

    public function boot()
    {
        $arClasses = [
            ApiShopaholicHandler::class,
            OrderModelHandler::class,
            StatusModelHandler::class,
        ];

        array_walk($arClasses, [Event::class, 'subscribe']);
    }
}
