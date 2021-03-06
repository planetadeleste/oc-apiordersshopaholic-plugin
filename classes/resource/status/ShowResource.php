<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Status;

use PlanetaDelEste\ApiToolbox\Plugin;

/**
 * Class ShowResource
 *
 * @mixin \Lovata\OrdersShopaholic\Classes\Item\StatusItem
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\Status
 */
class ShowResource extends ItemResource
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

