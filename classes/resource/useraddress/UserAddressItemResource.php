<?php namespace PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\UserAddress;

use Lovata\OrdersShopaholic\Classes\Item\UserAddressItem;
use PlanetaDelEste\ApiToolbox\Classes\Resource\Base;
use PlanetaDelEste\ApiOrdersShopaholic\Plugin;
use RainLab\Location\Models\Country;
use RainLab\Location\Models\State;
use VojtaSvoboda\LocationTown\Models\Town;

/**
 * Class ItemResource
 *
 * @mixin UserAddressItem
 * @package PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\UserAddress
 */
class UserAddressItemResource extends Base
{
    /**
     * @return array|void
     */
    public function getData(): array
    {
        return [
            'country_text' => function () {
                /** @var Country $obCountry */
                $obCountry = is_numeric($this->country) ? Country::find($this->country) : null;
                if (!$obCountry) {
                    $obCountry = Country::getDefault();
                }

                return $obCountry ? $obCountry->name : $this->country;
            },
            'state_text'   => function () {
                /** @var State $obState */
                $obState = is_numeric($this->state) ? State::find($this->state) : null;

                return $obState ? $obState->name : $this->state;
            },
            'city_text'    => function () {
                /** @var Town $obCity */
                $obCity = is_numeric($this->city) ? Town::find($this->city) : null;

                return $obCity ? $obCity->name : $this->city;
            },
            'country'      => is_numeric($this->country) ? intval($this->country) : $this->country,
            'state'        => is_numeric($this->state) ? intval($this->state) : $this->state,
            'city'         => is_numeric($this->city) ? intval($this->city) : $this->city,
        ];
    }

    public function getDataKeys(): array
    {
        return [
            'id',
            'user_id',
            'type',
            'country',
            'state',
            'city',
            'street',
            'house',
            'building',
            'flat',
            'floor',
            'address1',
            'address2',
            'postcode',
        ];
    }

    protected function getEvent(): string
    {
        // Paste below code in PlanetaDelEste\ApiOrdersShopaholic\Plugin class
        // const EVENT_ITEMRESOURCE_DATA = 'planetadeleste.apiordersshopaholic.resource.itemData';
        return Plugin::EVENT_ITEMRESOURCE_DATA . '.useraddress';
    }
}
