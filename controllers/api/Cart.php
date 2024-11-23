<?php

namespace PlanetaDelEste\ApiOrdersShopaholic\Controllers\Api;

use Cms\Classes\ComponentBase;
use Exception;
use Illuminate\Http\JsonResponse;
use Kharanenka\Helper\Result;
use Lovata\OrdersShopaholic\Classes\Item\CartPositionItem;
use Lovata\OrdersShopaholic\Classes\Item\ShippingTypeItem;
use Lovata\OrdersShopaholic\Classes\Processor\CartProcessor;
use Lovata\OrdersShopaholic\Classes\Processor\OfferCartPositionProcessor;
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
     *
     * @throws SystemException
     */
    public function getData(): array
    {
        return $this->cartComponent()->onGetCartData();
    }

    /**
     * @return ComponentBase|CartComponent
     *
     * @throws SystemException
     */
    protected function cartComponent()
    {
        return $this->component(CartComponent::class);
    }

    /**
     * @return array
     *
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
     * @param int|null $iShippingTypeId
     *
     * @return array|ElementItem[]
     *
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

                $obOffer               = $obCartPositionItem->offer;
                $arCartDataPositions[] = [
                    'id'                   => $obCartPositionItem->id,
                    'offer'                => ShowResourceOffer::make($obOffer),
                    'product'              => ItemResourceProduct::make($obOffer->product),
                    'price'                => $obOffer->price,
                    'currency'             => $obOffer->currency,
                    'total'                => $obCartPositionItem->price,
                    'total_value'          => $obCartPositionItem->price_value,
                    'quantity'             => $obCartPositionItem->quantity,
                    'price_per_unit'       => $obCartPositionItem->price_per_unit,
                    'price_per_unit_value' => $obCartPositionItem->price_per_unit_value,
                    'property'             => $obCartPositionItem->property,
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
     * @param int $id
     *
     * @throws SystemException
     */
    public function update($id = null): JsonResponse|string
    {
        $arRequestData = input('cart');

        CartProcessor::instance()->update($arRequestData, OfferCartPositionProcessor::class);
        Result::setData(CartProcessor::instance()->getCartData());

        if (!input('return_data')) {
            Result::setData($this->get());
        }

        return Result::getJSON();
    }

    /**
     * @return array|ElementItem[]
     *
     * @throws SystemException
     */
    public function remove(): array
    {
        $arRequestData = input('cart');
        $sType = input('type', 'offer');

        if(!CartProcessor::instance()->remove($arRequestData, OfferCartPositionProcessor::class, $sType)) {
            return Result::get();
        }

        Result::setData(CartProcessor::instance()->getCartData());
        $response = Result::get();

        if (!input('return_data')) {
            return $this->get();
        }

        return $response;
    }
}
