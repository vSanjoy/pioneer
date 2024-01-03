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
use App\Models\Payment;
use DataTables;

class PaymentsController extends Controller
{
    use GeneralMethods;
    public $controllerName          = 'PaymentsController';
    public $management;
    public $modelName               = 'Payment';
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
    public $model                   = 'Payment';

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
        $this->model       = new Payment();

        // Assign breadcrumb
        $this->assignBreadcrumb();
        
        // Variables assign for view page
        $this->assignShareVariables();
    }

    /*
        * Function name : collect
        * Purpose       : This function is to collect payment
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function collect(Request $request, $id = null) {
        $data = [
            'pageTitle'     => 'Collect Payment',
            'panelTitle'    => 'Collect Payment',
            'pageType'      => 'CREATEPAGE'
        ];

        try {
            if ($request->isMethod('POST')) {
                $validationCondition = array(
                    'beat_id'   => 'required',
                    'store_id'  => 'required',
                    'date'      => 'required',
                    'amount'    => 'required|regex:'.config('global.VALID_AMOUNT_REGEX')
                );
                $validationMessages = array(
                    'beat_id.required'  => trans('custom_admin.error_beat'),
                    'store_id.required' => trans('custom_admin.error_store'),
                    'amount.required'   => trans('custom_admin.error_amount'),
                    'amount.regex'      => trans('custom_admin.error_valid_amount')
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $saveData                           = [];
                    $saveData['distributor_id']         = Auth::guard('admin')->user()->id ?? null;
                    $saveData['distribution_area_id']   = $request->distribution_area ?? null;
                    $saveData['beat_id']                = $request->beat_id ?? null;
                    $saveData['store_id']               = $request->store_id ?? null;
                    $saveData['date']                   = $request->date ?? null;
                    $saveData['total_amount']           = $request->amount ?? 0;
                    $saveData['payment_mode']           = $request->payment_mode ?? null;
                    $saveData['payment_details']        = $request->payment_details ?? null;
                    $saveData['note']                   = $request->note ?? null;
                    $save = $this->model->create($saveData);

                    if ($save) {
                        $this->generateToastMessage('success', trans('custom_admin.success_data_added_successfully'), false);
                        return redirect()->route($this->routePrefix.'.payment.collect');
                    } else {
                        $this->generateToastMessage('error', trans('custom_admin.error_took_place_while_updating'), false);
                        return redirect()->back()->withInput();
                    }
                }
            }


            if (Auth::guard('admin')->user()->type == 'D' && Auth::guard('admin')->user()->distribution_area_id != null) {
                $data['distributionArea'] = DistributionArea::where('id', Auth::guard('admin')->user()->distribution_area_id)->first();
                $data['beats'] = Beat::where(['distribution_area_id' => Auth::guard('admin')->user()->distribution_area_id, 'status' => '1'])->orderBy('title', 'ASC')->get();
                $data['stores'] = Store::where(['distribution_area_id' => Auth::guard('admin')->user()->distribution_area_id, 'status' => '1'])->whereNull('deleted_at')->select('id','store_name','email','beat_name','name_1','phone_no_1','distribution_area_id','beat_id')->orderBy('store_name', 'ASC')->get();
                return view($this->viewFolderPath.'.collect', $data);
            } else {
                $this->generateToastMessage('error', trans('custom_admin.error_you_are_not_a_distributor'), false);
                return redirect()->route($this->routePrefix.'.dashboard');
            }
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.payment.history');
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.payment.history');
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
            return redirect()->route($this->routePrefix.'.payment.history');
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.payment.history');
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
            return redirect()->route($this->routePrefix.'.payment.history');
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.payment.history');
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

    /*
        * Function Name : ajaxDistributionAreaBeatWiseStore
        * Purpose       : This function is to get stores with distribution area and beat wise
        * Author        : 
        * Created Date  : 
        * Modified date : 
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function ajaxDistributionAreaBeatWiseStore(Request $request) {
        $title      = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type       = 'error';
        $options    = '<option value="">--'.trans('custom_admin.label_select').'--</option>';

        try {
            if ($request->ajax()) {
                $distributionAreaId = $request->distribution_area_id ?? '';
                $beatId             = $request->beat_id ?? '';
                
                $title      = trans('custom_admin.message_success');
                $message    = trans('custom_admin.message_success');
                $type       = 'success';
                
                if ($distributionAreaId != '' && $beatId != '') {
                    $stores = Store::where(['distribution_area_id' => $distributionAreaId, 'beat_id' => $beatId, 'status' => '1'])->whereNull('deleted_at')->select('id','store_name','email','beat_name','name_1','phone_no_1','distribution_area_id','beat_id')->orderBy('store_name', 'ASC')->get();
                } else if ($distributionAreaId != '' && $beatId == '') {
                    $stores = Store::where(['distribution_area_id' => $distributionAreaId, 'status' => '1'])->whereNull('deleted_at')->select('id','store_name','email','beat_name','name_1','phone_no_1','distribution_area_id','beat_id')->orderBy('store_name', 'ASC')->get();
                }

                if ($stores->count()) {
                    foreach ($stores as $keyStore => $valStore) {
                        $options .= '<option value="'.$valStore->id.'">'.$valStore->store_name.' ('.$valStore->name_1.' - '.$valStore->phone_no_1.')'.'</option>';
                    }
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }
        return response()->json(['title' => $title, 'message' => $message, 'type' => $type, 'options' => $options]);
    }

}
