<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Controllers\Api;

use Event;
use Exception;
use Kharanenka\Helper\Result;
use Lovata\OrdersShopaholic\Classes\Collection\OrderCollection;
use Lovata\OrdersShopaholic\Components\MakeOrder;
use Lovata\OrdersShopaholic\Models\Order;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order\IndexCollection;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order\ListCollection;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order\OrderIndexCollection;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order\OrderListCollection;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order\OrderShowResource;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order\ShowResource;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Store\OrderListStore;
use PlanetaDelEste\ApiOrdersShopaholic\Plugin;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\OrderPosition\IndexCollection as OrderPositionIndexCollection;
use PlanetaDelEste\ApiToolbox\Classes\Api\Base;
use PlanetaDelEste\ApiToolbox\Plugin as ApiToolboxPlugin;

/**
 * Class Orders
 *
 * @property \Lovata\OrdersShopaholic\Classes\Collection\OrderCollection $collection
 * @package PlanetaDelEste\ApiShopaholic\Controllers\Api
 */
class Orders extends Base
{
    public function init(): void
    {
        $this->bindEvent(
            ApiToolboxPlugin::EVENT_LOCAL_EXTEND_INDEX,
            function (OrderCollection $obCollection) {
                try {
                    $this->currentUser();
                    if (!$this->isBackend()) {
                        $obCollection->user($this->user->id);
                    }
                } catch (Exception $e) {
                    Result::setFalse()->setMessage($e->getMessage());
                    return response()->json(Result::get(), 403);
                }
            }
        );
    }

    /**
     * @return array|\Illuminate\Http\RedirectResponse
     * @throws \SystemException
     * @throws \Exception
     */
    public function create()
    {
        /** @var MakeOrder $obComponent */
        $obComponent = $this->component(MakeOrder::class);
        $obComponent->onCreate();
        $arResponseData = Event::fire(Plugin::EVENT_API_ORDER_RESPONSE_DATA, [Result::data()]);

        if (!empty($arResponseData)) {
            $arResultData = Result::data();
            foreach ($arResponseData as $arData) {
                if (empty($arData) || !is_array($arData)) {
                    continue;
                }

                $arResultData += $arData;
            }

            Result::setData($arResultData);
        }

        return Result::get();
    }

    public function positions($sValue)
    {
        try {
            $iOrderId = $this->getItemId($sValue);
            if (!$iOrderId) {
                throw new Exception(static::ALERT_RECORD_NOT_FOUND, 403);
            }

            /** @var \Lovata\OrdersShopaholic\Classes\Item\OrderItem $obOrderItem */
            $obOrderItem = $this->getItem($iOrderId);
            if ($obOrderItem) {
                Result::setTrue();
                Result::setData(OrderPositionIndexCollection::make($obOrderItem->order_position->collect()));
            } else {
                Result::setFalse();
            }

            return Result::get();
        } catch (Exception $ex) {
            return static::exceptionResult($ex);
        }
    }

    public function ipn()
    {
        Event::fire(Plugin::EVENT_API_GATEWAY_IPN_RESPONSE, input());
    }

    public function getModelClass(): string
    {
        return Order::class;
    }

    public function getIndexResource(): string
    {
        return OrderIndexCollection::class;
    }

    public function getListResource(): string
    {
        return OrderListCollection::class;
    }

    public function getShowResource(): string
    {
        return OrderShowResource::class;
    }

    public function getPrimaryKey(): string
    {
        return $this->isBackend() ? 'id' : 'secret_key';
    }

    public function getSortColumn(): string
    {
        return OrderListStore::SORT_CREATED_AT_DESC;
    }
}
