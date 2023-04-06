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
    Route::any('/login', 'AuthController@login')->name('login');
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

            Route::group(['prefix' => 'seller', 'as' => 'seller.'], function () {
                Route::get('/list', 'SellersController@list')->name('list');
                Route::post('/ajax-list-request', 'SellersController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/add', 'SellersController@add')->name('add');
                Route::post('/add-submit', 'SellersController@add')->name('add-submit');
                Route::get('/edit/{id}', 'SellersController@edit')->name('edit');
                Route::post('/edit-submit/{id}', 'SellersController@edit')->name('edit-submit');
                Route::get('/status/{id}', 'SellersController@status')->name('change-status');
                Route::get('/delete/{id}', 'SellersController@delete')->name('delete');
                Route::post('/bulk-actions', 'SellersController@bulkActions')->name('bulk-actions');
            });

            Route::group(['prefix' => 'beat', 'as' => 'beat.'], function () {
                Route::get('/list', 'BeatsController@list')->name('list');
                Route::post('/ajax-list-request', 'BeatsController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/add', 'BeatsController@add')->name('add');
                Route::post('/add-submit', 'BeatsController@add')->name('add-submit');
                Route::get('/edit/{id}', 'BeatsController@edit')->name('edit');
                Route::post('/edit-submit/{id}', 'BeatsController@edit')->name('edit-submit');
                Route::get('/status/{id}', 'BeatsController@status')->name('change-status');
                Route::get('/delete/{id}', 'BeatsController@delete')->name('delete');
                Route::post('/bulk-actions', 'BeatsController@bulkActions')->name('bulk-actions');
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
                Route::post('/ajax-distribution-area-wise-distributor', 'StoresController@ajaxDistributionAreaWiseDistributor')->name('ajax-distribution-area-wise-distributor');
                Route::post('/ajax-distribution-area-wise-beat', 'StoresController@ajaxDistributionAreaWiseBeat')->name('ajax-distribution-area-wise-beat');
                Route::post('/ajax-distribution-area-wise-store', 'StoresController@ajaxDistributionAreaWiseStore')->name('ajax-distribution-area-wise-store');
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

            // Route::group(['prefix' => 'areaAnalysis', 'as' => 'areaAnalysis.'], function () {
            //     Route::get('/', 'AreaAnalysesController@list')->name('list');
            //     Route::post('ajax-list-request', 'AreaAnalysesController@ajaxListRequest')->name('ajax-list-request');
            //     Route::get('/add', 'AreaAnalysesController@add')->name('add');
            //     Route::post('/add-submit', 'AreaAnalysesController@add')->name('add-submit');
            //     Route::post('/ajax-distribution-area-wise-distributors-stores', 'AreaAnalysesController@ajaxDistributionAreaWiseDistributorsStores')->name('ajax-distribution-area-wise-distributors-stores');
            //     Route::post('/ajax-category-wise-products', 'AreaAnalysesController@ajaxCategoryWiseProducts')->name('ajax-category-wise-products');
            //     Route::get('/edit/{id}', 'AreaAnalysesController@edit')->name('edit');
            //     Route::any('/edit-submit/{id}', 'AreaAnalysesController@edit')->name('edit-submit');
            //     Route::get('/status/{id}', 'AreaAnalysesController@status')->name('change-status');
            //     Route::get('/delete/{id}', 'AreaAnalysesController@delete')->name('delete');
            //     Route::post('/bulk-actions', 'AreaAnalysesController@bulkActions')->name('bulk-actions');
            //     Route::get('/details-list/{id}', 'AreaAnalysesController@detailsList')->name('details-list');
            //     Route::post('/ajax-details-list-request/{id}', 'AreaAnalysesController@ajaxDetailsListRequest')->name('ajax-details-list-request');
            //     Route::get('/details-view/{id}', 'AreaAnalysesController@detailsView')->name('details-view');
            // });

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
                Route::get('/details-view/{id}', 'AnalysesController@detailsView')->name('details-view');
            });

            Route::group(['prefix' => 'analysisSeason', 'as' => 'analysisSeason.'], function () {
                Route::get('/', 'AnalysisSeasonsController@list')->name('list');
                Route::post('ajax-list-request', 'AnalysisSeasonsController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/add', 'AnalysisSeasonsController@add')->name('add');
                Route::post('/add-submit', 'AnalysisSeasonsController@add')->name('add-submit');
                Route::get('/edit/{id}', 'AnalysisSeasonsController@edit')->name('edit');
                Route::any('/edit-submit/{id}', 'AnalysisSeasonsController@edit')->name('edit-submit');
                Route::get('/status/{id}', 'AnalysisSeasonsController@status')->name('change-status');
                
                // Distribution Area
                Route::get('/distribution-area-list/{id}', 'AnalysisSeasonsController@distributionAreaList')->name('distribution-area-list');
                Route::post('/ajax-distribution-area-list-request/{id}', 'AnalysisSeasonsController@ajaxDistributionAreaListRequest')->name('ajax-distribution-area-list-request');

                // Distributor
                Route::get('/distributor-list/{analysisSeasonId}/{distributionAreaId}', 'AnalysisSeasonsController@distributorList')->name('distributor-list');
                Route::post('/ajax-distributor-list-request/{analysisSeasonId}/{distributionAreaId}', 'AnalysisSeasonsController@ajaxDistributorListRequest')->name('ajax-distributor-list-request');

                // Store
                Route::get('/store-list/{analysisSeasonId}/{distributionAreaId}/{distributorId}', 'AnalysisSeasonsController@storeList')->name('store-list');
                Route::post('/ajax-store-list-request/{analysisSeasonId}/{distributionAreaId}/{distributorId}', 'AnalysisSeasonsController@ajaxStoreListRequest')->name('ajax-store-list-request');

                // Analysis
                Route::get('/analysis/{analysisSeasonId}/{distributionAreaId}/{distributorId}/{storeId}', 'AnalysisSeasonsController@analysisUpdate')->name('analysis');
                Route::post('/analysis-update/{analysisSeasonId}/{distributionAreaId}/{distributorId}/{storeId}', 'AnalysisSeasonsController@analysisUpdate')->name('analysis-update');
            });

            Route::group(['prefix' => 'sellerAnalyses', 'as' => 'sellerAnalyses.'], function () {
                // Distribution Area
                Route::get('/distribution-area-list', 'SellerAnalysesController@distributionAreaList')->name('distribution-area-list');
                Route::post('/ajax-distribution-area-list-request', 'SellerAnalysesController@ajaxDistributionAreaListRequest')->name('ajax-distribution-area-list-request');

                // Beat
                Route::get('/beat-list/{distributionAreaId}', 'SellerAnalysesController@beatList')->name('beat-list');
                Route::post('/ajax-beat-list-request/{distributionAreaId}', 'SellerAnalysesController@ajaxBeatListRequest')->name('ajax-beat-list-request');

                // Store
                Route::get('/store-list/{distributionAreaId}/{beatId}', 'SellerAnalysesController@storeList')->name('store-list');
                Route::post('/ajax-store-list-request/{distributionAreaId}/{beatId}', 'SellerAnalysesController@ajaxStoreListRequest')->name('ajax-store-list-request');

                // Category
                Route::get('/category-list/{distributionAreaId}/{beatId}/{storeId}', 'SellerAnalysesController@categoryList')->name('category-list');
                Route::post('/ajax-category-list-request/{distributionAreaId}/{beatId}/{storeId}', 'SellerAnalysesController@ajaxCategoryListRequest')->name('ajax-category-list-request');

                // Product
                Route::get('/product-list/{distributionAreaId}/{beatId}/{storeId}/{categoryId}', 'SellerAnalysesController@productList')->name('product-list');
                Route::post('/ajax-product-list-request/{distributionAreaId}/{beatId}/{storeId}/{categoryId}', 'SellerAnalysesController@ajaxProductListRequest')->name('ajax-product-list-request');

                // Analysis
                Route::get('/analysis/{distributionAreaId}/{beatId}/{storeId}/{categoryId}/{productId}', 'SellerAnalysesController@analysisUpdate')->name('analysis');
                Route::post('/analysis-update/{distributionAreaId}/{beatId}/{storeId}/{categoryId}/{productId}', 'SellerAnalysesController@analysisUpdate')->name('analysis-update');
            });

            Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
                Route::get('/', 'OrdersController@list')->name('list');
                Route::post('ajax-list-request', 'OrdersController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/view/{id}', 'OrdersController@view')->name('view');
                Route::get('/delete/{id}', 'OrdersController@delete')->name('delete');
                Route::post('/bulk-actions', 'OrdersController@bulkActions')->name('bulk-actions');
            });

            Route::group(['prefix' => 'singleStepSellerAnalyses', 'as' => 'singleStepSellerAnalyses.'], function () {
                // Distribution Area
                Route::get('/distribution-area-list', 'SingleStepSellerAnalysesController@distributionAreaList')->name('distribution-area-list');
                Route::post('/ajax-distribution-area-list-request', 'SingleStepSellerAnalysesController@ajaxDistributionAreaListRequest')->name('ajax-distribution-area-list-request');

                // Beat
                Route::get('/beat-list/{distributionAreaId}', 'SingleStepSellerAnalysesController@beatList')->name('beat-list');
                Route::post('/ajax-beat-list-request/{distributionAreaId}', 'SingleStepSellerAnalysesController@ajaxBeatListRequest')->name('ajax-beat-list-request');

                // Store
                Route::get('/store-list/{distributionAreaId}/{beatId}', 'SingleStepSellerAnalysesController@storeList')->name('store-list');
                Route::post('/ajax-store-list-request/{distributionAreaId}/{beatId}', 'SingleStepSellerAnalysesController@ajaxStoreListRequest')->name('ajax-store-list-request');

                // Store
                Route::get('/season-list/{distributionAreaId}/{beatId}/{storeId}', 'SingleStepSellerAnalysesController@seasonList')->name('season-list');
                Route::post('/ajax-season-list-request/{distributionAreaId}/{beatId}/{storeId}', 'SingleStepSellerAnalysesController@ajaxSeasonListRequest')->name('ajax-season-list-request');

                // Distributor
                Route::get('/distributor-list/{distributionAreaId}/{beatId}/{storeId}/{seasonId}', 'SingleStepSellerAnalysesController@distributorList')->name('distributor-list');
                Route::post('/ajax-season-list-request/{distributionAreaId}/{beatId}/{storeId}/{seasonId}', 'SingleStepSellerAnalysesController@ajaxDistributorListRequest')->name('ajax-distributor-list-request');

                // Category
                Route::get('/category-list/{distributionAreaId}/{beatId}/{storeId}/{seasonId}/{distributorId}', 'SingleStepSellerAnalysesController@categoryList')->name('category-list');
                Route::post('/ajax-category-list-request/{distributionAreaId}/{beatId}/{storeId}/{seasonId}/{distributorId}', 'SingleStepSellerAnalysesController@ajaxCategoryListRequest')->name('ajax-category-list-request');

                // Analysis
                Route::get('/analysis/{distributionAreaId}/{beatId}/{storeId}/{seasonId}/{distributorId}', 'SingleStepSellerAnalysesController@analysisUpdate')->name('analysis');
                Route::post('/analysis-update/{distributionAreaId}/{beatId}/{storeId}/{seasonId}/{distributorId}', 'SingleStepSellerAnalysesController@analysisUpdate')->name('analysis-update');
            });

            Route::group(['prefix' => 'singleStepOrder', 'as' => 'singleStepOrder.'], function () {
                Route::get('/', 'SingleStepOrdersController@list')->name('list');
                Route::post('ajax-list-request', 'SingleStepOrdersController@ajaxListRequest')->name('ajax-list-request');
                Route::any('/edit/{id}', 'SingleStepOrdersController@edit')->name('edit');
                Route::any('/edit-submit/{id}', 'SingleStepOrdersController@edit')->name('edit-submit');
                Route::get('/view/{id}', 'SingleStepOrdersController@view')->name('view');
                Route::get('/delete/{id}', 'SingleStepOrdersController@delete')->name('delete');
                Route::post('/bulk-actions', 'SingleStepOrdersController@bulkActions')->name('bulk-actions');

                Route::any('/ajax-discount-amount-calculation', 'SingleStepOrdersController@ajaxDiscountAmountCalculation')->name('ajax-discount-amount-calculation');
                Route::any('/ajax-categoey-wise-products', 'SingleStepOrdersController@ajaxCategoeyWiseProducts')->name('ajax-categoey-wise-products');
                Route::any('/ajax-product-details', 'SingleStepOrdersController@ajaxProductDetails')->name('ajax-product-details');
                Route::any('/ajax-delete-order', 'SingleStepOrdersController@ajaxDeleteOrder')->name('ajax-delete-order');
                Route::any('/ajax-delete-single-step-order', 'SingleStepOrdersController@ajaxDeleteSingleStepOrder')->name('ajax-delete-single-step-order');
            });

            Route::group(['prefix' => 'analysisReport', 'as' => 'analysisReport.'], function () {
                Route::get('/', 'AnalysisReportController@list')->name('list');
                Route::post('ajax-list-request', 'AnalysisReportController@ajaxListRequest')->name('ajax-list-request');
                Route::any('/export', 'AnalysisReportController@export')->name('export');
            });

            Route::group(['prefix' => 'areaReport', 'as' => 'areaReport.'], function () {
                Route::get('/', 'AreaReportController@list')->name('list');
                Route::post('ajax-list-request', 'AreaReportController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/export', 'AreaReportController@export')->name('export');
            });

            Route::group(['prefix' => 'storeReport', 'as' => 'storeReport.'], function () {
                Route::get('/', 'StoreReportController@list')->name('list');
                Route::post('ajax-list-request', 'StoreReportController@ajaxListRequest')->name('ajax-list-request');
                Route::any('/export', 'StoreReportController@export')->name('export');
            });
            
        });

    });

});


