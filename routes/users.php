<?php
if (has_jwtauth_plugin()) {
    Route::middleware(['jwt.auth'])
        ->group(
            function () {
                Route::prefix('users')
                    ->name('users.')
                    ->group(
                        function () {
                            Route::get('{id}/address', 'UserAddresses@address')->name('address');
                            Route::post('address/add', 'UserAddresses@addAddress')->name('address.add');
                            Route::post('address/update', 'UserAddresses@updateAddress')->name('address.update');
                            Route::post('address/remove', 'UserAddresses@removeAddress')->name('address.remove');
                        }
                    );
            }
        );
}
