<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order;

use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\PaymentMethod\PaymentMethodItemResource;
use PlanetaDelEste\ApiToolbox\Classes\Resource\Base as BaseResource;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Status\ItemResource as ItemResourceStatus;
use PlanetaDelEste\ApiOrdersShopaholic\Plugin;

/**
 * Class ItemResource
 *
 * @mixin \Lovata\OrdersShopaholic\Classes\Item\OrderItem
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order
 */
class ItemResource extends BaseResource
{
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
            'status'                              => ItemResourceStatus::make($this->status),
            'payment_method'                      => $this->payment_method
                ? PaymentMethodItemResource::make($this->payment_method)
                : null
        ];
    }

    public function getDataKeys(): array
    {
        return ['id', 'order_number', 'currency_symbol', 'total_price'];
    }

    protected function getEvent(): ?string
    {
        return Plugin::EVENT_ITEMRESOURCE_DATA.'.order';
    }
}
