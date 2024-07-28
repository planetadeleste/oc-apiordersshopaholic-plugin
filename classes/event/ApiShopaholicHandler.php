<?php

namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Event;

use Lovata\OrdersShopaholic\Classes\Collection\CartPositionCollection;
use Lovata\OrdersShopaholic\Classes\Collection\OrderCollection;
use Lovata\OrdersShopaholic\Classes\Collection\OrderPositionCollection;
use Lovata\OrdersShopaholic\Classes\Collection\PaymentMethodCollection;
use Lovata\OrdersShopaholic\Classes\Collection\ShippingTypeCollection;
use Lovata\OrdersShopaholic\Classes\Collection\StatusCollection;
use Lovata\OrdersShopaholic\Classes\Collection\UserAddressCollection;
use Lovata\OrdersShopaholic\Models\CartPosition;
use Lovata\OrdersShopaholic\Models\Order;
use Lovata\OrdersShopaholic\Models\OrderPosition;
use Lovata\OrdersShopaholic\Models\PaymentMethod;
use Lovata\OrdersShopaholic\Models\ShippingType;
use Lovata\OrdersShopaholic\Models\Status;
use Lovata\OrdersShopaholic\Models\UserAddress;
use October\Rain\Events\Dispatcher;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\UserAddress\UserAddressIndexCollection;
use PlanetaDelEste\ApiShopaholic\Classes\Resource\User\ItemResource;
use PlanetaDelEste\ApiShopaholic\Plugin as PluginApiShopaholic;
use PlanetaDelEste\ApiToolbox\Plugin;

class ApiShopaholicHandler
{
    public function subscribe(Dispatcher $obEvent): void
    {
        $obEvent->listen(
            Plugin::EVENT_API_ADD_COLLECTION,
            function () {
                return $this->addCollections();
            }
        );

        $obEvent->listen(
            PluginApiShopaholic::EVENT_ITEMRESOURCE_DATA.'.user',
            static function (ItemResource $obItemResource): array {
                return [
                    'address' => $obItemResource->address
                        ? UserAddressIndexCollection::make(collect($obItemResource->address))
                        : null,
                ];
            }
        );
    }

    /**
     * @return array{CartPosition.class: \class-string, \Lovata\OrdersShopaholic\Models\Order.class: \class-string, \Lovata\OrdersShopaholic\Models\OrderPosition.class: \class-string, \Lovata\OrdersShopaholic\Models\PaymentMethod.class: \class-string, \Lovata\OrdersShopaholic\Models\Status.class: \class-string, \Lovata\OrdersShopaholic\Models\ShippingType.class: \class-string, \Lovata\OrdersShopaholic\Models\UserAddress.class: \class-string}
     */
    protected function addCollections(): array
    {
        return [
            CartPosition::class  => CartPositionCollection::class,
            Order::class         => OrderCollection::class,
            OrderPosition::class => OrderPositionCollection::class,
            PaymentMethod::class => PaymentMethodCollection::class,
            Status::class        => StatusCollection::class,
            ShippingType::class  => ShippingTypeCollection::class,
            UserAddress::class   => UserAddressCollection::class,
        ];
    }
}
