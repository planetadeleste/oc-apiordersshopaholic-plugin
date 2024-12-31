<?php

namespace PlanetaDelEste\ApiOrdersShopaholic;

use Event;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Event\ApiShopaholicHandler;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Event\Order\OrderModelHandler;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Event\Status\StatusModelHandler;
use System\Classes\PluginBase;

/**
 * Class Plugin
 */
class Plugin extends PluginBase
{
    public const string EVENT_ITEMRESOURCE_DATA        = 'planetadeleste.apiordersshopaholic.resource.itemData';
    public const string EVENT_API_ORDER_RESPONSE_DATA  = 'planetadeleste.apiordersshopaholic.apiOrderResponseData';
    public const string EVENT_API_GATEWAY_IPN_RESPONSE = 'planetadeleste.apiordersshopaholic.apiGatewayIpnResponse';

    /**
     * @var array<string>
     */
    public $require = [
        'Lovata.OrdersShopaholic',
        'PlanetaDelEste.ApiToolbox'
    ];

    /**
     * @return void
     */
    public function boot(): void
    {
        $arClasses = [
            ApiShopaholicHandler::class,
            OrderModelHandler::class,
            StatusModelHandler::class,
        ];

        array_walk($arClasses, [Event::class, 'subscribe']);
    }
}
