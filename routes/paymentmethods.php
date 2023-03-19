<?php
Route::apiResource('paymentmethods', 'PaymentMethods', ['only' => ['index', 'show']]);

if (has_jwtauth_plugin()) {
    Route::middleware(['jwt.auth'])
        ->group(function () {
            Route::apiResource(
                'paymentmethods',
                'PaymentMethods',
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
