<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order;

use Lovata\OrdersShopaholic\Classes\Item\OrderItem;

/**
 * Class ShowResource
 *
 * @mixin OrderItem
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order
 */
class OrderShowResource extends OrderItemResource
{
    public function getDataKeys()
    : array
    {
        return [
            'id',
            'user_id',
            'transaction_id',
            'property',
            'secret_key',
            'weight',

            'currency_id',
            'currency_symbol',

            'discount_position_total_price',
            'discount_position_total_price_value',
            'discount_shipping_price',
            'discount_shipping_price_value',
            'discount_total_price',
            'discount_total_price_value',

            'old_position_total_price',
            'old_position_total_price_value',
            'old_shipping_price',
            'old_shipping_price_value',
            'old_total_price',
            'old_total_price_value',

            'order_number',
            'order_position_id',
            'order_promo_mechanism_id',

            'payment_data',
            'payment_method',
            'payment_method_id',
            'payment_response',
            'payment_token',

            'total_price_value',
            'total_price',

            'position_total_price',
            'position_total_price_value',

            'shipping_price',
            'shipping_price_value',
            'shipping_tax_percent',
            'shipping_type_id',
            'shipping_type',

            'status_id',
            'status',
        ];
    }
}
