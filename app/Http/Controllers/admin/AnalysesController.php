<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : AnalysesController
# Purpose           : Area Analysis Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Traits\GeneralMethods;
use App\Models\User;
use App\Models\AreaAnalyses;
use App\Models\AreaAnalysisDetail;
use DataTables;

class AnalysesController extends Controller
{
    use GeneralMethods;
    public $controllerName  = 'Analyses';
    public $management;
    public $modelName       = 'Analyses';
    public $breadcrumb;
    public $routePrefix     = 'admin';
    public $pageRoute       = 'analyses';
    public $listUrl         = 'analyses.list';
    public $listRequestUrl  = 'analyses.ajax-list-request';
    public $addUrl          = 'analyses.add';
    public $viewUrl         = 'analyses.view';
    public $statusUrl       = 'analyses.change-status';
    public $deleteUrl       = 'analyses.delete';
    public $viewFolderPath  = 'admin.analyses';
    public $model           = 'Analyses';

    /*
        * Function Name : __construct
        * Purpose       : It sets some public variables for being accessed throughout this
        *                   controller and its related view pages
        * Input Params  : Void
        * Return Value  : Mixed
    */
    public function __construct() {
        parent::__construct();

        $this->management  = trans('custom_admin.label_menu_analyses');
        $this->model       = new AreaAnalyses();

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
            'pageTitle'     => trans('custom_admin.label_analyses_list'),
            'panelTitle'    => trans('custom_admin.label_analyses_list'),
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
        $data['pageTitle'] = trans('custom_admin.label_analyses_list');
        $data['panelTitle']= trans('custom_admin.label_analyses_list');

        try {
            if ($request->ajax()) {
                $data = $this->model->where('distributor_id', \Auth::guard('admin')->user()->id)->whereNull('deleted_at');

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
                        ->addColumn('distribution_area_id', function ($row) {
                            if ($row->distributionAreaDetails !== NULL) {
                                return $row->distributionAreaDetails->title;
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('store_id', function ($row) {
                            if ($row->storeDetails !== NULL) {
                                return $row->storeDetails->store_name;
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('category_id', function ($row) {
                            if ($row->categoryDetails !== NULL) {
                                return $row->categoryDetails->title;
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('product_id', function ($row) {
                            if ($row->productDetails !== NULL) {
                                return $row->productDetails->title;
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('distributor_id', function ($row) {
                            if ($row->distributorDetails !== NULL) {
                                return $row->distributorDetails->full_name;
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('season_id', function ($row) {
                            if ($row->seasonDetails !== NULL) {
                                return $row->seasonDetails->title;
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('updated_at', function ($row) {
                            return changeDateFormat($row->updated_at);
                        })
                        ->addColumn('status', function ($row) use ($isAllow, $allowedRoutes) {
                            if ($isAllow || in_array($this->statusUrl, $allowedRoutes)) {
                                if ($row->status == '1') {
                                    $status = ' <a href="javascript:void(0)" data-microtip-position="top" role="" aria-label="'.trans('custom_admin.label_active').'" data-id="'.customEncryptionDecryption($row->id).'" data-action-type="inactive" class="custom_font status"><span class="badge badge-pill badge-success">'.trans('custom_admin.label_active').'</span></a>';
                                } else {
                                    $status = ' <a href="javascript:void(0)" data-microtip-position="top" role="" aria-label="'.trans('custom_admin.label_inactive').'" data-id="'.customEncryptionDecryption($row->id).'" data-action-type="active" class="custom_font status"><span class="badge badge-pill badge-danger">'.trans('custom_admin.label_inactive').'</span></a>';
                                }
                            } else {
                                if ($row->status == '1') {
                                    $status = ' <a data-microtip-position="top" role="" aria-label="'.trans('custom_admin.label_active').'" class="custom_font"><span class="badge badge-pill badge-success">'.trans('custom_admin.label_active').'</span></a>';
                                } else {
                                    $status = ' <a data-microtip-position="top" role="" aria-label="'.trans('custom_admin.label_active').'" class="custom_font"><span class="badge badge-pill badge-danger">'.trans('custom_admin.label_inactive').'</span></a>';
                                }
                            }
                            return $status;
                        })
                        ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes) {
                            $btn = '';
                            if ($isAllow || in_array($this->viewUrl, $allowedRoutes)) {
                                $viewLink = route($this->routePrefix.'.'.$this->viewUrl, customEncryptionDecryption($row->id));

                                $btn .= '<a href="javascript:void(0)" data-id="'.customEncryptionDecryption($row->id).'" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm click-to-open" aria-label="'.trans('custom_admin.label_view').'"><i class="fa fa-eye" style="margin-left: -2px;"></i></a>';
                            }
                            if ($isAllow || in_array($this->deleteUrl, $allowedRoutes)) {
                                $btn .= ' <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-danger btn-circle btn-circle-sm delete" aria-label="'.trans('custom_admin.label_delete').'" data-action-type="delete" data-id="'.customEncryptionDecryption($row->id).'"><i class="fa fa-trash"></i></a>';
                            }                            
                            return $btn;
                        })
                        ->rawColumns(['status','action'])
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
        * Function name : view
        * Purpose       : This function is to view details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : Request $request, $id = null
        * Return Value  : Returns json
    */
    public function view(Request $request, $id = null) {
        $title      = trans('custom_admin.message_error');
        $message    = '<tr><td colspan="2">'.trans("custom_admin.message_no_records_found").'</td></tr>';
        $type       = 'error';

        try {
            if ($request->ajax()) {
                $id = customEncryptionDecryption($id, 'decrypt');
                if ($id != null) {
                    $details = AreaAnalyses::where('id', $id)->first();
                    if ($details != null) {
                        $title      = trans('custom_admin.message_success');
                        $type       = 'success';
                        $message    = '<tr><td>'.trans('custom_admin.label_email').'</td><td>'.$details->email.'</td></tr>';
                    }
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }
        return response()->json(['title' => $title, 'message' => $message, 'type' => $type]);
    }

}
