<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Event;

use Lovata\OrdersShopaholic\Classes\Collection\CartPositionCollection;
use Lovata\OrdersShopaholic\Classes\Collection\OrderCollection;
use Lovata\OrdersShopaholic\Classes\Collection\OrderPositionCollection;
use Lovata\OrdersShopaholic\Classes\Collection\PaymentMethodCollection;
use Lovata\OrdersShopaholic\Classes\Collection\ShippingTypeCollection;
use Lovata\OrdersShopaholic\Classes\Collection\StatusCollection;
use Lovata\OrdersShopaholic\Models\CartPosition;
use Lovata\OrdersShopaholic\Models\Order;
use Lovata\OrdersShopaholic\Models\OrderPosition;
use Lovata\OrdersShopaholic\Models\PaymentMethod;
use Lovata\OrdersShopaholic\Models\ShippingType;
use Lovata\OrdersShopaholic\Models\Status;
use October\Rain\Events\Dispatcher;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\UserAddress\IndexCollection;
use PlanetaDelEste\ApiShopaholic\Classes\Resource\User\ItemResource;
use PlanetaDelEste\ApiShopaholic\Plugin as PluginApiShopaholic;
use PlanetaDelEste\ApiToolbox\Plugin;

class ApiShopaholicHandler
{
    public function subscribe(Dispatcher $obEvent)
    {
        $obEvent->listen(
            Plugin::EVENT_API_ADD_COLLECTION,
            function () {
                return $this->addCollections();
            }
        );

        $obEvent->listen(
            PluginApiShopaholic::EVENT_ITEMRESOURCE_DATA . '.user',
            function (ItemResource $obItemResource, $arData) {
                return [
                    'address' => $obItemResource->address
                        ? IndexCollection::make(collect($obItemResource->address))
                        : null,
                ];
            }
        );
    }

    protected function addCollections(): array
    {
        return [
            CartPosition::class  => CartPositionCollection::class,
            Order::class         => OrderCollection::class,
            OrderPosition::class => OrderPositionCollection::class,
            PaymentMethod::class => PaymentMethodCollection::class,
            Status::class        => StatusCollection::class,
            ShippingType::class  => ShippingTypeCollection::class,
        ];
    }
}
