<?php
Route::get('shippingtypes/list', 'ShippingTypes@list')->name('shippingtypes.list');
Route::apiResource('shippingtypes', 'ShippingTypes', ['only' => ['index', 'show']]);

if (has_jwtauth_plugin()) {
    Route::middleware(['jwt.auth'])
        ->group(function () {
            Route::apiResource(
                'shippingtypes',
                'ShippingTypes',
                [
                    'only' => [
                        'store',
                        'update',
                        'destroy'
                    ]
                ]
            );
        });
}
