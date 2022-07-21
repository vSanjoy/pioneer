<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : SellerAnalysesController
# Purpose           : Seller Analysis Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Auth;
use App\Traits\GeneralMethods;
use App\Models\DistributionArea;
use App\Models\User;
use App\Models\Store;
use App\Models\Category;
use App\Models\Product;
use App\Models\Beat;
use App\Models\Analyses;
use DataTables;

class SellerAnalysesController extends Controller
{
    use GeneralMethods;
    public $controllerName          = 'SellerAnalyses';
    public $management;
    public $modelName               = 'User';
    public $breadcrumb;
    public $routePrefix             = 'admin';
    public $pageRoute               = 'sellerAnalyses';
    public $listUrl                 = '';
    public $listRequestUrl          = '';
    public $addUrl                  = '';
    public $editUrl                 = '';
    public $statusUrl               = '';
    public $deleteUrl               = '';
    public $detailsListUrl          = 'sellerAnalyses.distribution-area-list';
    public $detailsListRequestUrl   = 'sellerAnalyses.ajax-distribution-area-list-request';
    public $viewFolderPath          = 'admin.sellerAnalyses';
    public $model                   = 'User';

    /*
        * Function Name : __construct
        * Purpose       : It sets some public variables for being accessed throughout this
        *                   controller and its related view pages
        * Input Params  : Void
        * Return Value  : Mixed
    */
    public function __construct() {
        parent::__construct();

        $this->management  = trans('custom_admin.label_menu_analysis_season');
        $this->model       = new User();

        // Assign breadcrumb
        $this->assignBreadcrumb();
        
        // Variables assign for view page
        $this->assignShareVariables();
    }

    /******************************************************** Distribution Area ********************************************************/

