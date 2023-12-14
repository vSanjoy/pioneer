<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : PaymentsController
# Purpose           : Payments Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Auth;
use App\Traits\GeneralMethods;
use App\Models\Beat;
use App\Models\DistributionArea;
use App\Models\User;
use App\Models\Store;
use DataTables;

class PaymentsController extends Controller
{
    use GeneralMethods;
    public $controllerName          = 'PaymentsController';
    public $management;
    public $modelName               = 'User';
    public $breadcrumb;
    public $routePrefix             = 'admin';
    public $pageRoute               = 'payment';
    public $listUrl                 = 'payment.list';
    public $listRequestUrl          = 'payment.ajax-list-request';
    public $addUrl                  = 'payment.add';
    public $editUrl                 = 'payment.edit';
    public $statusUrl               = 'payment.change-status';
    public $deleteUrl               = 'payment.delete';
    public $viewFolderPath          = 'admin.payment';
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
        $this->model       = new Store();

        // Assign breadcrumb
        $this->assignBreadcrumb();
        
        // Variables assign for view page
        $this->assignShareVariables();
    }

    /*
        * Function name : add
        * Purpose       : This function is to add payment
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function add(Request $request, $id = null) {
        $data = [
            'pageTitle'     => 'Add Payment',
            'panelTitle'    => 'Add Payment',
            'pageType'      => 'CREATEPAGE'
        ];

        try {
            $data['stores'] = $this->model->where(['status' => '1'])->whereNull('deleted_at')->select('id','store_name','email','beat_name','name_1','distribution_area_id','beat_id')->orderBy('store_name', 'ASC')->get();

            return view($this->viewFolderPath.'.add', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        }
    }

    /*
        * Function name : history
        * Purpose       : This function is to show history of payments
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function history(Request $request) {
        $data = [
            'pageTitle'     => 'Payment History',
            'panelTitle'    => 'Payment History',
            'pageType'      => 'VIEWPAGE'
        ];

        try {
            $data['stores'] = $this->model->where(['status' => '1'])->whereNull('deleted_at')->select('id','store_name','email','beat_name','name_1','distribution_area_id','beat_id')->orderBy('store_name', 'ASC')->get();

            return view($this->viewFolderPath.'.history', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        }
    }

    /*
        * Function name : report
        * Purpose       : This function is to show report of payments
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function report(Request $request) {
        $data = [
            'pageTitle'     => 'Payment Report',
            'panelTitle'    => 'Payment Report',
            'pageType'      => 'VIEWPAGE'
        ];

        try {
            $data['beats'] = Beat::where(['status' => '1'])->whereNull('deleted_at')->select('id','title')->orderBy('title', 'ASC')->get();
            $data['distributionAreas'] = DistributionArea::where(['status' => '1'])->whereNull('deleted_at')->select('id','title')->orderBy('title', 'ASC')->get();
            $data['stores'] = $this->model->where(['status' => '1'])->whereNull('deleted_at')->select('id','store_name','email','beat_name','name_1','distribution_area_id','beat_id')->orderBy('store_name', 'ASC')->get();

            return view($this->viewFolderPath.'.report', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        }
    }

    /*
        * Function name : ajaxListReportRequest
        * Purpose       : This function is for the reutrn ajax data
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : Request $request
        * Return Value  : Returns order data
    */
    public function ajaxListReportRequest(Request $request) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_order_list'),
            'panelTitle'    => trans('custom_admin.label_order_list')
        ];

        try {
            if ($request->ajax()) {
                
                $data = Store::orderBy('id', 'desc');
                // Order list logged in user wise

                $dateRange          = $request->date_range;
                $filterByDateRange  = false;
                if ($dateRange != '') {
                    $filterByDateRange  = true;
                    $filter['date_range'] = $dateRange;

                    $explodedDateRange = explode(' - ', $dateRange);

                    $from   = $explodedDateRange[0];
                    $to     = $explodedDateRange[1];
                }
                // Store
                $storeId            = $request->store_id;
                $filterByStore      = false;
                if ($storeId != '') {
                    $filterByStore  = true;
                    $filter['store_id'] = $storeId;
                }
                
                // Start :: Manage restriction
                $isAllow = false;
                $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
                if ($restrictions['is_super_admin']) {
                    $isAllow = true;
                }
                $allowedRoutes  = $restrictions['allow_routes'];
                // End :: Manage restriction

                // Based on disribution area filter
                if ($filterByDateRange) {
                    $data = $data->whereBetween('created_at', [$from, $to]);
                }
                if ($filterByStore) {
                    $data = $data->where('store_id', $storeId);
                }
                $data = $data->get();

                return Datatables::of($data, $isAllow, $allowedRoutes)
                        ->addIndexColumn()
                        ->addColumn('created_at', function ($row) {
                            return '2023-12-05';
                        })
                        ->addColumn('invoice_no', function ($row) {
                            return 'Di/08/2023/20066';
                        })
                        ->addColumn('ref_no', function ($row) {
                            return '';
                        })
                        ->addColumn('store_id', function ($row) {
                            return 'SARKAR ENTERPRISE';
                        })
                        ->addColumn('amount', function ($row) {
                            return '10000.00';
                        })
                        ->addColumn('updated_at', function ($row) {
                            return changeDateFormat($row->updated_at);
                        })
                        ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes) {
                            $btn = '';
                            
                            return $btn;
                        })
                        ->rawColumns(['invoice_no','ref_no','amount','action'])
                        ->make(true);
            }
            return view($this->viewFolderPath.'.report');
        } catch (Exception $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return '';
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return '';
        }
    }

}
