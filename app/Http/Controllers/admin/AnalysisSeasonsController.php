<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : AnalysisSeasonsController
# Purpose           : Analysis Seasons Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Traits\GeneralMethods;
use App\Models\AnalysisSeason;
use App\Models\DistributionArea;
use App\Models\User;
use App\Models\Store;
use App\Models\Analyses;
use App\Models\AnalysesDetail;
use App\Models\Category;
use DataTables;

class AnalysisSeasonsController extends Controller
{
    use GeneralMethods;
    public $controllerName          = 'AnalysisSeasons';
    public $management;
    public $modelName               = 'AnalysisSeason';
    public $breadcrumb;
    public $routePrefix             = 'admin';
    public $pageRoute               = 'analysisSeason';
    public $listUrl                 = 'analysisSeason.list';
    public $listRequestUrl          = 'analysisSeason.ajax-list-request';
    public $addUrl                  = 'analysisSeason.add';
    public $editUrl                 = 'analysisSeason.edit';
    public $statusUrl               = 'analysisSeason.change-status';
    public $deleteUrl               = 'analysisSeason.delete';
    public $detailsListUrl          = 'analysisSeason.distribution-area-list';
    public $detailsListRequestUrl   = 'analysisSeason.ajax-distribution-area-list-request';
    public $viewFolderPath          = 'admin.analysisSeason';
    public $model                   = 'AnalysisSeason';

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
        $this->model       = new AnalysisSeason();

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
            'pageTitle'     => trans('custom_admin.label_analysis_season_list'),
            'panelTitle'    => trans('custom_admin.label_analysis_season_list'),
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
        $data['pageTitle'] = trans('custom_admin.label_analysis_season_list');
        $data['panelTitle']= trans('custom_admin.label_analysis_season_list');