    /*
        * Function name : distributionAreaList
        * Purpose       : This function is for the distribution area list
        * Input Params  : Request $request
        * Return Value  : Returns to the distribution area list page
    */
    public function distributionAreaList(Request $request) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_distribution_area_list'),
            'panelTitle'    => trans('custom_admin.label_distribution_area_list'),
            'pageType'      => 'LISTPAGE'
        ];

        try {
            // Start :: Manage restriction
            $data['isAllow'] = false;
            $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
            if ($restrictions['is_super_admin']) {
                $data['isAllow'] = true;
            }
            $data['allowedRoutes'] = $restrictions['allow_routes'];
            // End :: Manage restriction

            return view($this->viewFolderPath.'.distribution_area_list', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.dashboard');
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.dashboard');
        }
    }

    /*
        * Function name : ajaxDistributionAreaListRequest
        * Purpose       : This function is for the reutrn ajax data
        * Input Params  : Request $request
        * Return Value  : Returns data
    */
    public function ajaxDistributionAreaListRequest(Request $request) {
        $data['pageTitle'] = trans('custom_admin.label_distribution_area_list');
        $data['panelTitle']= trans('custom_admin.label_distribution_area_list');

        try {
            if ($request->ajax()) {
                $distributionAreaIds = [];
                if (Auth::guard('admin')->user()->userDistributionAreaDetails) {
                    foreach (Auth::guard('admin')->user()->userDistributionAreaDetails as $distributionArea) {
                        $distributionAreaIds[] = $distributionArea->distribution_area_id;
                    }
                }

                $data = DistributionArea::whereIn('id', $distributionAreaIds)->whereNull('deleted_at');

                // Start :: Manage restriction
                $isAllow = false;
                $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
                if ($restrictions['is_super_admin']) {
                    $isAllow = true;
                }
                $allowedRoutes  = $restrictions['allow_routes'];
                // End :: Manage restriction

                return Datatables::of($data, $isAllow, $allowedRoutes)
                        ->addIndexColumn()
                        ->addColumn('title', function ($row) {
                            return $row->title;
                        })
                        ->addColumn('created_at', function ($row) {
                            return date('d-m-Y', strtotime($row->created_at));
                        })
                        ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes) {
                            $btn = '<a href="'.route($this->routePrefix.'.sellerAnalyses.beat-list', [customEncryptionDecryption($row->id)]).'" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_beat').'"><i class="fa fa-user ml_minus_1"></i></a>';

                            return $btn;
                        })
                        ->rawColumns(['status','action'])
                        ->make(true);
            }

            return view($this->viewFolderPath.'.distribution_area_list');
        } catch (Exception $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return '';
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return '';
        }
    }


    /******************************************************** Beat ********************************************************/

    /*
        * Function name : beatList
        * Purpose       : This function is for the beat list
        * Input Params  : Request $request
        * Return Value  : Returns to the beat list page
    */
    public function beatList(Request $request, $distributionAreaId = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_beat_list'),
            'panelTitle'    => trans('custom_admin.label_beat_list'),
            'pageType'      => 'LISTPAGE'
        ];

        try {
            $data['distributionAreaId'] = $distributionAreaId;
            $data['distributionArea']   = DistributionArea::where(['id' => customEncryptionDecryption($distributionAreaId, 'decrypt')])->first();

            // Start :: Manage restriction
            $data['isAllow'] = false;
            $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
            if ($restrictions['is_super_admin']) {
                $data['isAllow'] = true;
            }
            $data['allowedRoutes'] = $restrictions['allow_routes'];
            // End :: Manage restriction

            return view($this->viewFolderPath.'.beat_list', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.dashboard');
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.dashboard');
        }
    }

    /*
        * Function name : ajaxBeatListRequest
        * Purpose       : This function is for the reutrn ajax data
        * Input Params  : Request $request
        * Return Value  : Returns data
    */
    public function ajaxBeatListRequest(Request $request, $distributionAreaId = null) {
        $data['pageTitle'] = trans('custom_admin.label_beat_list');
        $data['panelTitle']= trans('custom_admin.label_beat_list');

        try {
            if ($request->ajax()) {
                $data = Beat::where(['status' => '1'])->whereNull('deleted_at');

                // Start :: Manage restriction
                $isAllow = false;
                $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
                if ($restrictions['is_super_admin']) {
                    $isAllow = true;
                }
                $allowedRoutes  = $restrictions['allow_routes'];
                // End :: Manage restriction

                return Datatables::of($data, $isAllow, $allowedRoutes, $distributionAreaId)
                        ->addIndexColumn()
                        ->addColumn('created_at', function ($row) {
                            return date('d-m-Y', strtotime($row->created_at));
                        })
                        ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes, $distributionAreaId) {
                            $btn = '<a href="'.route($this->routePrefix.'.sellerAnalyses.store-list', [$distributionAreaId, customEncryptionDecryption($row->id)]).'" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_store').'"><i class="fa fa-university ml_minus_1" aria-hidden="true"></i></a>';

                            return $btn;
                        })
                        ->rawColumns(['status','action'])
                        ->make(true);
            }

            return view($this->viewFolderPath.'.beat_list');
        } catch (Exception $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return '';
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return '';
        }
    }

    /******************************************************** Store ********************************************************/

    /*
        * Function name : storeList
        * Purpose       : This function is for the store list
        * Input Params  : Request $request
        * Return Value  : Returns to the store list page
    */
    public function storeList(Request $request, $distributionAreaId = null, $beatId = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_store_list'),
            'panelTitle'    => trans('custom_admin.label_store_list'),
            'pageType'      => 'LISTPAGE'
        ];

        try {
            $data['distributionAreaId'] = $distributionAreaId;
            $data['beatId']             = $beatId;
            $data['distributionArea']   = DistributionArea::where(['id' => customEncryptionDecryption($distributionAreaId, 'decrypt')])->first();
            $data['beat']               = Beat::where(['id' => customEncryptionDecryption($beatId, 'decrypt')])->first();
            
            // Start :: Manage restriction
            $data['isAllow'] = false;
            $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
            if ($restrictions['is_super_admin']) {
                $data['isAllow'] = true;
            }
            $data['allowedRoutes'] = $restrictions['allow_routes'];
            // End :: Manage restriction

            return view($this->viewFolderPath.'.store_list', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.dashboard');
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.dashboard');
        }
    }

    /*
        * Function name : ajaxStoreListRequest
        * Purpose       : This function is for the reutrn ajax data
        * Input Params  : Request $request
        * Return Value  : Returns data
    */
    public function ajaxStoreListRequest(Request $request, $distributionAreaId = null, $beatId = null, $storeId = null) {
        $data['pageTitle'] = trans('custom_admin.label_store_list');
        $data['panelTitle']= trans('custom_admin.label_store_list');

        try {
            if ($request->ajax()) {
                $data = Store::where([
                                'distribution_area_id' => customEncryptionDecryption($distributionAreaId, 'decrypt'),
                                'beat_id' => customEncryptionDecryption($beatId, 'decrypt'),
                                'status' => '1'
                                ])->whereNull('deleted_at');

                // Start :: Manage restriction
                $isAllow = false;
                $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
                if ($restrictions['is_super_admin']) {
                    $isAllow = true;
                }
                $allowedRoutes  = $restrictions['allow_routes'];
                // End :: Manage restriction

                return Datatables::of($data, $isAllow, $allowedRoutes, $distributionAreaId, $beatId, $storeId)
                        ->addIndexColumn()
                        ->addColumn('beat_id', function ($row) {
                            if ($row->beatDetails !== NULL) {
                                return $row->beatDetails->title;
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('distribution_area_id', function ($row) {
                            if ($row->distributionAreaDetails !== NULL) {
                                return $row->distributionAreaDetails->title;
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('sale_size_category', function ($row) {
                            if ($row->sale_size_category == 'M') {
                                return 'Medium';
                            } else if ($row->sale_size_category == 'L') {
                                return 'Large';
                            } else {
                                return 'Small';
                            }
                        })
                        ->addColumn('grade_id', function ($row) {
                            if ($row->gradeDetails !== NULL) {
                                return $row->gradeDetails->title;
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('created_at', function ($row) {
                            return date('d-m-Y', strtotime($row->created_at));
                        })
                        ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes, $distributionAreaId, $beatId, $storeId) {
                            $btn = '<a href="'.route($this->routePrefix.'.sellerAnalyses.category-list', [$distributionAreaId, $beatId, customEncryptionDecryption($row->id)]).'" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_category').'"><i class="far fa-file-alt"></i>';

                            return $btn;
                        })
                        ->rawColumns(['distribution_area_id','sale_size_category','action'])
                        ->make(true);
            }

            return view($this->viewFolderPath.'.store_list');
        } catch (Exception $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return '';
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return '';
        }
    }

    /******************************************************** Category ********************************************************/

    /*
        * Function name : categoryList
        * Purpose       : This function is for the category list
        * Input Params  : Request $request
        * Return Value  : Returns to the category list page
    */
    public function categoryList(Request $request, $distributionAreaId = null, $beatId = null, $storeId = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_category_list'),
            'panelTitle'    => trans('custom_admin.label_category_list'),
            'pageType'      => 'LISTPAGE'
        ];

        try {
            $data['distributionAreaId'] = $distributionAreaId;
            $data['beatId']             = $beatId;
            $data['storeId']            = $storeId;
            $data['distributionArea']   = DistributionArea::where(['id' => customEncryptionDecryption($distributionAreaId, 'decrypt')])->first();
            $data['beat']               = Beat::where(['id' => customEncryptionDecryption($beatId, 'decrypt')])->first();
            $data['store']              = Store::where(['id' => customEncryptionDecryption($storeId, 'decrypt')])->first();
            
            // Start :: Manage restriction
            $data['isAllow'] = false;
            $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
            if ($restrictions['is_super_admin']) {
                $data['isAllow'] = true;
            }
            $data['allowedRoutes'] = $restrictions['allow_routes'];
            // End :: Manage restriction

            return view($this->viewFolderPath.'.category_list', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.dashboard');
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.dashboard');
        }
    }

    /*
        * Function name : ajaxCategoryListRequest
        * Purpose       : This function is for the reutrn ajax data
        * Input Params  : Request $request
        * Return Value  : Returns data
    */
    public function ajaxCategoryListRequest(Request $request, $distributionAreaId = null, $beatId = null, $storeId = null) {
        $data['pageTitle'] = trans('custom_admin.label_category_list');
        $data['panelTitle']= trans('custom_admin.label_category_list');

        try {
            if ($request->ajax()) {
                $data = Category::where(['status' => '1'])->whereNull('deleted_at');

                // Start :: Manage restriction
                $isAllow = false;
                $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
                if ($restrictions['is_super_admin']) {
                    $isAllow = true;
                }
                $allowedRoutes  = $restrictions['allow_routes'];
                // End :: Manage restriction

                return Datatables::of($data, $isAllow, $allowedRoutes, $distributionAreaId, $beatId, $storeId)
                        ->addIndexColumn()
                        ->addColumn('created_at', function ($row) {
                            return date('d-m-Y', strtotime($row->created_at));
                        })
                        ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes, $distributionAreaId, $beatId, $storeId) {
                            $btn = '<a href="'.route($this->routePrefix.'.sellerAnalyses.product-list', [$distributionAreaId, $beatId, $storeId, customEncryptionDecryption($row->id)]).'" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_product').'"><i class="far fa-snowflake"></i>';

                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }

            return view($this->viewFolderPath.'.category_list');
        } catch (Exception $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return '';
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return '';
        }
    }

    /******************************************************** Product ********************************************************/

    /*
        * Function name : productList
        * Purpose       : This function is for the product list
        * Input Params  : Request $request
        * Return Value  : Returns to the product list page
    */
    public function productList(Request $request, $distributionAreaId = null, $beatId = null, $storeId = null, $categoryId = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_product_list'),
            'panelTitle'    => trans('custom_admin.label_product_list'),
            'pageType'      => 'LISTPAGE'
        ];

        try {
            $data['distributionAreaId'] = $distributionAreaId;
            $data['beatId']             = $beatId;
            $data['storeId']            = $storeId;
            $data['categoryId']         = $categoryId;
            $data['distributionArea']   = DistributionArea::where(['id' => customEncryptionDecryption($distributionAreaId, 'decrypt')])->first();
            $data['beat']               = Beat::where(['id' => customEncryptionDecryption($beatId, 'decrypt')])->first();
            $data['store']              = Store::where(['id' => customEncryptionDecryption($storeId, 'decrypt')])->first();
            $data['category']           = Category::where(['id' => customEncryptionDecryption($categoryId, 'decrypt')])->first();
            
            // Start :: Manage restriction
            $data['isAllow'] = false;
            $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
            if ($restrictions['is_super_admin']) {
                $data['isAllow'] = true;
            }
            $data['allowedRoutes'] = $restrictions['allow_routes'];
            // End :: Manage restriction

            return view($this->viewFolderPath.'.product_list', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.dashboard');
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.dashboard');
        }
    }

    /*
        * Function name : ajaxProductListRequest
        * Purpose       : This function is for the reutrn ajax data
        * Input Params  : Request $request
        * Return Value  : Returns data
    */
    public function ajaxProductListRequest(Request $request, $distributionAreaId = null, $beatId = null, $storeId = null, $categoryId = null) {
        $data['pageTitle'] = trans('custom_admin.label_product_list');
        $data['panelTitle']= trans('custom_admin.label_product_list');

        try {
            if ($request->ajax()) {
                $data = Product::where([
                                    'category_id' => customEncryptionDecryption($categoryId, 'decrypt'),
                                    'status' => '1'
                                    ])->whereNull('deleted_at');

                // Start :: Manage restriction
                $isAllow = false;
                $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
                if ($restrictions['is_super_admin']) {
                    $isAllow = true;
                }
                $allowedRoutes  = $restrictions['allow_routes'];
                // End :: Manage restriction

                return Datatables::of($data, $isAllow, $allowedRoutes, $distributionAreaId, $beatId, $storeId, $categoryId)
                        ->addIndexColumn()
                        ->addColumn('category', function ($row) {
                            if ($row->categoryDetails !== NULL) {
                                return $row->categoryDetails->title;
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('rate_per_pcs', function ($row) {
                            return formatToTwoDecimalPlaces($row->rate_per_pcs);
                        })
                        ->addColumn('mrp', function ($row) {
                            if ($row->mrp !== NULL) {
                                return formatToTwoDecimalPlaces($row->mrp);
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('retailer_price', function ($row) {
                            if ($row->retailer_price !== NULL) {
                                return formatToTwoDecimalPlaces($row->retailer_price);
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('created_at', function ($row) {
                            return date('d-m-Y', strtotime($row->created_at));
                        })
                        ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes, $distributionAreaId, $beatId, $storeId, $categoryId) {
                            $btn = '<a href="'.route($this->routePrefix.'.sellerAnalyses.analysis', [$distributionAreaId, $beatId, $storeId, $categoryId, customEncryptionDecryption($row->id)]).'" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_analysis').'"><i class="fas fa-chart-bar ml_minus_1" aria-hidden="true"></i>';

                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }

            return view($this->viewFolderPath.'.product_list');
        } catch (Exception $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return '';
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return '';
        }
    }

    /******************************************************** Analysis ********************************************************/
    /*
        * Function name : analysisUpdate
        * Purpose       : This function is to update form
        * Input Params  : Request $request
        * Return Value  : Returns sub admin data
    */
    public function analysisUpdate(Request $request, $distributionAreaId = null, $beatId = null, $storeId = null, $categoryId = null, $productId = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_analysis'),
            'panelTitle'    => trans('custom_admin.label_analysis'),
            'pageType'      => 'EDITPAGE'
        ];

        try {
            // dd(customEncryptionDecryption($categoryId, 'decrypt'), customEncryptionDecryption($productId, 'decrypt'));
            $data['id']             = 0;
            $data['analysisValues'] = $analysisValues = [];
            $data['details']        = $details = Analyses::whereYear('analysis_date', Carbon::now()->format('Y'))
                                                        ->where([
                                                            'distribution_area_id' => customEncryptionDecryption($distributionAreaId, 'decrypt'),
                                                            'store_id' => customEncryptionDecryption($storeId, 'decrypt'),
                                                            'beat_id' => customEncryptionDecryption($beatId, 'decrypt')
                                                        ])
                                                        ->with('analysesDetails')
                                                        ->whereHas('analysesDetails', function ($query) use($categoryId, $productId) {
                                                            $query->where([
                                                                'category_id' => customEncryptionDecryption($categoryId, 'decrypt'),
                                                                'product_id' => customEncryptionDecryption($productId, 'decrypt')
                                                            ]);
                                                        })
                                                        ->first();
            // dd($details);
            $data['distributionAreaId'] = $distributionAreaId;
            $data['beatId']             = $beatId;
            $data['storeId']            = $storeId;
            $data['categoryId']         = $categoryId;
            $data['productId']          = $productId;            
            
            $data['distributionArea']   = DistributionArea::where(['id' => customEncryptionDecryption($distributionAreaId, 'decrypt')])->first();
            $data['beat']               = Beat::where(['id' => customEncryptionDecryption($beatId, 'decrypt')])->first();
            $data['store']              = Store::where(['id' => customEncryptionDecryption($storeId, 'decrypt')])->first();
            $data['category']           = Category::where(['id' => customEncryptionDecryption($categoryId, 'decrypt')])->first();
            $data['product']            = Product::where(['id' => customEncryptionDecryption($productId, 'decrypt')])->first();
            
            if ($request->isMethod('POST')) {
                $validationCondition = array(
                    'analysis_date' => 'required',
                );
                $validationMessages = array(
                    'analysis_date.required'    => trans('custom_admin.error_analysis_date'),
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    if ($details == null) { // Insert first time
                        $saveData                           = [];
                        $saveData['analysis_season_id']     = $decryptAnalysisSeasonId;
                        $saveData['distribution_area_id']   = $decryptDistributionAreaId;
                        $saveData['distributor_id']         = $decryptDistributorId;
                        $saveData['store_id']               = $decryptStoreId;
                        $saveData['analysis_date']          = date('Y-m-d', strtotime($request->analysis_date)) ?? null;
                        $save = Analyses::create($saveData);

                        if ($save) {
                            $i = 0; $analysesArray = [];
                            if (isset($request->analyses) && count($request->analyses)) {
                                foreach ($request->analyses as $itemAnalyses) {
                                    if (isset($itemAnalyses['products']) && count($itemAnalyses['products'])) {
                                        foreach ($itemAnalyses['products'] as $item) {
                                            if ($item['target_monthly_sales'] != null || $item['type_of_analysis'] != null || $item['action'] != null) {
                                                $analysesArray[$i]['analyses_id']            = $save->id;
                                                $analysesArray[$i]['category_id']            = $item['category_id'];
                                                $analysesArray[$i]['product_id']             = $item['id'];
                                                $analysesArray[$i]['target_monthly_sales']   = $item['target_monthly_sales'];
                                                $analysesArray[$i]['type_of_analysis']       = $item['type_of_analysis'];
                                                $analysesArray[$i]['action']                 = $item['action'];

                                                $i++;
                                            }
                                        }
                                    }
                                }
                                
                                if (count($analysesArray)) {
                                    AnalysesDetail::insert($analysesArray);
                                }
                            }

                            $this->generateToastMessage('success', trans('custom_admin.success_data_added_successfully'), false);
                            return redirect()->route($this->routePrefix.'.analysisSeason.analysis', [$analysisSeasonId, $distributionAreaId, $distributorId, $storeId]);
                        } else {
                            $this->generateToastMessage('error', trans('custom_admin.error_took_place_while_adding'), false);
                            return redirect()->back()->withInput();
                        }
                    } else {                // Update
                        $details->analysis_date = date('Y-m-d', strtotime($request->analysis_date)) ?? null;
                        $update = $details->update();
                        if ($update) {
                            $i = 0; $analysesArray = [];
                            if (isset($request->analyses) && count($request->analyses)) {
                                foreach ($request->analyses as $itemAnalyses) {
                                    if (isset($itemAnalyses['products']) && count($itemAnalyses['products'])) {
                                        foreach ($itemAnalyses['products'] as $item) {
                                            if (($item['target_monthly_sales'] != null || $item['type_of_analysis'] != null || $item['action'] != null) && $item['analyses_details_id'] == null) {
                                                $analysesArray[$i]['analyses_id']            = $details->id;
                                                $analysesArray[$i]['category_id']            = $item['category_id'];
                                                $analysesArray[$i]['product_id']             = $item['id'];
                                                $analysesArray[$i]['target_monthly_sales']   = $item['target_monthly_sales'];
                                                $analysesArray[$i]['type_of_analysis']       = $item['type_of_analysis'];
                                                $analysesArray[$i]['action']                 = $item['action'];

                                                $i++;
                                            } else if ($item['analyses_details_id'] != null) {
                                                AnalysesDetail::where([
                                                                    'id'                    => $item['analyses_details_id'],
                                                                    'analyses_id'           => $details->id,
                                                                    'category_id'           => $item['category_id'],
                                                                    'product_id'            => $item['id'],
                                                                ])->update([
                                                                    'target_monthly_sales'  => $item['target_monthly_sales'],
                                                                    'type_of_analysis'      => $item['type_of_analysis'],
                                                                    'action'                => $item['action']
                                                                ]);
                                            }
                                        }
                                    }
                                }
                                
                                if (count($analysesArray)) {
                                    AnalysesDetail::insert($analysesArray);
                                }
                            }

                            $this->generateToastMessage('success', trans('custom_admin.success_data_updated_successfully'), false);
                            return redirect()->route($this->routePrefix.'.analysisSeason.analysis', [$analysisSeasonId, $distributionAreaId, $distributorId, $storeId]);
                        } else {
                            $this->generateToastMessage('error', trans('custom_admin.error_took_place_while_updating'), false);
                            return redirect()->back()->withInput();
                        }
                    }
                }
            }

            return view($this->viewFolderPath.'.analysis_edit', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.sellerAnalyses.product-list', [$distributionAreaId, $beatId, $storeId, $categoryId]);
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.sellerAnalyses.product-list', [$distributionAreaId, $beatId, $storeId, $categoryId]);
        }
    }

}
