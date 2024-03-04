<?php

namespace PlanetaDelEste\ApiOrdersShopaholic\Controllers\Api;

use Cms\Classes\ComponentBase;
use Exception;
use Illuminate\Http\JsonResponse;
use Kharanenka\Helper\Result;
use Lovata\OrdersShopaholic\Classes\Item\CartPositionItem;
use Lovata\OrdersShopaholic\Classes\Item\ShippingTypeItem;
use Lovata\OrdersShopaholic\Components\Cart as CartComponent;
use Lovata\Shopaholic\Models\Offer;
use Lovata\Toolbox\Classes\Item\ElementItem;
use PlanetaDelEste\ApiShopaholic\Classes\Resource\Offer\ShowResource as ShowResourceOffer;
use PlanetaDelEste\ApiShopaholic\Classes\Resource\Product\ItemResource as ItemResourceProduct;
use PlanetaDelEste\ApiToolbox\Classes\Api\Base;
use SystemException;

class Cart extends Base
{
    /**
     * @return array
     * @throws SystemException
     */
    public function getData(): array
    {
        return $this->cartComponent()->onGetCartData();
    }

    /**
     * @return array
     * @throws SystemException
     * @throws Exception
     */
    public function add(): array
    {
        $response = $this->cartComponent()->onAdd();
        if (!input('return_data')) {
            return $this->get();
        }

        return $response;
    }

    /**
     * @param int $id
     *
     * @return JsonResponse|string
     * @throws SystemException
     */
    public function update($id = null): JsonResponse|string
    {
        $response = $this->cartComponent()->onUpdate();
        if (!input('return_data')) {
            return $this->get();
        }

        return $response;
    }

    /**
     * @return array|ElementItem[]
     * @throws SystemException
     */
    public function remove(): array
    {
        $response = $this->cartComponent()->onRemove();
        if (!input('return_data')) {
            return $this->get();
        }

        return $response;
    }

    /**
     * @param int|null $iShippingTypeId
     *
     * @return array|ElementItem[]
     * @throws SystemException
     * @throws Exception
     */
    public function get($iShippingTypeId = null): array
    {
        $obShippingTypeItem       = $iShippingTypeId ? ShippingTypeItem::make($iShippingTypeId) : null;
        $obCartPositionCollection = $this->cartComponent()->get($obShippingTypeItem);
        $arCartData               = [];
        if ($obCartPositionCollection->isNotEmpty()) {
            $arCartDataPositions = [];
            foreach ($obCartPositionCollection as $obCartPositionItem) {
                /** @var CartPositionItem $obCartPositionItem */
                /** @var Offer $obOfferModel */

                $obOffer = $obCartPositionItem->offer;
                //                $obOfferModel = $obOffer->getObject();
                $arCartDataPositions[] = [
                    'offer'                => ShowResourceOffer::make($obOffer),
                    'product'              => ItemResourceProduct::make($obOffer->product),
                    'price'                => $obOffer->price,
                    'currency'             => $obOffer->currency,
                    'total'                => $obCartPositionItem->price,
                    'total_value'          => $obCartPositionItem->price_value,
                    'quantity'             => $obCartPositionItem->quantity,
                    'price_per_unit'       => $obCartPositionItem->price_per_unit,
                    'price_per_unit_value' => $obCartPositionItem->price_per_unit_value,
                ];
            }

            $arCartData = [
                'positions'   => $arCartDataPositions,
                'currency'    => $obCartPositionCollection->getCurrency(),
                'total'       => $obCartPositionCollection->getTotalPrice(),
                'total_value' => $obCartPositionCollection->getTotalPriceValue(),
            ];
        }

        return Result::setData($arCartData)->get();
    }

    /**
     * @return ComponentBase|CartComponent
     * @throws SystemException
     */
    protected function cartComponent()
    {
        return $this->component(CartComponent::class);
    }
}
