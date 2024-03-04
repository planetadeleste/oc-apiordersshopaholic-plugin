<?php

namespace PlanetaDelEste\ApiOrdersShopaholic\Controllers\Api;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Kharanenka\Helper\Result;
use Lovata\OrdersShopaholic\Classes\Item\OrderItem;
use Lovata\OrdersShopaholic\Models\Order;
use Lovata\OrdersShopaholic\Models\OrderPosition;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\OrderPosition\OrderPositionIndexCollection;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\OrderPosition\OrderPositionListCollection;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\OrderPosition\OrderPositionShowResource;
use PlanetaDelEste\ApiToolbox\Classes\Api\Base;

/**
 * Class Positions
 *
 * @package PlanetaDelEste\ApiOrdersShopaholic\Controllers\Api
 */
class Positions extends Base
{
    public function index(): LengthAwarePaginator|ResourceCollection|JsonResponse
    {
        try {
            $iOrderId = func_get_arg(0);
            if (!$iOrderId) {
                throw new Exception(static::ALERT_RECORD_NOT_FOUND, 403);
            }

            if (!$this->isBackend() && !is_numeric($iOrderId)) {
                $iOrderId = Order::getBySecretKey($iOrderId)->first(['id'])->id;
            }

            /** @var OrderItem $obOrderItem */
            $obOrderItem = OrderItem::make($iOrderId);
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

    public function getModelClass(): string
    {
        return OrderPosition::class;
    }

    public function getSortColumn(): string
    {
        return 'sort';
    }

    public function getShowResource(): string
    {
        return OrderPositionShowResource::class;
    }

    public function getIndexResource(): string
    {
        return OrderPositionIndexCollection::class;
    }

    public function getListResource(): string
    {
        return OrderPositionListCollection::class;
    }
}
