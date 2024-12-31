<?php

namespace PlanetaDelEste\ApiOrdersShopaholic\Controllers\Api;

use Event;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Kharanenka\Helper\Result;
use Lovata\OrdersShopaholic\Classes\Collection\OrderCollection;
use Lovata\OrdersShopaholic\Classes\Item\OrderItem;
use Lovata\OrdersShopaholic\Components\MakeOrder;
use Lovata\OrdersShopaholic\Models\Order;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order\OrderIndexCollection;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order\OrderListCollection;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Order\OrderShowResource;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Store\OrderListStore;
use PlanetaDelEste\ApiOrdersShopaholic\Plugin;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\OrderPosition\OrderPositionIndexCollection;
use PlanetaDelEste\ApiToolbox\Classes\Api\Base;
use PlanetaDelEste\ApiToolbox\Plugin as ApiToolboxPlugin;
use SystemException;

/**
 * Class Orders
 *
 * @property OrderCollection $collection
 */
class Orders extends Base
{
    /**
     * @return void
     */
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
     * @return array|RedirectResponse
     *
     * @throws SystemException
     * @throws Exception
     */
    public function create(): array|RedirectResponse
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

    /**
     * @param mixed $sValue
     *
     * @return array|JsonResponse
     */
    public function positions(mixed $sValue): JsonResponse|array
    {
        try {
            $iOrderId = $this->getItemId($sValue);

            if (!$iOrderId) {
                throw new Exception(static::ALERT_RECORD_NOT_FOUND, 403);
            }

            /** @var OrderItem | null $obOrderItem */
            $obOrderItem = $this->getItem($iOrderId);

            if ($obOrderItem?->id) {
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

    /**
     * @return void
     */
    public function ipn(): void
    {
        Event::fire(Plugin::EVENT_API_GATEWAY_IPN_RESPONSE, input());
    }

    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return Order::class;
    }

    /**
     * @return string
     */
    public function getIndexResource(): string
    {
        return OrderIndexCollection::class;
    }

    /**
     * @return string
     */
    public function getListResource(): string
    {
        return OrderListCollection::class;
    }

    /**
     * @return string
     */
    public function getShowResource(): string
    {
        return OrderShowResource::class;
    }

    /**
     * @return string
     */
    public function getPrimaryKey(): string
    {
        return $this->isBackend() ? 'id' : 'secret_key';
    }

    /**
     * @return string
     */
    public function getSortColumn(): string
    {
        return OrderListStore::SORT_CREATED_AT_DESC;
    }
}
