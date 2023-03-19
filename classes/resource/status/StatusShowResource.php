<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Status;

use Lovata\OrdersShopaholic\Classes\Item\StatusItem;

/**
 * Class ShowResource
 *
 * @mixin StatusItem
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Status
 */
class StatusShowResource extends StatusItemResource
{
    public function getDataKeys(): array
    {
        return [
            'id',
            'name',
            'name_for_user',
            'code',
            'preview_text',
            'is_user_show',
            'user_status_id',
            'color',
        ];
    }
}
