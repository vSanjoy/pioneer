<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : AreaAnalysisController
# Purpose           : Area Analysis Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Traits\GeneralMethods;
use App\Models\Season;
use App\Models\User;
use App\Models\Store;
use App\Models\DistributionArea;
use App\Models\Category;
use App\Models\Product;
use App\Models\AreaAnalyses;
use App\Models\AreaAnalysisDetail;
use DataTables;

class AreaAnalysesController extends Controller
{
    use GeneralMethods;
    public $controllerName  = 'AreaAnalyses';
    public $management;
    public $modelName       = 'AreaAnalyses';
    public $breadcrumb;
    public $routePrefix     = 'admin';
    public $pageRoute       = 'areaAnalysis';
    public $listUrl         = 'areaAnalysis.list';
    public $listRequestUrl  = 'areaAnalysis.ajax-list-request';
    public $addUrl          = 'areaAnalysis.add';
    public $editUrl         = 'areaAnalysis.edit';
    public $statusUrl       = 'areaAnalysis.change-status';
    public $deleteUrl       = 'areaAnalysis.delete';
    public $viewFolderPath  = 'admin.areaAnalysis';
    public $model           = 'AreaAnalyses';

    /*
        * Function Name : __construct
        * Purpose       : It sets some public variables for being accessed throughout this
        *                   controller and its related view pages
        * Input Params  : Void
        * Return Value  : Mixed
    */
    public function __construct() {
        parent::__construct();

        $this->management  = trans('custom_admin.label_menu_area_analysis');
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
            'pageTitle'     => trans('custom_admin.label_area_analysis_list'),
            'panelTitle'    => trans('custom_admin.label_area_analysis_list'),
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
        $data['pageTitle'] = trans('custom_admin.label_area_analysis_list');
        $data['panelTitle']= trans('custom_admin.label_area_analysis_list');

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
                            if ($isAllow || in_array($this->editUrl, $allowedRoutes)) {
                                $editLink = route($this->routePrefix.'.'.$this->editUrl, customEncryptionDecryption($row->id));

                                $btn .= '<a href="'.$editLink.'" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_edit').'"><i class="fa fa-edit"></i></a>';
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
        * Function name : add
        * Purpose       : This function is to add sub admin
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function add(Request $request, $id = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_add_area_analysis'),
            'panelTitle'    => trans('custom_admin.label_add_area_analysis'),
            'pageType'      => 'CREATEPAGE'
        ];

        try {
            if ($request->isMethod('POST')) {
                $validationCondition = array(
                    'season_id'             => 'required',
                    'year'                  => 'required',
                    'analysis_date'         => 'required',
                    'distribution_area_id'  => 'required',
                    'distributor_id'        => 'required',
                    'store_id'              => 'required',
                    'category_id'           => 'required',
                    'product_id'            => 'required',
                    'target_monthly_sales'  => 'required',
                    'type_of_analysis'      => 'required',
                    'action'                => 'required',
                    'result'                => 'required',
                    'why'                   => 'required',
                    'comment'               => 'required',
                );
                $validationMessages = array(
                    'season_id.required'                    => trans('custom_admin.error_season_id'),
                    'year.required'                         => trans('custom_admin.error_year'),
                    'analysis_date.required'                => trans('custom_admin.error_analysis_date'),
                    'distribution_area_id.required'         => trans('custom_admin.error_distribution_area'),
                    'distributor_id.required'               => trans('custom_admin.error_distributor'),
                    'store_id.required'                     => trans('custom_admin.error_store'),
                    'category_id.required'                  => trans('custom_admin.error_category'),
                    'product_id.required'                   => trans('custom_admin.error_product'),
                    'target_monthly_sales.required'         => trans('custom_admin.error_target_monthly_sales'),
                    'type_of_analysis.required'             => trans('custom_admin.error_type_of_analysis'),
                    'action.required'                       => trans('custom_admin.error_action'),
                    'result.required'                       => trans('custom_admin.error_result'),
                    'why.required'                          => trans('custom_admin.error_why'),
                    'comment.required'                      => trans('custom_admin.error_comment'),
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $saveData                           = [];
                    $saveData['season_id']              = $request->season_id ?? null;
                    $saveData['year']                   = $request->year ?? null;
                    $saveData['analysis_date']          = date('Y-m-d', strtotime($request->analysis_date)) ?? null;
                    $saveData['distribution_area_id']   = $request->distribution_area_id ?? null;
                    $saveData['distributor_id']         = $request->distributor_id ?? null;
                    $saveData['store_id']               = $request->store_id ?? null;
                    $saveData['category_id']            = $request->category_id ?? null;
                    $saveData['product_id']             = $request->product_id ?? null;
                    $saveData['target_monthly_sales']   = $request->target_monthly_sales ?? null;
                    $saveData['type_of_analysis']       = $request->type_of_analysis ?? null;
                    $saveData['action']                 = $request->action ?? null;
                    $saveData['result']                 = $request->result ?? null;
                    $saveData['why']                    = $request->why ?? null;
                    $saveData['comment']                = $request->comment ?? null;
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

            $data['distributionAreas']  = DistributionArea::select('id','title')
                                                    ->where(['status' => '1'])
                                                    ->orderBy('title', 'ASC')
                                                    ->get();
            $data['seasons']            = Season::select('id','title','sort')
                                                    ->where(['status' => '1'])
                                                    ->orderBy('sort', 'ASC')
                                                    ->get();
            $data['categories']         = Category::where(['status' => '1'])
                                                    ->select('id','title')
                                                    ->orderBy('title', 'ASC')
                                                    ->get();
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
            'pageTitle'     => trans('custom_admin.label_edit_area_analysis'),
            'panelTitle'    => trans('custom_admin.label_edit_area_analysis'),
            'pageType'      => 'EDITPAGE'
        ];

        try {
            $data['id']                 = $id;
            $data['storeId']            = $id = customEncryptionDecryption($id, 'decrypt');
            $data['seasons'] = Season::select('id','title','sort') -> where(['status' => '1']) -> orderBy('sort', 'ASC') -> get();
            $data['details'] = $details = $this->model->where(['id' => $id])->first();
            $data['distributionAreas'] = DistributionArea::where(['status' => '1'])  -> select('id','title') -> get();
            $data['distributors'] = User::where(['status' => '1', 'type' => 'D', 'distribution_area_id' => $details->distribution_area_id ])  -> select('id','first_name') -> get();
            $data['stores'] = Store::where(['status' => '1','distribution_area_id' => $details->distribution_area_id]) -> select('id','store_name') -> orderBy('sort', 'ASC') -> get();
            $data['categories'] = Category::where(['status' => '1']) -> select('id','title') -> orderBy('title', 'ASC') -> get();
            $data['products'] = Product::where(['status' => '1', 'category_id' => $details->category_id]) -> select('id','title') -> orderBy('sort', 'ASC') -> get();
            
            if ($request->isMethod('POST')) {
                if ($id == null) {
                    $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
                    return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                }
                $validationCondition = array(
                    'season_id'             => 'required',
                    'year'                  => 'required',
                    'analysis_date'         => 'required',
                    'distribution_area_id'  => 'required',
                    'distributor_id'        => 'required',
                    'store_id'              => 'required',
                    'category_id'           => 'required',
                    'product_id'            => 'required',
                    'target_monthly_sales'  => 'required',
                    'type_of_analysis'      => 'required',
                    'action'                => 'required',
                    'result'                => 'required',
                    'why'                   => 'required',
                    'comment'               => 'required',
                );
                $validationMessages = array(
                    'season_id.required'                    => trans('custom_admin.error_season_id'),
                    'year.required'                         => trans('custom_admin.error_year'),
                    'analysis_date.required'                => trans('custom_admin.error_analysis_date'),
                    'distribution_area_id.required'         => trans('custom_admin.error_distribution_area'),
                    'distributor_id.required'               => trans('custom_admin.error_distributor'),
                    'store_id.required'                     => trans('custom_admin.error_store'),
                    'category_id.required'                  => trans('custom_admin.error_category'),
                    'product_id.required'                   => trans('custom_admin.error_product'),
                    'target_monthly_sales.required'         => trans('custom_admin.error_target_monthly_sales'),
                    'type_of_analysis.required'             => trans('custom_admin.error_type_of_analysis'),
                    'action.required'                       => trans('custom_admin.error_action'),
                    'result.required'                       => trans('custom_admin.error_result'),
                    'why.required'                          => trans('custom_admin.error_why'),
                    'comment.required'                      => trans('custom_admin.error_comment'),
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $updateData                           = [];
                    $updateData['season_id']              = $request->season_id ?? null;
                    $updateData['year']                   = $request->year ?? null;
                    $updateData['analysis_date']          = date('Y-m-d', strtotime($request->analysis_date)) ?? null;
                    $updateData['distribution_area_id']   = $request->distribution_area_id ?? null;
                    $updateData['distributor_id']         = $request->distributor_id ?? null;
                    $updateData['store_id']               = $request->store_id ?? null;
                    $updateData['category_id']            = $request->category_id ?? null;
                    $updateData['product_id']             = $request->product_id ?? null;
                    $updateData['target_monthly_sales']   = $request->target_monthly_sales ?? null;
                    $updateData['type_of_analysis']       = $request->type_of_analysis ?? null;
                    $updateData['action']                 = $request->action ?? null;
                    $updateData['result']                 = $request->result ?? null;
                    $updateData['why']                    = $request->why ?? null;
                    $updateData['comment']                = $request->comment ?? null;
                    $update = $details->update($updateData);

                    if ($update) {
                        $this->generateToastMessage('success', trans('custom_admin.success_data_updated_successfully'), false);
                        return redirect()->route($this->routePrefix.'.'.$this->listUrl);
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

    /*
        * Function name : status
        * Purpose       : This function is to status
        * Input Params  : Request $request, $id = null
        * Return Value  : Returns json
    */
    public function status(Request $request, $id = null) {
        $title      = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type       = 'error';

        try {
            if ($request->ajax()) {
                $id = customEncryptionDecryption($id, 'decrypt');
                if ($id != null) {
                    $details = $this->model->where('id', $id)->first();
                    if ($details != null) {
                        if ($details->status == 1) {
                            $details->status = '0';
                            $details->save();
                            
                            $title      = trans('custom_admin.message_success');
                            $message    = trans('custom_admin.success_status_updated_successfully');
                            $type       = 'success';        
                        } else if ($details->status == 0) {
                            $details->status = '1';
                            $details->save();
        
                            $title      = trans('custom_admin.message_success');
                            $message    = trans('custom_admin.success_status_updated_successfully');
                            $type       = 'success';
                        }
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

    /*
        * Function name : delete
        * Purpose       : This function is to delete record
        * Input Params  : Request $request, $id = null
        * Return Value  : Returns json
    */
    public function delete(Request $request, $id = null) {
        $title      = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type       = 'error';

        try {
            if ($request->ajax()) {
                $id = customEncryptionDecryption($id, 'decrypt');
                if ($id != null) {
                    $details = $this->model->where('id', $id)->first();
                    if ($details != null) {
                        $delete = $details->delete();
                        if ($delete) {
                            $title      = trans('custom_admin.message_success');
                            $message    = trans('custom_admin.success_data_deleted_successfully');
                            $type       = 'success';
                        } else {
                            $message    = trans('custom_admin.error_took_place_while_deleting');
                        }
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

    /*
        * Function name : bulkActions
        * Purpose       : This function is to delete record, active/inactive
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function bulkActions(Request $request) {
        $title      = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type       = 'error';

        try {
            if ($request->ajax()) {
                $selectedIds    = $request->selectedIds;
                $actionType     = $request->actionType;
                if (count($selectedIds) > 0) {
                    if ($actionType ==  'active') {
                        $this->model->whereIn('id', $selectedIds)->update(['status' => '1']);
                        
                        $title      = trans('custom_admin.message_success');
                        $message    = trans('custom_admin.success_status_updated_successfully');
                        $type       = 'success';
                    } elseif ($actionType ==  'inactive') {
                        $this->model->whereIn('id', $selectedIds)->update(['status' => '0']);

                        $title      = trans('custom_admin.message_success');
                        $message    = trans('custom_admin.success_status_updated_successfully');
                        $type       = 'success';
                    } else {
                        $this->model->whereIn('id', $selectedIds)->delete();

                        $title      = trans('custom_admin.message_success');
                        $message    = trans('custom_admin.success_data_deleted_successfully');
                        $type       = 'success';
                    }
                } else {
                    $message = trans('custom_admin.error_invalid');
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }
        return response()->json(['title' => $title, 'message' => $message, 'type' => $type]);
    }

    /*
        * Function Name : ajaxDistributionAreaWiseDistributorsStores
        * Purpose       : This function is to get distribution area wise distributors and stores
        * Author        : 
        * Created Date  : 
        * Modified date : 
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function ajaxDistributionAreaWiseDistributorsStores(Request $request) {
        $title              = trans('custom_admin.message_error');
        $message            = trans('custom_admin.error_something_went_wrong');
        $type               = 'error';
        $distributorOptions = $storeOptions = '<option value="">--'.trans('custom_admin.label_select').'--</option>';

        try {
            if ($request->ajax()) {
                $distributionAreaId = $request->distribution_area_id ?? '';
                if ($distributionAreaId != '') {
                    $title      = trans('custom_admin.message_success');
                    $message    = trans('custom_admin.message_success');
                    $type       = 'success';
                    // Distributors
                    $distributors = User::select('id','full_name','email','distribution_area_id')->where(['distribution_area_id' => $distributionAreaId, 'type' => 'D', 'status' => '1'])->whereNull('deleted_at')->orderBy('full_name', 'ASC')->get();
                    if ($distributors->count()) {
                        foreach ($distributors as $keyDistributor => $valDistributor) {
                            $distributorOptions .= '<option value="'.$valDistributor->id.'">'.$valDistributor->full_name .' ('.$valDistributor->email.')'.'</option>';
                        }
                    }
                    // Stores
                    $stores = Store::select('id','store_name','distribution_area_id')->where(['distribution_area_id' => $distributionAreaId, 'status' => '1'])->whereNull('deleted_at')->orderBy('store_name', 'ASC')->get();
                    if ($stores->count()) {
                        foreach ($stores as $keystore => $valStore) {
                            $storeOptions .= '<option value="'.$valStore->id.'">'.$valStore->store_name.'</option>';
                        }
                    }
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }
        return response()->json(['title' => $title, 'message' => $message, 'type' => $type, 'distributorOptions' => $distributorOptions, 'storeOptions' => $storeOptions]);
    }
    
    /*
        * Function Name : ajaxCategoryWiseProducts
        * Purpose       : This function is to get category wise products
        * Author        : 
        * Created Date  : 
        * Modified date : 
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function ajaxCategoryWiseProducts(Request $request) {
        $title      = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type       = 'error';
        $options    = '<option value="">--'.trans('custom_admin.label_select').'--</option>';

        try {
            if ($request->ajax()) {
                $categoryId = $request->category_id ?? '';
                if ($categoryId != '') {
                    $title      = trans('custom_admin.message_success');
                    $message    = trans('custom_admin.message_success');
                    $type       = 'success';
                    // Products
                    $products = Product::select('id','title','sort','category_id')->where(['category_id' => $categoryId, 'status' => '1'])->whereNull('deleted_at')->orderBy('title', 'ASC')->get();
                    if ($products->count()) {
                        foreach ($products as $keyProduct => $valProduct) {
                            $options .= '<option value="'.$valProduct->id.'">'.$valProduct->title.'</option>';
                        }
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
