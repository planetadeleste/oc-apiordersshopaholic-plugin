<?php

namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Event\Order;

use Lovata\OrdersShopaholic\Classes\Collection\OrderCollection;
use Lovata\OrdersShopaholic\Classes\Item\OrderItem;
use Lovata\OrdersShopaholic\Models\Order;
use Lovata\Toolbox\Classes\Event\ModelHandler;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Store\OrderListStore;
use PlanetaDelEste\ApiToolbox\Traits\Event\ModelHandlerTrait;

/**
 * Class OrderModelHandler
 */
class OrderModelHandler extends ModelHandler
{
    use ModelHandlerTrait;

    /**
     * @var Order
     */
    protected $obElement;

    public function subscribe($obEvent): void
    {
        parent::subscribe($obEvent);

        OrderCollection::extend(
            function ($obCollection): void {
                $this->extendCollection($obCollection);
            }
        );

        Order::extend(
            function ($obModel): void {
                $this->extendModel($obModel);
            }
        );
    }

    /**
     * @param OrderCollection $obCollection
     *
     * @return void
     */
    protected function extendCollection(OrderCollection $obCollection): void
    {
        $obCollection->addDynamicMethod(
            'sort',
            static function ($sSort = OrderListStore::SORT_CREATED_AT_DESC) use ($obCollection) {
                $arResultIDList = OrderListStore::instance()->sorting->get($sSort);

                return $obCollection->applySorting($arResultIDList);
            }
        );
    }

    /**
     * @param Order $obModel
     *
     * @return void
     */
    protected function extendModel(Order $obModel): void
    {
        $obModel->addCachedField(['description']);
    }

    /**
     * Get model class name
     *
     * @return string
     */
    protected function getModelClass(): string
    {
        return Order::class;
    }

    /**
     * Get item class name
     *
     * @return string
     */
    protected function getItemClass(): string
    {
        return OrderItem::class;
    }

    /**
     * After create event handler
     */
    protected function afterCreate(): void
    {
        parent::afterCreate();

        $this->clearBySortingPublished();
    }

    /**
     * Clear cache by created_at
     */
    protected function clearBySortingPublished(): void
    {
        $this->clearSorting(['created_at']);
    }

    /**
     * After save event handler
     */
    protected function afterSave(): void
    {
        parent::afterSave();
    }

    /**
     * After delete event handler
     */
    protected function afterDelete(): void
    {
        parent::afterDelete();

        $this->clearBySortingPublished();
    }

    /**
     * @return string
     */
    protected function getStoreClass(): string
    {
        return OrderListStore::class;
    }
}
