<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : DistributionAreasController
# Purpose           : Distribution Area Management
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

class DistributionAreasController extends Controller
{
    use GeneralMethods;
    public $controllerName  = 'DistributionArea';
    public $management;
    public $modelName       = 'DistributionArea';
    public $breadcrumb;
    public $routePrefix     = 'admin';
    public $pageRoute       = 'distributionArea';
    public $listUrl         = 'distributionArea.list';
    public $listRequestUrl  = 'distributionArea.ajax-list-request';
    public $addUrl          = 'distributionArea.add';
    public $editUrl         = 'distributionArea.edit';
    public $statusUrl       = 'distributionArea.change-status';
    public $deleteUrl       = 'distributionArea.delete';
    public $viewFolderPath  = 'admin.distributionArea';
    public $model           = 'DistributionArea';

    /*
        * Function Name : __construct
        * Purpose       : It sets some public variables for being accessed throughout this
        *                   controller and its related view pages
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Void
        * Return Value  : Mixed
    */
    public function __construct($data = null) {
        parent::__construct();

        $this->management   = trans('custom_admin.label_distribution_area');
        $this->model        = new DistributionArea();

        // Assign breadcrumb
        $this->assignBreadcrumb();
        
        // Variables assign for view page
        $this->assignShareVariables();
    }

