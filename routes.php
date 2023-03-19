<?php
Route::prefix('api/v1')
    ->namespace('PlanetaDelEste\ApiOrdersShopaholic\Controllers\Api')
    ->middleware(['throttle:120,1', 'bindings'])
    ->group(
        function () {
            $sPath = plugins_path('planetadeleste/apiordersshopaholic/routes');
            $arFiles = File::glob($sPath . '/*.php');
            foreach ($arFiles as $sRoute) {
                Route::group([], $sRoute);
            }
        }
    );
