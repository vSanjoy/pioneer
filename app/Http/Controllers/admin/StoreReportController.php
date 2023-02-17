<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : StoreReportController
# Purpose           : Store Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Traits\GeneralMethods;
use App\Models\DistributionArea;
use App\Models\User;
use App\Models\Store;
use DataTables;
use Excel;
use App\Exports\StoreExport;


class StoreReportController extends Controller
{
    use GeneralMethods;
    public $controllerName  = 'StoreReport';
    public $management;
    public $modelName       = 'StoreReport';
    public $breadcrumb;
    public $routePrefix     = 'admin';
    public $pageRoute       = 'storeReport';
    public $listUrl         = 'storeReport.list';
    public $listRequestUrl  = 'storeReport.ajax-list-request';
    public $addUrl          = 'storeReport.add';
    public $editUrl         = 'storeReport.edit';
    public $statusUrl       = 'storeReport.change-status';
    public $deleteUrl       = 'storeReport.delete';
    public $viewFolderPath  = 'admin.storeReport';
    public $model           = 'Store';

    /*
        * Function Name : __construct
        * Purpose       : It sets some public variables for being accessed throughout this
        *                   controller and its related view pages
        * Input Params  : Void
        * Return Value  : Mixed
    */
    public function __construct() {
        parent::__construct();

        $this->management  = trans('custom_admin.label_menu_store_report');
        $this->model       = new Store();

        // Assign breadcrumb
        $this->assignBreadcrumb();
        
        // Variables assign for view page
        $this->assignShareVariables();
    }

    /*
        * Function name : list
        * Purpose       : This function is for the listing and searching
        * Input Params  : Request $request
        * Return Value  : Returns to the list page
    */
    public function list(Request $request) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_store_report_list'),
            'panelTitle'    => trans('custom_admin.label_store_report_list'),
            'pageType'      => 'LISTPAGE'
        ];

        try {
            $data['distributionAreas'] = DistributionArea::where(['status' => '1'])->whereNull('deleted_at')->get();

            // Start :: Manage restriction
            $data['isAllow'] = false;
            $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
            if ($restrictions['is_super_admin']) {
                $data['isAllow'] = true;
            }
            $data['allowedRoutes'] = $restrictions['allow_routes'];
            // End :: Manage restriction

            return view($this->viewFolderPath.'.list', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.dashboard');
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.dashboard');
        }
    }

    /*
        * Function name : ajaxListRequest
        * Purpose       : This function is for the reutrn ajax data
        * Input Params  : Request $request
        * Return Value  : Returns sub admin data
    */
    public function ajaxListRequest(Request $request) {
        $data['pageTitle'] = trans('custom_admin.label_store_list');
        $data['panelTitle']= trans('custom_admin.label_store_list');

        try {
            if ($request->ajax()) {
                // Start :: Manage restriction
                $isAllow = false;
                $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
                if ($restrictions['is_super_admin']) {
                    $isAllow = true;
                }
                $allowedRoutes  = $restrictions['allow_routes'];
                // End :: Manage restriction

                // Distribution Area
                $distributionAreaId         = $request->distribution_area_id;
                $filterByDistributionArea   = false;
                if ($distributionAreaId != '') {
                    $filterByDistributionArea = true;
                    $filter['distribution_area_id'] = $distributionAreaId;
                }

                // Main query
                $data = Store::where(['status' => '1'])->whereNull(['deleted_at']);

                if ($filterByDistributionArea) {
                    $data = $data->where('distribution_area_id', $distributionAreaId);
                }
                
                $data = $data->get();

                return Datatables::of($data, $isAllow, $allowedRoutes)
                        ->addIndexColumn()
                        ->addColumn('distribution_area_id', function ($row) {
                            if ($row->distributionAreaDetails !== NULL) {
                                return $row->distributionAreaDetails->title;
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('beat_id', function ($row) {
                            if ($row->beatDetails !== NULL) {
                                return $row->beatDetails->title;
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('title', function ($row) {
                            return $row->title;
                        })
                        ->make(true);
            }
            return view($this->viewFolderPath.'.list');
        } catch (Exception $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return '';
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return '';
        }
    }

    /*
        * Function name : export
        * Purpose       : This function is to export records
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function export(Request $request) {
        $title      = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type       = 'error';

        try {
            // Distribution Area
            $distributionAreaId         = $request->distribution_area_id;
            $filterByDistributionArea   = false;
            if ($distributionAreaId != '') {
                $filterByDistributionArea = true;
                $filter['distribution_area_id'] = $distributionAreaId;
            }

            // Main query
            $data = $this->model->where(['status' => '1'])->whereNull(['deleted_at'])->orderBy('store_name', 'ASC');

            if ($filterByDistributionArea) {
                $data = $data->where('distribution_area_id', $distributionAreaId);
            }
            
            $data = $data->get();

            return Excel::download(new StoreExport($data), 'store_report_'.date('Y_m_d_H_i_s').'.xlsx');
        } catch (Exception $e) { 
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }
        return response()->json(['title' => $title, 'message' => $message, 'type' => $type]);
    }


}