        try {
            if ($request->ajax()) {
                $data = $this->model->whereNull('deleted_at');

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
                            if ($isAllow || in_array($this->editUrl, $allowedRoutes)) {
                                $editLink = route($this->routePrefix.'.'.$this->editUrl, customEncryptionDecryption($row->id));

                                $btn .= '<a href="'.$editLink.'" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_edit').'" target="_blank"><i class="fa fa-edit"></i></a>';
                            }
                            // if ($isAllow || in_array($this->deleteUrl, $allowedRoutes)) {
                            //     $btn .= ' <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-danger btn-circle btn-circle-sm delete" aria-label="'.trans('custom_admin.label_delete').'" data-action-type="delete" data-id="'.customEncryptionDecryption($row->id).'"><i class="fa fa-trash"></i></a>';
                            // }

                            if ($isAllow || in_array($this->detailsListUrl, $allowedRoutes)) {
                                $detailsListLink = route($this->routePrefix.'.'.$this->detailsListUrl, customEncryptionDecryption($row->id));

                                $btn .= ' <a href="'.$detailsListLink.'" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_analysis').'" target="_blank"><i class="fa fa-list"></i></a>';
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
        * Function name : add
        * Purpose       : This function is to add sub admin
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function add(Request $request, $id = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_add_analysis_season'),
            'panelTitle'    => trans('custom_admin.label_add_analysis_season'),
            'pageType'      => 'CREATEPAGE'
        ];

        try {
            if ($request->isMethod('POST')) {
                $validationCondition = array(
                    'title' => 'required|unique:'.($this->model)->getTable().',title,NULL,id,deleted_at,NULL',
                    'year'  => 'required',
                );
                $validationMessages = array(
                    'title.required'    => trans('custom_admin.error_title'),
                    'title.unique'      => trans('custom_admin.error_title_unique'),
                    'year.required'     => trans('custom_admin.error_year'),
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $saveData           = [];
                    $saveData['title']  = $request->title ?? null;
                    $saveData['slug']   = generateUniqueSlug($this->model, trim($request->title,' '));
                    $saveData['year']   = $request->year ?? null;
                    $saveData['sort']   = generateSortNumber($this->model);
                    $save = $this->model->create($saveData);

                    if ($save) {
                        $this->generateToastMessage('success', trans('custom_admin.success_data_updated_successfully'), false);
                        return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                    } else {
                        $this->generateToastMessage('error', trans('custom_admin.error_took_place_while_updating'), false);
                        return redirect()->back()->withInput();
                    }
                }
            }

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
        * Function name : edit
        * Purpose       : This function is to update form
        * Input Params  : Request $request
        * Return Value  : Returns sub admin data
    */
    public function edit(Request $request, $id = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_edit_analysis_season'),
            'panelTitle'    => trans('custom_admin.label_edit_analysis_season'),
            'pageType'      => 'EDITPAGE'
        ];

        try {
            $data['id']         = $id;
            $data['analysisSeasonId'] = $id = customEncryptionDecryption($id, 'decrypt');
            $data['details']    = $details = $this->model->where(['id' => $id])->first();
            
            if ($request->isMethod('POST')) {
                if ($id == null) {
                    $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
                    return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                }
                $validationCondition = array(
                    'title' => 'required|unique:'.($this->model)->getTable().',title,'.$id.',id,deleted_at,NULL',
                    'year'  => 'required',
                );
                $validationMessages = array(
                    'title.required'    => trans('custom_admin.error_title'),
                    'title.unique'      => trans('custom_admin.error_title_unique'),
                    'year.required'     => trans('custom_admin.error_year'),
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $updateData             = [];
                    $updateData['title']    = $request->title ?? null;
                    $updateData['slug']     = generateUniqueSlug($this->model, trim($request->title,' '), $data['id']);
                    $updateData['year']     = $request->year ?? null;
                    $update = $details->update($updateData);

                    if ($update) {
                        $this->generateToastMessage('success', trans('custom_admin.success_data_updated_successfully'), false);
                        $this->windowCloseOnSuccess();
                        // return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                    } else {
                        $this->generateToastMessage('error', trans('custom_admin.error_took_place_while_updating'), false);
                        return redirect()->back()->withInput();
                    }
                }
            }

            return view($this->viewFolderPath.'.edit', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        }
    }

    
    /******************************************************** Distribution Area ********************************************************/

    /*
        * Function name : distributionAreaList
        * Purpose       : This function is for the distribution area list
        * Input Params  : Request $request
        * Return Value  : Returns to the distribution area list page
    */
    public function distributionAreaList(Request $request, $analysisSeasonId = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_distribution_area_list'),
            'panelTitle'    => trans('custom_admin.label_distribution_area_list'),
            'pageType'      => 'LISTPAGE'
        ];

        try {
            $data['analysisSeasonId']   = $analysisSeasonId;
            $data['analysisSeason']     = $this->model->where(['id' => customEncryptionDecryption($analysisSeasonId, 'decrypt')])->first();

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
    public function ajaxDistributionAreaListRequest(Request $request, $analysisSeasonId = null) {
        $data['pageTitle'] = trans('custom_admin.label_distribution_area_list');
        $data['panelTitle']= trans('custom_admin.label_distribution_area_list');

        try {
            if ($request->ajax()) {
                $data = DistributionArea::where(['status' => '1'])->whereNull('deleted_at');

                // Start :: Manage restriction
                $isAllow = false;
                $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
                if ($restrictions['is_super_admin']) {
                    $isAllow = true;
                }
                $allowedRoutes  = $restrictions['allow_routes'];
                // End :: Manage restriction

                return Datatables::of($data, $isAllow, $allowedRoutes, $analysisSeasonId)
                        ->addIndexColumn()
                        ->addColumn('title', function ($row) {
                            return $row->title;
                        })
                        ->addColumn('created_at', function ($row) {
                            return date('d-m-Y', strtotime($row->created_at));
                        })
                        ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes, $analysisSeasonId) {
                            $btn = '<a href="'.route($this->routePrefix.'.analysisSeason.distributor-list', [$analysisSeasonId, customEncryptionDecryption($row->id)]).'" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_distributor').'"><i class="fa fa-user ml_minus_1"></i></a>';

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


    /******************************************************** Distributor ********************************************************/

    /*
        * Function name : distributorList
        * Purpose       : This function is for the distributor list
        * Input Params  : Request $request
        * Return Value  : Returns to the distributor list page
    */
    public function distributorList(Request $request, $analysisSeasonId = null, $distributionAreaId = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_distributor_list'),
            'panelTitle'    => trans('custom_admin.label_distributor_list'),
            'pageType'      => 'LISTPAGE'
        ];

        try {
            $data['analysisSeasonId']   = $analysisSeasonId;
            $data['distributionAreaId'] = $distributionAreaId;
            $data['analysisSeason']     = $this->model->where(['id' => customEncryptionDecryption($analysisSeasonId, 'decrypt')])->first();
            $data['distributionArea']   = DistributionArea::where(['id' => customEncryptionDecryption($distributionAreaId, 'decrypt')])->first();

            // Start :: Manage restriction
            $data['isAllow'] = false;
            $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
            if ($restrictions['is_super_admin']) {
                $data['isAllow'] = true;
            }
            $data['allowedRoutes'] = $restrictions['allow_routes'];
            // End :: Manage restriction

            return view($this->viewFolderPath.'.distributor_list', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.dashboard');
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.dashboard');
        }
    }

    /*
        * Function name : ajaxDistributorListRequest
        * Purpose       : This function is for the reutrn ajax data
        * Input Params  : Request $request
        * Return Value  : Returns data
    */
    public function ajaxDistributorListRequest(Request $request, $analysisSeasonId = null, $distributionAreaId = null) {
        $data['pageTitle'] = trans('custom_admin.label_distributor_list');
        $data['panelTitle']= trans('custom_admin.label_distributor_list');

        try {
            if ($request->ajax()) {
                $data = User::where(['distribution_area_id' => customEncryptionDecryption($distributionAreaId, 'decrypt'), 'type' => 'D', 'status' => '1'])->whereNull('deleted_at');

                // Start :: Manage restriction
                $isAllow = false;
                $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
                if ($restrictions['is_super_admin']) {
                    $isAllow = true;
                }
                $allowedRoutes  = $restrictions['allow_routes'];
                // End :: Manage restriction

                return Datatables::of($data, $isAllow, $allowedRoutes, $analysisSeasonId, $distributionAreaId)
                        ->addIndexColumn()
                        ->addColumn('whatsapp_no', function ($row) {
                            return $row->userDetails->whatsapp_no;
                        })
                        ->addColumn('distribution_area_id', function ($row) {
                            if ($row->distributionAreaDetails) {
                                return $row->distributionAreaDetails->title;
                            } else {
                                return 'NA';
                            }
                        })
                        ->addColumn('created_at', function ($row) {
                            return date('d-m-Y', strtotime($row->created_at));
                        })
                        ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes, $analysisSeasonId, $distributionAreaId) {
                            $btn = '<a href="'.route($this->routePrefix.'.analysisSeason.store-list', [$analysisSeasonId, $distributionAreaId, customEncryptionDecryption($row->id)]).'" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_store').'"><i class="fa fa-university ml_minus_1" aria-hidden="true"></i></a>';

                            return $btn;
                        })
                        ->rawColumns(['status','action'])
                        ->make(true);
            }

            return view($this->viewFolderPath.'.distributor_list');
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
    public function storeList(Request $request, $analysisSeasonId = null, $distributionAreaId = null, $distributorId = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_store_list'),
            'panelTitle'    => trans('custom_admin.label_store_list'),
            'pageType'      => 'LISTPAGE'
        ];

        try {
            $data['analysisSeasonId']   = $analysisSeasonId;
            $data['distributionAreaId'] = $distributionAreaId;
            $data['distributorId']      = $distributorId;
            $data['analysisSeason']     = $this->model->where(['id' => customEncryptionDecryption($analysisSeasonId, 'decrypt')])->first();
            $data['distributionArea']   = DistributionArea::where(['id' => customEncryptionDecryption($distributionAreaId, 'decrypt')])->first();
            $data['distributor']        = User::where(['id' => customEncryptionDecryption($distributorId, 'decrypt')])->first();

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
    public function ajaxStoreListRequest(Request $request, $analysisSeasonId = null, $distributionAreaId = null, $distributorId = null, $storeId = null) {
        $data['pageTitle'] = trans('custom_admin.label_store_list');
        $data['panelTitle']= trans('custom_admin.label_store_list');

        try {
            if ($request->ajax()) {
                $data = Store::where(['distribution_area_id' => customEncryptionDecryption($distributionAreaId, 'decrypt'), 'status' => '1'])->whereNull('deleted_at');

                // Start :: Manage restriction
                $isAllow = false;
                $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
                if ($restrictions['is_super_admin']) {
                    $isAllow = true;
                }
                $allowedRoutes  = $restrictions['allow_routes'];
                // End :: Manage restriction

                return Datatables::of($data, $isAllow, $allowedRoutes, $analysisSeasonId, $distributionAreaId, $distributorId, $storeId)
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
                        ->addColumn('progress_status', function ($row) {
                            $currentStatus = 'NA';
                            $bgColor = 'btn-secondary';
                            if ($row->progress_status == 'IP') {
                                $currentStatus = trans('custom_admin.label_in_progress');
                                $bgColor = 'btn-success';
                            } else if ($row->progress_status == 'CP') {
                                $currentStatus = trans('custom_admin.label_complete');
                                $bgColor = 'btn-dark';
                            }

                            $storeProgressStatuses = '';
                            $storeProgressStatuses .= '<div class="btn-group dropdownstatus">';
                            $storeProgressStatuses .=      '<button type="button" class="btn '.$bgColor.' btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                            $storeProgressStatuses .=          $currentStatus;
                            $storeProgressStatuses .= '    </button>';
                            $storeProgressStatuses .= '    <div class="dropdown-menu">';

                            if ($row->progress_status != 'IP') {
                                $storeProgressStatuses .= '        <a class="dropdown-item store-status" href="javascript:void(0)" data-id="'.customEncryptionDecryption($row->id).'" data-action-type="IP">'.trans('custom_admin.label_in_progress').'</a>';
                            }
                            if ($row->progress_status != 'CP') {
                                $storeProgressStatuses .= '        <a class="dropdown-item store-status" href="javascript:void(0)" data-id="'.customEncryptionDecryption($row->id).'" data-action-type="CP">'.trans('custom_admin.label_complete').'</a>';
                            }
                            $storeProgressStatuses .= '    </div>';
                            $storeProgressStatuses .= '</div>';

                            return $storeProgressStatuses;
                        })
                        ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes, $analysisSeasonId, $distributionAreaId, $distributorId) {
                            $btn = '<a href="'.route($this->routePrefix.'.analysisSeason.analysis', [$analysisSeasonId, $distributionAreaId, $distributorId, customEncryptionDecryption($row->id)]).'" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_analysis').'" target="_blank"><i class="fas fa-chart-bar ml_minus_1" aria-hidden="true"></i>';

                            return $btn;
                        })
                        ->rawColumns(['distribution_area_id','sale_size_category','progress_status','action'])
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

    /*
        * Function name : status
        * Purpose       : This function is to status
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request, $id = null
        * Return Value  : Returns json
    */
    public function status(Request $request, $id = null) {
        $title      = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type       = 'error';

        try {
            if ($request->ajax()) {
                $id         = customEncryptionDecryption($id, 'decrypt');
                $actionType = $request->actionType ?? null;

                if ($id != null && $actionType != null) {
                    $details = Store::where('id', $id)->first();
                    if ($details != null) {
                        if ($actionType == 'IP') {
                            $details->progress_status = 'IP';
                        } else if ($actionType == 'CP') {
                            $details->progress_status = 'CP';
                        }
                        $details->save();
                            
                        $title      = trans('custom_admin.message_success');
                        $message    = trans('custom_admin.success_status_updated_successfully');
                        $type       = 'success';
                    } else {
                        $message = trans('custom_admin.error_invalid');
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
    
    
    /******************************************************** Analysis ********************************************************/
    /*
        * Function name : analysisUpdate
        * Purpose       : This function is to update form
        * Input Params  : Request $request
        * Return Value  : Returns sub admin data
    */
    public function analysisUpdate(Request $request, $analysisSeasonId = null, $distributionAreaId = null, $distributorId = null, $storeId = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_analysis'),
            'panelTitle'    => trans('custom_admin.label_analysis'),
            'pageType'      => 'EDITPAGE'
        ];

        try {
            $data['id']             = 0;
            $data['analysisValues'] = $analysisValues = [];
            $data['details']        = $details = Analyses::where([
                                                            'analysis_season_id' => customEncryptionDecryption($analysisSeasonId, 'decrypt'),
                                                            'distribution_area_id' => customEncryptionDecryption($distributionAreaId, 'decrypt'),
                                                            'distributor_id' => customEncryptionDecryption($distributorId, 'decrypt'),
                                                            'store_id' => customEncryptionDecryption($storeId, 'decrypt')
                                                        ])->first();
            if ($details) {
                $data['id']     = $details->id;

                foreach ($details->analysesDetails as $item) {
                    $categoryId = $item->category_id;
                    $productId  = $item->product_id;

                    $analysisValues[$categoryId][$productId]['analyses_details_id'] = $item->id;
                    $analysisValues[$categoryId][$productId]['target_monthly_sales']= $item->target_monthly_sales;
                    $analysisValues[$categoryId][$productId]['type_of_analysis']    = $item->type_of_analysis;
                    $analysisValues[$categoryId][$productId]['action']              = $item->action;
                }

                if (count($analysisValues)) {
                    $data['analysisValues'] = $analysisValues;
                }
            }
                                            
            $data['analysisSeasonId']   = $analysisSeasonId;
            $data['distributionAreaId'] = $distributionAreaId;
            $data['distributorId']      = $distributorId;
            $data['storeId']            = $storeId;
            
            $decryptAnalysisSeasonId    = customEncryptionDecryption($analysisSeasonId, 'decrypt');
            $decryptDistributionAreaId  = customEncryptionDecryption($distributionAreaId, 'decrypt');
            $decryptDistributorId       = customEncryptionDecryption($distributorId, 'decrypt');
            $decryptStoreId             = customEncryptionDecryption($storeId, 'decrypt');

            $data['analysisSeason']     = $this->model->where(['id' => $decryptAnalysisSeasonId])->first();
            $data['distributionArea']   = DistributionArea::where(['id' => $decryptDistributionAreaId])->first();
            $data['distributor']        = User::where(['id' => $decryptDistributorId])->first();
            $data['store']              = Store::where(['id' => $decryptStoreId])->first();
            $data['categories']         = Category::orderBy('title', 'ASC')->get();
            
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
            return redirect()->route($this->routePrefix.'.analysisSeason.store-list', [$analysisSeasonId, $distributionAreaId, $distributorId]);
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.analysisSeason.store-list', [$analysisSeasonId, $distributionAreaId, $distributorId]);
        }
    }

}
