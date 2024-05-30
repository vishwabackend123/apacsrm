<?php

Route::get('/', function () {
    return redirect('/admin/home');
});

// Authentication Routes...
$this->router->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->router->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->router->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->router->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->router->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->router->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->router->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->router->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->router->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Registration Routes..
$this->router->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->router->post('register', 'Auth\RegisterController@register')->name('auth.register');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    // vendor
    Route::resource('vendors', 'Admin\VendorController');
    Route::delete('vendors_perma_del/{id}', ['uses' => 'Admin\VendorController@perma_del', 'as' => 'vendors.perma_del']);
    Route::get('/export_sample_csv', ['uses' => 'Admin\VendorController@export_sample_vendor_csv', 'as' => 'vendors.export_sample_csv']);
    Route::get('/import_vendor_show', ['uses' => 'Admin\VendorController@import_vendor_show', 'as' => 'vendors.import_vendor_show']);
    Route::get('/export_vendor_csv', ['uses' => 'Admin\VendorController@export_vendor_csv', 'as' => 'vendors.export_vendor_csv']);
    Route::post('/import_csv', ['uses' => 'Admin\VendorController@import_csv', 'as' => 'vendors.import_csv']);

    //vendor details
    Route::resource('vendor-details', 'Admin\VendorDetailsController');

    Route::delete('vendors_details_perma_del/{id}', ['uses' => 'Admin\VendorDetailsController@perma_del', 'as' => 'vendor-details.perma_del']);
    Route::get('/details_export_sample_csv', ['uses' => 'Admin\VendorDetailsController@export_sample_vendor_csv', 'as' => 'vendor-details.export_sample_csv']);
    Route::get('/details_import_vendor_show', ['uses' => 'Admin\VendorDetailsController@import_vendor_show', 'as' => 'vendor-details.import_vendor_show']);
    Route::get('/details_export_vendor_csv', ['uses' => 'Admin\VendorDetailsController@export_vendor_csv', 'as' => 'vendor-details.export_vendor_csv']);
    Route::post('/details_import_csv', ['uses' => 'Admin\VendorDetailsController@import_csv', 'as' => 'vendor-details.import_csv']);

});
