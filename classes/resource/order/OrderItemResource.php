<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order;

use Lovata\OrdersShopaholic\Classes\Item\OrderItem;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\PaymentMethod\PaymentMethodItemResource;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\ShippingType\ShippingTypeItemResource;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Status\StatusItemResource;
use PlanetaDelEste\ApiToolbox\Classes\Resource\Base;
use PlanetaDelEste\ApiOrdersShopaholic\Plugin;

/**
 * Class ItemResource
 *
 * @mixin OrderItem
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order
 */
class OrderItemResource extends Base
{
    /**
     * @return array|void
     */
    public function getData(): array
    {
        return [
            'shipping_price_value'                => (float)$this->shipping_price_value,
            'old_shipping_price_value'            => (float)$this->old_shipping_price_value,
            'discount_shipping_price_value'       => (float)$this->discount_shipping_price_value,
            'total_price_value'                   => (float)$this->total_price_value,
            'old_total_price_value'               => (float)$this->old_total_price_value,
            'discount_total_price_value'          => (float)$this->discount_total_price_value,
            'position_total_price_value'          => (float)$this->position_total_price_value,
            'old_position_total_price_value'      => (float)$this->old_position_total_price_value,
            'discount_position_total_price_value' => (float)$this->discount_position_total_price_value,
            'status'                              => $this->status?->id ? StatusItemResource::make($this->status) : null,
            'payment_method'                      => $this->payment_method?->id ? PaymentMethodItemResource::make($this->payment_method) : null,
            'shipping_type'                       => $this->shipping_type?->id ? ShippingTypeItemResource::make($this->shipping_type) : null,
        ];
    }

    public function getDataKeys(): array
    {
        return ['id', 'order_number', 'currency_symbol', 'total_price'];
    }

    protected function getEvent(): string
    {
        // Paste below code in PlanetaDelEste\ApiOrdersShopaholic\Plugin class
        // const EVENT_ITEMRESOURCE_DATA = 'planetadeleste.apiordersshopaholic.resource.itemData';
        return Plugin::EVENT_ITEMRESOURCE_DATA . '.order';
    }
}
