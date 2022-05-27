<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace'=>'admin', 'prefix'=>'adminpanel', 'as'=>'admin.'], function() {
    Route::any('/', 'AuthController@login')->name('login');
    Route::any('/forgot-password', 'AuthController@forgotPassword')->name('forgot-password');
    Route::any('/reset-password/{token}', 'AuthController@resetPassword')->name('reset-password');
    Route::post('/ckeditor-upload', 'CmsController@upload')->name('ckeditor-upload');
    Route::any('/401', 'AuthController@unauthorizedAccess')->name('401');    // Unauthorized access

    Route::group(['middleware' => 'backend'], function () {
        Route::get('/dashboard', 'AccountController@dashboard')->name('dashboard');
        Route::any('/profile', 'AccountController@profile')->name('profile');
        Route::post('/account/delete-uploaded-image', 'AccountController@deleteUploadedImage')->name('delete-uploaded-image');
        Route::any('/change-password', 'AccountController@changePassword')->name('change-password');
        Route::any('/generate-slug', 'AccountController@generateSlug')->name('generate-slug');
        Route::any('/logout', 'AuthController@logout')->name('logout');

        Route::group(['middleware' => 'admin'], function () {
            Route::any('/website-settings', 'AccountController@websiteSettings')->name('website-settings');

            Route::group(['prefix' => 'distributionArea', 'as' => 'distributionArea.'], function () {
                Route::get('/list', 'DistributionAreasController@list')->name('list');
                Route::post('/ajax-list-request', 'DistributionAreasController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/add', 'DistributionAreasController@add')->name('add');
                Route::post('/add-submit', 'DistributionAreasController@add')->name('add-submit');
                Route::get('/edit/{id}', 'DistributionAreasController@edit')->name('edit');
                Route::post('/edit-submit/{id}', 'DistributionAreasController@edit')->name('edit-submit');
                Route::get('/status/{id}', 'DistributionAreasController@status')->name('change-status');
                Route::get('/delete/{id}', 'DistributionAreasController@delete')->name('delete');
                Route::get('/sort', 'DistributionAreasController@sort')->name('sort');
                Route::post('/save-sort', 'DistributionAreasController@saveSort')->name('save-sort');
                Route::post('/bulk-actions', 'DistributionAreasController@bulkActions')->name('bulk-actions');
            });
            
            Route::group(['prefix' => 'distributor', 'as' => 'distributor.'], function () {
                Route::get('/list', 'DistributorsController@list')->name('list');
                Route::post('/ajax-list-request', 'DistributorsController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/add', 'DistributorsController@add')->name('add');
                Route::post('/add-submit', 'DistributorsController@add')->name('add-submit');
                Route::get('/edit/{id}', 'DistributorsController@edit')->name('edit');
                Route::post('/edit-submit/{id}', 'DistributorsController@edit')->name('edit-submit');
                Route::get('/status/{id}', 'DistributorsController@status')->name('change-status');
                Route::get('/delete/{id}', 'DistributorsController@delete')->name('delete');
                Route::post('/bulk-actions', 'DistributorsController@bulkActions')->name('bulk-actions');
            });

            Route::group(['prefix' => 'store', 'as' => 'store.'], function () {
                Route::get('/list', 'StoresController@list')->name('list');
                Route::post('/ajax-list-request', 'StoresController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/add', 'StoresController@add')->name('add');
                Route::post('/add-submit', 'StoresController@add')->name('add-submit');
                Route::get('/edit/{id}', 'StoresController@edit')->name('edit');
                Route::post('/edit-submit/{id}', 'StoresController@edit')->name('edit-submit');
                Route::get('/status/{id}', 'StoresController@status')->name('change-status');
                Route::get('/delete/{id}', 'StoresController@delete')->name('delete');
                Route::post('/bulk-actions', 'StoresController@bulkActions')->name('bulk-actions');
            });

            Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
                Route::get('/', 'CategoriesController@list')->name('list');
                Route::post('ajax-list-request', 'CategoriesController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/add', 'CategoriesController@add')->name('add');
                Route::post('/add-submit', 'CategoriesController@add')->name('add-submit');
                Route::get('/edit/{id}', 'CategoriesController@edit')->name('edit');
                Route::any('/edit-submit/{id}', 'CategoriesController@edit')->name('edit-submit');
                Route::get('/status/{id}', 'CategoriesController@status')->name('change-status');
                Route::get('/delete/{id}', 'CategoriesController@delete')->name('delete');
                Route::post('/bulk-actions', 'CategoriesController@bulkActions')->name('bulk-actions');
            });

            Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
                Route::get('/', 'ProductsController@list')->name('list');
                Route::post('ajax-list-request', 'ProductsController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/add', 'ProductsController@add')->name('add');
                Route::post('/add-submit', 'ProductsController@add')->name('add-submit');
                Route::get('/edit/{id}', 'ProductsController@edit')->name('edit');
                Route::any('/edit-submit/{id}', 'ProductsController@edit')->name('edit-submit');
                Route::get('/status/{id}', 'ProductsController@status')->name('change-status');
                Route::get('/delete/{id}', 'ProductsController@delete')->name('delete');
                Route::post('/bulk-actions', 'ProductsController@bulkActions')->name('bulk-actions');
            });

            Route::group(['prefix' => 'areaAnalysis', 'as' => 'areaAnalysis.'], function () {
                Route::get('/', 'AreaAnalysesController@list')->name('list');
                Route::post('ajax-list-request', 'AreaAnalysesController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/add', 'AreaAnalysesController@add')->name('add');
                Route::post('/add-submit', 'AreaAnalysesController@add')->name('add-submit');
                Route::post('/ajax-distribution-area-wise-distributors-stores', 'AreaAnalysesController@ajaxDistributionAreaWiseDistributorsStores')->name('ajax-distribution-area-wise-distributors-stores');
                Route::post('/ajax-category-wise-products', 'AreaAnalysesController@ajaxCategoryWiseProducts')->name('ajax-category-wise-products');
                Route::get('/edit/{id}', 'AreaAnalysesController@edit')->name('edit');
                Route::any('/edit-submit/{id}', 'AreaAnalysesController@edit')->name('edit-submit');
                Route::get('/status/{id}', 'AreaAnalysesController@status')->name('change-status');
                Route::get('/delete/{id}', 'AreaAnalysesController@delete')->name('delete');
                Route::post('/bulk-actions', 'AreaAnalysesController@bulkActions')->name('bulk-actions');
            });

            Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
                Route::get('/', 'RolesController@list')->name('list');
                Route::post('ajax-list-request', 'RolesController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/add', 'RolesController@add')->name('add');
                Route::post('/add-submit', 'RolesController@add')->name('add-submit');
                Route::get('/edit/{id}', 'RolesController@edit')->name('edit');
                Route::any('/edit-submit/{id}', 'RolesController@edit')->name('edit-submit');
                Route::get('/status/{id}', 'RolesController@status')->name('change-status');
                Route::get('/delete/{id}', 'RolesController@delete')->name('delete');
                Route::post('/bulk-actions', 'RolesController@bulkActions')->name('bulk-actions');
            });

            Route::group(['prefix' => 'roleAssignment', 'as' => 'roleAssignment.'], function () {
                Route::get('/', 'RoleAssignmentsController@list')->name('list');
                Route::post('ajax-list-request', 'RoleAssignmentsController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/add', 'RoleAssignmentsController@add')->name('add');
                Route::post('/add-submit', 'RoleAssignmentsController@add')->name('add-submit');
                Route::get('/edit/{id}', 'RoleAssignmentsController@edit')->name('edit');
                Route::any('/edit-submit/{id}', 'RoleAssignmentsController@edit')->name('edit-submit');
                Route::get('/delete/{id}', 'RoleAssignmentsController@delete')->name('delete');
                Route::post('/bulk-actions', 'RoleAssignmentsController@bulkActions')->name('bulk-actions');
            });

            Route::group(['prefix' => 'analyses', 'as' => 'analyses.'], function () {
                Route::get('/', 'AnalysesController@list')->name('list');
                Route::post('ajax-list-request', 'AnalysesController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/view/{id}', 'AnalysesController@view')->name('view');

                Route::get('/details-list/{id}', 'AnalysesController@detailsList')->name('details-list');
                Route::post('/ajax-details-list-request/{id}', 'AnalysesController@ajaxDetailsListRequest')->name('ajax-details-list-request');
                
                Route::get('/details-add/{id}', 'AnalysesController@detailsAdd')->name('details-add');
                Route::post('/details-add-submit/{id}', 'AnalysesController@detailsAdd')->name('details-add-submit');
                Route::get('/details-edit/{areaAnalysesId}/{id}', 'AnalysesController@detailsEdit')->name('details-edit');
                Route::post('/details-edit-submit/{areaAnalysesId}/{id}', 'AnalysesController@detailsEdit')->name('details-edit-submit');
            });
            
        });

    });

});


