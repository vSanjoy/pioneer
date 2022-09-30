<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : SingleStepSellerAnalysesController
# Purpose           : Single Step Seller Analysis Management
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
use App\Models\Order;
use DataTables;

class SingleStepSellerAnalysesController extends Controller
{
    use GeneralMethods;
    public $controllerName          = 'SingleStepSellerAnalyses';
    public $management;
    public $modelName               = 'User';
    public $breadcrumb;
    public $routePrefix             = 'admin';
    public $pageRoute               = 'singleStepSellerAnalyses';
    public $listUrl                 = '';
    public $listRequestUrl          = '';
    public $addUrl                  = '';
    public $editUrl                 = '';
    public $statusUrl               = '';
    public $deleteUrl               = '';
    public $detailsListUrl          = 'singleStepSellerAnalyses.distribution-area-list';
    public $detailsListRequestUrl   = 'singleStepSellerAnalyses.ajax-distribution-area-list-request';
    public $viewFolderPath          = 'admin.singleStepSellerAnalyses';
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

                $data = DistributionArea::whereIn('id', $distributionAreaIds)->whereNull('deleted_at')->orderBy('title', 'ASC');

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
                        ->addColumn('title_link', function ($row) {
                            $title = '<a href="'.route($this->routePrefix.'.singleStepSellerAnalyses.beat-list', [customEncryptionDecryption($row->id)]).'">'.$row->title.'</a>';

                            return $title;
                        })
                        ->addColumn('created_at', function ($row) {
                            return date('d-m-Y', strtotime($row->created_at));
                        })
                        ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes) {
                            $btn = '<a href="'.route($this->routePrefix.'.singleStepSellerAnalyses.beat-list', [customEncryptionDecryption($row->id)]).'" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_beat').'"><i class="fa fa-user ml_minus_1"></i></a>';

                            return $btn;
                        })
                        ->rawColumns(['title_link'])
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
                $data = Beat::where([
                                'distribution_area_id' => customEncryptionDecryption($distributionAreaId, 'decrypt'),
                                'status' => '1'
                                ])->whereNull('deleted_at')->orderBy('title', 'ASC');

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
                        ->addColumn('title_link', function ($row) use ($distributionAreaId) {
                            $title = '<a href="'.route($this->routePrefix.'.singleStepSellerAnalyses.store-list', [$distributionAreaId, customEncryptionDecryption($row->id)]).'">'.$row->title.'</a>';

                            return $title;
                        })
                        ->addColumn('created_at', function ($row) {
                            return date('d-m-Y', strtotime($row->created_at));
                        })
                        ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes, $distributionAreaId) {
                            $btn = '<a href="'.route($this->routePrefix.'.singleStepSellerAnalyses.store-list', [$distributionAreaId, customEncryptionDecryption($row->id)]).'" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_store').'"><i class="fa fa-university ml_minus_1" aria-hidden="true"></i></a>';

                            return $btn;
                        })
                        ->rawColumns(['title_link'])
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
    public function ajaxStoreListRequest(Request $request, $distributionAreaId = null, $beatId = null) {
        $data['pageTitle'] = trans('custom_admin.label_store_list');
        $data['panelTitle']= trans('custom_admin.label_store_list');

        try {
            if ($request->ajax()) {
                $data = Store::where([
                                'distribution_area_id' => customEncryptionDecryption($distributionAreaId, 'decrypt'),
                                'beat_id' => customEncryptionDecryption($beatId, 'decrypt'),
                                'status' => '1'
                                ])
                                ->whereNull('deleted_at')
                                ->orderBy('store_name', 'ASC');

                // Start :: Manage restriction
                $isAllow = false;
                $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
                if ($restrictions['is_super_admin']) {
                    $isAllow = true;
                }
                $allowedRoutes  = $restrictions['allow_routes'];
                // End :: Manage restriction

                return Datatables::of($data, $isAllow, $allowedRoutes, $distributionAreaId, $beatId)
                        ->addIndexColumn()
                        ->addColumn('store_name_link', function ($row) use ($distributionAreaId, $beatId) {
                            $storeName = '<a href="'.route($this->routePrefix.'.singleStepSellerAnalyses.category-list', [$distributionAreaId, $beatId, customEncryptionDecryption($row->id)]).'">'.$row->store_name.'</a>';

                            return $storeName;
                        })
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
                        ->addColumn('sale_size_category', function ($row) {
                            if ($row->sale_size_category == 'M') {
                                return 'Medium';
                            } else if ($row->sale_size_category == 'L') {
                                return 'Large';
                            } else {
                                return 'Small';
                            }
                        })
                        ->addColumn('created_at', function ($row) {
                            return date('d-m-Y', strtotime($row->created_at));
                        })
                        ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes, $distributionAreaId, $beatId) {
                            $btn = '<a href="'.route($this->routePrefix.'.singleStepSellerAnalyses.category-list', [$distributionAreaId, $beatId, customEncryptionDecryption($row->id)]).'" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_category').'"><i class="far fa-file-alt"></i>';

                            return $btn;
                        })
                        ->rawColumns(['store_name_link','distribution_area_id','sale_size_category','action'])
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
            $data['categories']         = Category::where(['status' => '1'])->whereNull('deleted_at')->orderBy('title', 'ASC')->get();

            // Start :: Manage restriction
            $data['isAllow'] = false;
            $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
            if ($restrictions['is_super_admin']) {
                $data['isAllow'] = true;
            }
            $data['allowedRoutes'] = $restrictions['allow_routes'];
            // End :: Manage restriction

            return view($this->viewFolderPath.'.analysis', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.dashboard');
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.dashboard');
        }
    }

    

    /******************************************************** Analysis ********************************************************/
    /*
        * Function name : analysisUpdate
        * Purpose       : This function is to update form
        * Input Params  : Request $request
        * Return Value  : Returns sub admin data
    */
    public function analysisUpdate(Request $request, $distributionAreaId = null, $beatId = null, $storeId = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_analysis'),
            'panelTitle'    => trans('custom_admin.label_analysis'),
            'pageType'      => 'EDITPAGE'
        ];

        try {
            $data['distributionAreaId'] = $distributionAreaId;
            $data['beatId']             = $beatId;
            $data['storeId']            = $storeId;
            
            $decryptDistributionAreaId  = customEncryptionDecryption($distributionAreaId, 'decrypt');
            $decryptBeatId              = customEncryptionDecryption($beatId, 'decrypt');
            $decryptStoreId             = customEncryptionDecryption($storeId, 'decrypt');
            
            $data['distributionArea']   = DistributionArea::where(['id' => $decryptDistributionAreaId])->first();
            $data['beat']               = Beat::where(['id' => $decryptBeatId])->first();
            $data['store']              = Store::where(['id' => $decryptStoreId])->first();
            
            if ($request->isMethod('POST')) {

                dd($request);



                $validationCondition = array(
                    'qty'   => 'required|regex:'.config('global.VALID_NUMERIC'),
                    'why'   => 'required',
                    'result'=> 'required',
                );
                $validationMessages = array(
                    'qty.required'      => trans('custom_admin.error_qty'),
                    'qty.regex'         => trans('custom_admin.error_enter_valid_number'),
                    'why.required'      => trans('custom_admin.error_why'),
                    'result.required'   => trans('custom_admin.error_result')
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $saveData                           = [];
                    $saveData['seller_id']              = Auth::guard('admin')->user()->id ?? null;
                    $saveData['analysis_season_id']     = $details->analysis_season_id ?? null;
                    $saveData['distribution_area_id']   = $decryptDistributionAreaId;
                    $saveData['distributor_id']         = $details->distributor_id ?? null;
                    $saveData['beat_id']                = $decryptBeatId;
                    $saveData['store_id']               = $decryptStoreId;
                    $saveData['analysis_date']          = $details->analysis_date ?? null;
                    $saveData['analyses_id']            = $details->id ?? null;
                    $saveData['category_id']            = $decryptCategoryId ?? null;
                    $saveData['product_id']             = $decryptProductId ?? null;
                    $saveData['qty']                    = $request->qty ?? null;
                    $saveData['why']                    = $request->why ?? null;
                    $saveData['result']                 = $request->result ?? null;
                    $save = Order::create($saveData);

                    if ($save) {
                        $this->generateToastMessage('success', trans('custom_admin.success_data_added_successfully'), false);
                        $this->windowCloseOnSuccess();
                        // return redirect()->route($this->routePrefix.'.singleStepSellerAnalyses.product-list', [$distributionAreaId, $beatId, $storeId, $categoryId]);
                    } else {
                        $this->generateToastMessage('error', trans('custom_admin.error_took_place_while_adding'), false);
                        return redirect()->back()->withInput();
                    }
                    
                }
            }

            return view($this->viewFolderPath.'.analysis_edit', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.singleStepSellerAnalyses.category-list', [$distributionAreaId, $beatId, $storeId]);
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.singleStepSellerAnalyses.category-list', [$distributionAreaId, $beatId, $storeId]);
        }
    }

}
