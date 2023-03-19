<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Event\Order;

use Lovata\OrdersShopaholic\Classes\Collection\OrderCollection;
use Lovata\OrdersShopaholic\Classes\Item\OrderItem;
use Lovata\Toolbox\Classes\Event\ModelHandler;
use Lovata\OrdersShopaholic\Models\Order;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Store\OrderListStore;
use PlanetaDelEste\ApiToolbox\Traits\Event\ModelHandlerTrait;

/**
 * Class OrderModelHandler
 *
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Event\Order
 */
class OrderModelHandler extends ModelHandler
{
    use ModelHandlerTrait;

    /** @var Order */
    protected $obElement;

    public function subscribe($obEvent)
    {
        parent::subscribe($obEvent);

        OrderCollection::extend(
            function ($obCollection) {
                $this->extendCollection($obCollection);
            }
        );
    }

    protected function extendCollection(OrderCollection $obCollection)
    {
        $obCollection->addDynamicMethod(
            'sort',
            function ($sSort = OrderListStore::SORT_CREATED_AT_DESC) use ($obCollection) {
                $arResultIDList = OrderListStore::instance()->sorting->get($sSort);
                return $obCollection->applySorting($arResultIDList);
            }
        );
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
    protected function afterCreate()
    {
        parent::afterCreate();

        $this->clearBySortingPublished();
    }

    /**
     * Clear cache by created_at
     */
    protected function clearBySortingPublished()
    {
        $this->clearSorting(['created_at']);
    }

    /**
     * After save event handler
     */
    protected function afterSave()
    {
        parent::afterSave();
    }

    /**
     * After delete event handler
     */
    protected function afterDelete()
    {
        parent::afterDelete();

        $this->clearBySortingPublished();
    }

    protected function getStoreClass(): string
    {
        return OrderListStore::class;
    }
}
