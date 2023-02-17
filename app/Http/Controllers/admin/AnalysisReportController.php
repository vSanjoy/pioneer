<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : AnalysisReportController
# Purpose           : Store Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Traits\GeneralMethods;
use App\Models\SingleStepOrder;
use App\Models\Analyses;
use App\Models\User;
use App\Models\DistributionArea;
use App\Models\Store;
use DataTables;
use Excel;
use App\Exports\AnalysisExport;


class AnalysisReportController extends Controller
{
    use GeneralMethods;
    public $controllerName  = 'AnalysisReport';
    public $management;
    public $modelName       = 'AnalysisReport';
    public $breadcrumb;
    public $routePrefix     = 'admin';
    public $pageRoute       = 'analysisReport';
    public $listUrl         = 'analysisReport.list';
    public $listRequestUrl  = 'analysisReport.ajax-list-request';
    public $addUrl          = 'analysisReport.add';
    public $editUrl         = 'analysisReport.edit';
    public $statusUrl       = 'analysisReport.change-status';
    public $deleteUrl       = 'analysisReport.delete';
    public $viewFolderPath  = 'admin.analysisReport';
    public $model           = 'AnalysisReport';

    /*
        * Function Name : __construct
        * Purpose       : It sets some public variables for being accessed throughout this
        *                   controller and its related view pages
        * Input Params  : Void
        * Return Value  : Mixed
    */
    public function __construct() {
        parent::__construct();

        $this->management  = trans('custom_admin.label_menu_analysis_report');
        $this->model       = new SingleStepOrder();

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
            'pageTitle'     => trans('custom_admin.label_analysis_report_list'),
            'panelTitle'    => trans('custom_admin.label_analysis_report_list'),
            'pageType'      => 'LISTPAGE'
        ];

