<?php

namespace PlanetaDelEste\ApiOrdersShopaholic\Controllers\Api;

use Exception;
use Illuminate\Http\JsonResponse;
use Kharanenka\Helper\Result;
use Lang;
use Lovata\Buddies\Models\User;
use Lovata\OrdersShopaholic\Models\UserAddress as UserAddressModel;
use Lovata\Toolbox\Classes\Helper\UserHelper;
use October\Rain\Database\ModelException;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\UserAddress\UserAddressIndexCollection;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\UserAddress\UserAddressListCollection;
use PlanetaDelEste\ApiOrdersShopaholic\Classes\Resource\UserAddress\UserAddressShowResource;
use PlanetaDelEste\ApiToolbox\Classes\Api\Base;
use SystemException;

class UserAddresses extends Base
{
    /**
     * Get current user addresses
     *
     * @param integer|string|null $iUserId
     *
     * @return array|JsonResponse
     *
     * @throws Exception
     */
    public function address(int|string|null $iUserId = null): JsonResponse|array
    {
        try {
            $this->currentUser();
            $obUser = $this->user;

            if ($iUserId && $this->userInGroup('admin')) {
                $obUser = User::active()->find($iUserId);
            }

            if (!$obUser) {
                return Result::setFalse()->get();
            }

            $obAddress = UserAddressModel::getByUser($obUser->id)
                ->where(static function ($obQuery) {
                    return $obQuery->whereNotNull('street')->orWhereNotNull('address1');
                })
                ->get();
            $arAddress = UserAddressIndexCollection::make($obAddress);

            return Result::setData($arAddress)->get();
        } catch (Exception $e) {
            return static::exceptionResult($e);
        }
    }

    /**
     * @return array
     *
     * @throws Exception
     */
    public function addAddress(): array
    {
        $arAddressData = input();
        $iUserID       = $this->userInGroup('admin')
            ? array_get($arAddressData, 'user_id')
            : UserHelper::instance()->getUserId();

        if (empty($arAddressData) || empty($iUserID)) {
            $sMessage = Lang::get('lovata.toolbox::lang.message.e_not_correct_request');

            return Result::setFalse()->setMessage($sMessage)->get();
        }

        $obAddress = UserAddressModel::findAddressByData($arAddressData, $iUserID);

        if (!empty($obAddress)) {
            $sMessage = Lang::get('lovata.ordersshopaholic::lang.message.e_address_exists');

            return Result::setFalse()->setMessage($sMessage)->get();
        }

        $arAddressData['user_id'] = $iUserID;
        $this->createAddressObject($arAddressData);

        return Result::get();
    }

    /**
     * Create address object
     *
     * @param array $arAddressData
     *
     * @return array|JsonResponse|void
     */
    public function createAddressObject(array $arAddressData)
    {
        if (empty($arAddressData)) {
            return Result::get();
        }

        Result::setData(['id' => null]);

        try {
            $obAddress = UserAddressModel::create($arAddressData);

            if (!empty($obAddress)) {
                Result::setData(['id' => $obAddress->id]);
            }
        } catch (ModelException $obException) {
            return static::exceptionResult($obException);
        }
    }

    /**
     * @return array
     */
    public function updateAddress(): array
    {
        $arAddressData = input();
        $iAddressID    = array_get($arAddressData, 'id');

        $iUserID   = $this->userInGroup('admin')
            ? array_get($arAddressData, 'user_id')
            : UserHelper::instance()->getUserId();
        $obAddress = UserAddressModel::findAddressByData($arAddressData, $iUserID);

        if (empty($arAddressData) || empty($iAddressID) || empty($iUserID)) {
            $sMessage = Lang::get('lovata.toolbox::lang.message.e_not_correct_request');

            return Result::setFalse()->setMessage($sMessage)->get();
        }

        if (!empty($obAddress) && $obAddress->id != $iAddressID) {
            $sMessage = Lang::get('lovata.ordersshopaholic::lang.message.e_address_exists');

            return Result::setFalse()->setMessage($sMessage)->get();
        }

        // Find address object by ID
        $obAddress = UserAddressModel::getByUser($iUserID)->find($arAddressData['id']);

        if (empty($obAddress)) {
            $sMessage = Lang::get('lovata.toolbox::lang.message.e_not_correct_request');

            return Result::setFalse()->setMessage($sMessage)->get();
        }

        $this->updateAddressObject($obAddress, $arAddressData);

        return Result::get();
    }

    /**
     * Update address object
     *
     * @param UserAddressModel $obAddress
     * @param array            $arAddressData
     *
     * @return array|JsonResponse|void
     */
    public function updateAddressObject(UserAddressModel $obAddress, array $arAddressData)
    {
        if (empty($obAddress) || empty($arAddressData)) {
            return Result::get();
        }

        try {
            $obAddress->update($arAddressData);
        } catch (ModelException $obException) {
            return static::exceptionResult($obException);
        }
    }

    /**
     * @return array
     *
     * @throws SystemException
     * @throws Exception
     */
    public function removeAddress(): array
    {
        $arAddressIDList = array_wrap(input('id'));
        $iUserID         = $this->userInGroup('admin')
            ? input('user_id')
            : UserHelper::instance()->getUserId();

        if (empty($arAddressIDList) || empty($iUserID)) {
            $sMessage = Lang::get('lovata.toolbox::lang.message.e_not_correct_request');

            return Result::setFalse()->setMessage($sMessage)->get();
        }

        foreach ($arAddressIDList as $iAddressID) {
            // Find address object by ID
            $obAddress = UserAddressModel::getByUser($iUserID)->find($iAddressID);

            if (empty($obAddress)) {
                continue;
            }

            $obAddress->delete();
        }

        return Result::get();
    }

    public function getModelClass(): string
    {
        return UserAddressModel::class;
    }

    public function getShowResource(): string
    {
        return UserAddressShowResource::class;
    }

    public function getIndexResource(): string
    {
        return UserAddressIndexCollection::class;
    }

    public function getListResource(): string
    {
        return UserAddressListCollection::class;
    }
}