    /*
        * Function name : list
        * Purpose       : This function is for the listing and searching
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns to the list page
    */
    public function list(Request $request) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_distribution_area_list'),
            'panelTitle'    => trans('custom_admin.label_distribution_area_list'),
            'pageType'      => 'LISTPAGE'
        ];

        try {
            // Start :: Manage restriction
            $data['isAllow']    = false;
            $restrictions       = checkingAllowRouteToUser($this->pageRoute.'.');
            if ($restrictions['is_super_admin']) {
                $data['isAllow'] = true;
            }
            $data['allowedRoutes']  = $restrictions['allow_routes'];
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
        * Purpose       : This function is for the return ajax data
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns news data
    */
    public function ajaxListRequest(Request $request) {
        $data['pageTitle'] = trans('custom_admin.label_distribution_area_list');
        $data['panelTitle']= trans('custom_admin.label_distribution_area_list');

        try {
            if ($request->ajax()) {
                $data = $this->model->get();

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
        * Purpose       : This function is to add page
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data
    */
    public function add(Request $request, $id = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_add_distribution_area'),
            'panelTitle'    => trans('custom_admin.label_add_distribution_area'),
            'pageType'      => 'CREATEPAGE'
        ];

        try {
            if ($request->isMethod('POST')) {
                $validationCondition = array(
                    'title'         => 'required|unique:'.($this->model)->getTable().',title,NULL,id,deleted_at,NULL',
                    'definition'    => 'required',
                );
                $validationMessages = array(
                    'title.required'        => trans('custom_admin.error_distribution_area'),
                    'title.unique'          => trans('custom_admin.error_unique_distribution_area'),
                    'definition.required'   => trans('custom_admin.error_distribution_area_definition'),
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $saveData                               = [];
                    $saveData['title']                      = $request->title ?? null;
                    $saveData['definition']                 = $request->definition ?? null;
                    $saveData['slug']                       = generateUniqueSlug($this->model, trim($request->title,' '));
                    $saveData['sort']                       = generateSortNumber($this->model);
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
        * Purpose       : This function is to edit news
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data
    */
    public function edit(Request $request, $id = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_edit_distribution_area'),
            'panelTitle'    => trans('custom_admin.label_edit_distribution_area'),
            'pageType'      => 'EDITPAGE'
        ];

        try {
            $data['id']         = $id;
            $data['stateId']    = $id = customEncryptionDecryption($id, 'decrypt');
            $data['details']    = $details = $this->model->where(['id' => $id])->first();
            
            if ($request->isMethod('POST')) {
                if ($id == null) {
                    $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
                    return redirect()->route($this->pageRoute.'.'.$this->listUrl);
                }
                $validationCondition = array(
                    'title' => 'required|unique:'.($this->model)->getTable().',title,'.$id.',id,deleted_at,NULL',
                    'definition' => 'required',
                );
                $validationMessages = array(
                    'title.required'    => trans('custom_admin.error_distribution_area'),
                    'title.unique'      => trans('custom_admin.error_unique_distribution_area'),
                    'definition.required'    => trans('custom_admin.error_distribution_area_definition'),
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $updateData                 = [];
                    $updateData['title']        = $request->title ?? null;
                    $updateData['definition']   = $request->definition ?? null;
                    $updateData['slug']         = generateUniqueSlug($this->model, trim($request->title,' '), $data['id']);
                    $updateData['description']  = $request->description ?? null;
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
                $id = customEncryptionDecryption($id, 'decrypt');
                if ($id != null) {
                    $details = $this->model->where('id', $id)->first();
                    if ($details != null) {
                        if ($details->status == '1') {
                            $isRelatedDistributorExist  = User::where(['distribution_area_id' => $id, 'type' => 'D'])->count();
                            $isRelatedStoreExist        = Store::where(['distribution_area_id' => $id])->count();
                            if ($isRelatedDistributorExist || $isRelatedStoreExist) {
                                $title      = trans('custom_admin.message_warning');
                                $message    = trans('custom_admin.message_inactive_related_distributor_or_store_records_exist');
                                $type       = 'warning';
                            } else {
                                $details->status = '0';
                                $details->save();
                                
                                $title      = trans('custom_admin.message_success');
                                $message    = trans('custom_admin.success_status_updated_successfully');
                                $type       = 'success';
                            }
                        } else if ($details->status == '0') {
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
        * Author        :
        * Created Date  :
        * Modified date :
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
                        $isRelatedDistributorExist  = User::where(['distribution_area_id' => $id, 'type' => 'D'])->count();
                        $isRelatedStoreExist        = Store::where(['distribution_area_id' => $id])->count();
                        if ($isRelatedDistributorExist || $isRelatedStoreExist) {
                            $title      = trans('custom_admin.message_warning');
                            $message    = trans('custom_admin.message_delete_related_distributor_or_store_records_exist');
                            $type       = 'warning';
                        } else {
                            $delete = $details->delete();
                            if ($delete) {
                                $title      = trans('custom_admin.message_success');
                                $message    = trans('custom_admin.success_data_deleted_successfully');
                                $type       = 'success';
                            } else {
                                $message    = trans('custom_admin.error_took_place_while_deleting');
                            }
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
        * Function name : sort
        * Purpose       : This function is to display record as per sort order
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Display list of records
    */
    public function sort(Request $request) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_sort'),
            'panelTitle'    => trans('custom_admin.label_sort'),
            'pageType'      => 'SORTPAGE',
            'order_by'      => 'sort',
            'order'         => 'asc'
        ];        

        try {
            $list = $this->model->whereNull('deleted_at')->orderBy($data['order_by'], $data['order'])->get();
            if ($list->count()) {
                $data['list'] = $list;
            } else {
                $data['list'] = [];
            }
            return view($this->viewFolderPath.'.sort', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        }
    }

    /*
        * Function name : saveSort
        * Purpose       : This function is to save sort
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Display list of records
    */
    public function saveSort(Request $request) {
        $title      = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type       = 'error';

        try {
            if ($request->isMethod('POST')) {
                foreach ($request->order as $sort => $id) {
                    $this->model->where(['id' => $id])->update(['sort' => $sort]);
                }
                $title      = trans('custom_admin.message_success');
                $message    = trans('custom_admin.success_sorted_successfully');
                $type       = 'success';
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
                $selectedIds        = $request->selectedIds;
                $actionType         = $request->actionType;
                $blockStatusCount   = $blockDeleteCount = 0;
                
                if (count($selectedIds) > 0) {
                    if ($actionType == 'active') {
                        $this->model->whereIn('id', $selectedIds)->update(['status' => '1']);
                        
                        $title      = trans('custom_admin.message_success');
                        $message    = trans('custom_admin.success_status_updated_successfully');
                        $type       = 'success';
                    } else if ($actionType == 'inactive') {
                        foreach ($selectedIds as $key => $id) {
                            $isRelatedDistributorExist  = User::where(['distribution_area_id' => $id, 'type' => 'D', 'status' => '1'])->count();
                            $isRelatedStoreExist        = Store::where(['distribution_area_id' => $id, 'status' => '1'])->count();
                            if ($isRelatedDistributorExist || $isRelatedStoreExist) {
                                $blockStatusCount++;
                            } else {
                                $this->model->where('id', $id)->update(['status' => '0']);
                                $message    = trans('custom_admin.success_status_updated_successfully');
                            }
                        }
                        
                        if ($blockStatusCount) {
                            $title      = trans('custom_admin.message_warning');
                            $message    = trans('custom_admin.message_inactive_related_distributor_or_store_records_exist');
                            $type       = 'warning';
                        } else {
                            $title      = trans('custom_admin.message_success');
                            $type       = 'success';
                        }
                    } else if ($actionType == 'delete') {
                        foreach ($selectedIds as $key => $id) {
                            $isRelatedDistributorExist  = User::where(['distribution_area_id' => $id, 'type' => 'D'])->count();
                            $isRelatedStoreExist        = Store::where(['distribution_area_id' => $id])->count();
                            if ($isRelatedDistributorExist || $isRelatedStoreExist) {
                                $blockDeleteCount++;
                            } else {
                                $this->model->where('id', $id)->delete();
                                $message    = trans('custom_admin.success_data_deleted_successfully');
                            }
                        }
                        
                        if ($blockDeleteCount) {
                            $title      = trans('custom_admin.message_warning');
                            $message    = trans('custom_admin.message_delete_related_distributor_or_store_records_exist');
                            $type       = 'warning';
                        } else {
                            $title      = trans('custom_admin.message_success');
                            $type       = 'success';
                        }
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

}