        try {
            $data['distributors'] = User::where(['type' => 'D', 'status' => '1'])->whereNull('deleted_at')->select('id','full_name','email')->orderBy('full_name', 'ASC')->get();
            $data['distributionAreas'] = DistributionArea::where(['status' => '1'])->whereNull('deleted_at')->select('id','title')->orderBy('title', 'ASC')->get();
            $data['stores'] = Store::where(['status' => '1'])->whereNull('deleted_at')->select('id','store_name')->orderBy('store_name', 'ASC')->get();

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

                $analysisIds        = [];
                $dateRange          = $request->date_range;
                $filterByDateRange  = false;
                if ($dateRange != '') {
                    $filterByDateRange  = true;
                    $filter['date_range'] = $dateRange;

                    $explodedDateRange = explode(' - ', $dateRange);

                    $from   = $explodedDateRange[0];
                    $to     = $explodedDateRange[1];
                }
                // Distributor
                $distributorId         = $request->distributor_id;
                $filterByDistributor   = false;
                if ($distributorId != '') {
                    $filterByDistributor = true;
                    $filter['distributor_id'] = $distributorId;
                }
                // Distribution Area
                $distributionAreaId         = $request->distribution_area_id;
                $filterByDistributionArea   = false;
                if ($distributionAreaId != '') {
                    $filterByDistributionArea = true;
                    $filter['distribution_area_id'] = $distributionAreaId;
                }
                // Store
                $storeId            = $request->store_id;
                $filterByStore      = false;
                if ($storeId != '') {
                    $filterByStore  = true;
                    $filter['store_id'] = $storeId;
                }
                
                // Main query
                $data = $this->model->whereNull(['deleted_at']);

                // Based on disribution area filter
                if ($filterByDateRange) {
                    $singleStepOrders = $data->whereBetween('analysis_date', [$from, $to])->whereNull(['deleted_at'])->get();
                    
                    if ($singleStepOrders) {
                        foreach ($singleStepOrders as $singleStepOrder) {
                            $analysisIds[] = $singleStepOrder->analyses_id;
                        }
                    }
                }
                
                if (count($analysisIds) || $filterByDistributor || $filterByDistributionArea || $filterByStore) {
                    $data = Analyses::whereNull(['deleted_at']);

                    if (count($analysisIds)) {
                        $analysisIds = array_unique($analysisIds);
                        asort($analysisIds);

                        $data = $data->whereIn('id', $analysisIds);
                    }
                    if ($filterByDistributor) {
                        $data = $data->where('distributor_id', $distributorId);
                    }
                    if ($filterByDistributionArea) {
                        $data = $data->where('distribution_area_id', $distributionAreaId);
                    }
                    if ($filterByStore) {
                        $data = $data->where('store_id', $storeId);
                    }

                    $data = $data->get();
                } else {
                    $data = Analyses::where(['status' => 3])->get();
                }

                return Datatables::of($data, $isAllow, $allowedRoutes)
                        ->addIndexColumn()
                        ->addColumn('analysis_season_id', function ($row) {
                            if ($row->analysisSeasonDetails !== NULL) {
                                return $row->analysisSeasonDetails->title ?? 'N/A';
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('distribution_area_id', function ($row) {
                            if ($row->distributionAreaDetails !== NULL) {
                                return $row->distributionAreaDetails->title ?? 'N/A';
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('distributor_id', function ($row) {
                            if ($row->distributorDetails !== NULL) {
                                return $row->distributorDetails->full_name ?? 'N/A';
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('distributor_company', function ($row) {
                            if ($row->distributorDetails !== NULL) {
                                return $row->distributorDetails->company ?? 'N/A';
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('distributor_phone', function ($row) {
                            if ($row->distributorDetails !== NULL) {
                                return $row->distributorDetails->phone_no ?? 'N/A';
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('store_id', function ($row) {
                            if ($row->storeDetails !== NULL) {
                                return $row->storeDetails->store_name ?? 'N/A';
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('store_phone', function ($row) {
                            if ($row->storeDetails !== NULL) {
                                return $row->storeDetails->phone_no_1 ?? 'N/A';
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('beat_id', function ($row) {
                            if ($row->beatDetails !== NULL) {
                                return $row->beatDetails->title ?? 'N/A';
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('analysis_date', function ($row) {
                            return changeDateFormat($row->analysis_date);
                        })
                        ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes) {
                            $btn = '';
                            
                            return $btn;
                        })
                        ->rawColumns(['action'])
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
            $analysisIds        = [];
            $dateRange          = $request->date_range;
            $filterByDateRange  = false;
            if ($dateRange != '') {
                $filterByDateRange  = true;
                $filter['date_range'] = $dateRange;

                $explodedDateRange = explode(' - ', $dateRange);

                $from   = $explodedDateRange[0];
                $to     = $explodedDateRange[1];
            }
            // Distributor
            $distributorId         = $request->distributor_id;
            $filterByDistributor   = false;
            if ($distributorId != '') {
                $filterByDistributor = true;
                $filter['distributor_id'] = $distributorId;
            }
            // Distribution Area
            $distributionAreaId         = $request->distribution_area_id;
            $filterByDistributionArea   = false;
            if ($distributionAreaId != '') {
                $filterByDistributionArea = true;
                $filter['distribution_area_id'] = $distributionAreaId;
            }
            // Store
            $storeId            = $request->store_id;
            $filterByStore      = false;
            if ($storeId != '') {
                $filterByStore  = true;
                $filter['store_id'] = $storeId;
            }
            
            // Main query
            $data = $this->model->whereNull(['deleted_at']);

            // Based on disribution area filter
            if ($filterByDateRange) {
                $singleStepOrders = $data->whereBetween('analysis_date', [$from, $to])->whereNull(['deleted_at'])->get();
                
                if ($singleStepOrders) {
                    foreach ($singleStepOrders as $singleStepOrder) {
                        $analysisIds[] = $singleStepOrder->analyses_id;
                    }
                }
            }
            
            if (count($analysisIds) || $filterByDistributor || $filterByDistributionArea || $filterByStore) {
                $data = Analyses::whereNull(['deleted_at']);

                if (count($analysisIds)) {
                    $analysisIds = array_unique($analysisIds);
                    asort($analysisIds);

                    $data = $data->whereIn('id', $analysisIds);
                }
                if ($filterByDistributor) {
                    $data = $data->where('distributor_id', $distributorId);
                }
                if ($filterByDistributionArea) {
                    $data = $data->where('distribution_area_id', $distributionAreaId);
                }
                if ($filterByStore) {
                    $data = $data->where('store_id', $filterByStore);
                }

                $data = $data->get();
            } else {
                $data = Analyses::where(['status' => 3])->get();
            }

            return Excel::download(new AnalysisExport($data), 'analysis_report_'.date('Y_m_d_H_i_s').'.xlsx');
        } catch (Exception $e) { 
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }
        return response()->json(['title' => $title, 'message' => $message, 'type' => $type]);
    }


}
