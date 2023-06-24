<?php

namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Event\Status;

use Lovata\OrdersShopaholic\Classes\Item\StatusItem;
use Lovata\OrdersShopaholic\Models\Status;
use Lovata\Toolbox\Classes\Event\ModelHandler;

/**
 * Class StatusModelHandler
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Event\Status
 */
class StatusModelHandler extends ModelHandler
{
    /** @var Status */
    protected $obElement;

    public function subscribe($obEvent)
    {
        parent::subscribe($obEvent);

        Status::extend(function (Status $obModel) {
            $obModel->addCachedField('color');
        });
    }

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass(): string
    {
        return Status::class;
    }

    /**
     * Get item class name
     * @return string
     */
    protected function getItemClass(): string
    {
        return StatusItem::class;
    }
}
