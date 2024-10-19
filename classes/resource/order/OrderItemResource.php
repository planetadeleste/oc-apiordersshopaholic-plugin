<?php

namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order;

use Lovata\OrdersShopaholic\Classes\Item\OrderItem;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\PaymentMethod\PaymentMethodItemResource;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\ShippingType\ShippingTypeItemResource;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Status\StatusItemResource;
use PlanetaDelEste\ApiOrdersShopaholic\Plugin;
use PlanetaDelEste\ApiToolbox\Classes\Resource\Base;

/**
 * Class ItemResource
 *
 * @mixin OrderItem
 *
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order
 */
class OrderItemResource extends Base
{
    /**
     * @var array<string>
     */
    protected $casts = [
        'shipping_price_value'                => 'float',
        'old_shipping_price_value'            => 'float',
        'discount_shipping_price_value'       => 'float',
        'total_price_value'                   => 'float',
        'old_total_price_value'               => 'float',
        'discount_total_price_value'          => 'float',
        'position_total_price_value'          => 'float',
        'old_position_total_price_value'      => 'float',
        'discount_position_total_price_value' => 'float',
    ];

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'status'         => $this->status->isNotEmpty() ? StatusItemResource::make($this->status) : null,
            'payment_method' => $this->payment_method->isNotEmpty() ? PaymentMethodItemResource::make($this->payment_method) : null,
            'shipping_type'  => $this->shipping_type->isNotEmpty() ? ShippingTypeItemResource::make($this->shipping_type) : null,
        ];
    }

    /**
     * @return array<string>
     */
    public function getDataKeys(): array
    {
        return ['id', 'order_number', 'currency_symbol', 'total_price', 'description', 'created_at', 'updated_at'];
    }

    /**
     * @return string
     */
    protected function getEvent(): string
    {
        // Paste below code in PlanetaDelEste\ApiOrdersShopaholic\Plugin class
        // const EVENT_ITEMRESOURCE_DATA = 'planetadeleste.apiordersshopaholic.resource.itemData';
        return Plugin::EVENT_ITEMRESOURCE_DATA.'.order';
    }
}
