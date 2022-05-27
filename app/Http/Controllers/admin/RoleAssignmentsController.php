<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : RoleAssignmentsController
# Purpose           : Role Assignment Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Traits\GeneralMethods;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use DataTables;

class RoleAssignmentsController extends Controller
{
    use GeneralMethods;
    public $controllerName  = 'RoleAssignments';
    public $management;
    public $modelName       = 'RoleAssignment';
    public $breadcrumb;
    public $routePrefix     = 'admin';
    public $pageRoute       = 'roleAssignment';
    public $listUrl         = 'roleAssignment.list';
    public $listRequestUrl  = 'roleAssignment.ajax-list-request';
    public $addUrl          = 'roleAssignment.add';
    public $editUrl         = 'roleAssignment.edit';
    public $statusUrl       = 'roleAssignment.change-status';
    public $deleteUrl       = 'roleAssignment.delete';
    public $viewFolderPath  = 'admin.roleAssignment';
    public $model           = 'User';

    /*
        * Function Name : __construct
        * Purpose       : It sets some public variables for being accessed throughout this
        *                   controller and its related view pages
        * Input Params  : Void
        * Return Value  : Mixed
    */
    public function __construct() {
        parent::__construct();

        $this->management  = trans('custom_admin.label_menu_role_assignment');
        $this->model       = new User();

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
            'pageTitle'     => trans('custom_admin.label_role_assignment_list'),
            'panelTitle'    => trans('custom_admin.label_role_assignment_list'),
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
        $data['pageTitle'] = trans('custom_admin.label_role_assignment_list');
        $data['panelTitle']= trans('custom_admin.label_role_assignment_list');

        try {
            if ($request->ajax()) {
                $data = $this->model->where('id','<>','1')->where(['type' => 'D'])->whereNull('deleted_at');
                
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
                        ->addColumn('assign_roles', function ($row) {
                            $roles = '';
                            if ($row->userRoles && $row->userRoles->count()) {
                                foreach ($row->userRoles as $role) {
                                    $roles .= '<span class="badge badge-pill badge-warning" style="padding-top: 6px;">'.$role->name.'</span>';
                                }
                            } else {
                                $roles = 'NA';
                            }
                            return $roles;
                        })
                        ->addColumn('updated_at', function ($row) {
                            return changeDateFormat($row->updated_at);
                        })
                        ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes) {
                            $btn = '';
                            if ($isAllow || in_array($this->editUrl, $allowedRoutes)) {
                                $editLink = route($this->routePrefix.'.'.$this->editUrl, customEncryptionDecryption($row->id));

                                $btn .= '<a href="'.$editLink.'" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_edit').'"><i class="fa fa-edit"></i></a>';
                            }
                            if ($isAllow || in_array($this->deleteUrl, $allowedRoutes)) {
                                if ($row->userRoles && $row->userRoles->count()) {
                                    $btn .= ' <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-danger btn-circle btn-circle-sm delete" aria-label="'.trans('custom_admin.label_delete').' '.trans('custom_admin.label_role').'" data-action-type="delete" data-id="'.customEncryptionDecryption($row->id).'"><i class="fa fa-trash"></i></a>';
                                }
                            }                            
                            return $btn;
                        })
                        ->rawColumns(['assign_roles','status','action'])
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
            'pageTitle'     => trans('custom_admin.label_add_role_assignment'),
            'panelTitle'    => trans('custom_admin.label_add_role_assignment'),
            'pageType'      => 'CREATEPAGE'
        ];

        try {
            if ($request->isMethod('POST')) {
                $validationCondition = array(
                    'distributor_id'    => 'required',
                );
                $validationMessages = array(
                    'distributor_id.required'   => trans('custom_admin.error_select_distributor_id'),
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    // Start :: Inserting data to user_roles table
                    if ($request->role) {
                        foreach ($request->role as $valRole) {
                            $userRoleData           = new UserRole;
                            $userRoleData->user_id  = $request->distributor_id;
                            $userRoleData->role_id  = $valRole;
                            $userRoleData->save();
                        }
                        $this->generateToastMessage('success', trans('custom_admin.success_data_updated_successfully'), false);
                        return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                    }
                    // End :: Inserting data to user_roles table
                    else {
                        $this->generateToastMessage('error', trans('custom_admin.error_select_role'), false);
                        return redirect()->back()->withInput();
                    }
                }
            }

            $data['userList'] = User::where('id', '<>', '1')
                                    ->where(['type' => 'D', 'status' => '1'])
                                    ->whereNull('deleted_at')
                                    ->select('id','full_name','username','email')
                                    ->get();
            $data['roleList'] = Role::where('id', '<>', '1')
                                    ->where('is_admin', '1')
                                    ->whereNull('deleted_at')
                                    ->select('id','name','slug','is_admin')
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
            'pageTitle'     => trans('custom_admin.label_edit_role_assignment'),
            'panelTitle'    => trans('custom_admin.label_edit_role_assignment'),
            'pageType'      => 'EDITPAGE'
        ];

        try {
            $data['id']         = $id;
            $data['subAdminId'] = $id = customEncryptionDecryption($id, 'decrypt');
            $data['userList']   = User::where('id', '<>', '1')
                                        ->where(['type' => 'D', 'status' => '1'])
                                        ->whereNull('deleted_at')
                                        ->select('id','full_name','username','email')
                                        ->get();
            $data['roleList']   = Role::where('id', '<>', '1')
                                        ->where('is_admin', '1')
                                        ->select('id','name','slug','is_admin')
                                        ->get();
            $data['details']    = $details = $this->model->where(['id' => $id])->first();
            $roleIds = [];
            if ($data['details']->userRoles) {
                foreach ($data['details']->userRoles as $role) {
                    $roleIds[] = $role['id'];
                }
            }
            $data['roleIds'] = $roleIds;

            if ($request->isMethod('POST')) {
                if ($id == null) {
                    $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
                    return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                }
                $validationCondition = array(
                    // 'distributor_id'    => 'required',
                );
                $validationMessages = array(
                    // 'distributor_id.required'   => trans('custom_admin.error_select_distributor_id'),
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    // Start :: Deleting & Inserting data to user_roles table
                    if ($request->role) {
                        $deletingUserRoles = UserRole::where('user_id', $details->id)->delete();
                        foreach ($request->role as $valRole) {
                            $userRoleData           = new UserRole;
                            $userRoleData->user_id  = $id;
                            $userRoleData->role_id  = $valRole;
                            $userRoleData->save();
                        }
                        $this->generateToastMessage('success', trans('custom_admin.success_data_updated_successfully'), false);
                        return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                    }
                    // End :: Deleting & Inserting data to user_roles table
                    else {
                        $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
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
                        $delete = UserRole::where('user_id', $id)->delete();
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
                    UserRole::whereIn('user_id', $selectedIds)->delete();

                    $title      = trans('custom_admin.message_success');
                    $message    = trans('custom_admin.success_data_deleted_successfully');
                    $type       = 'success';
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
        * Function Name : deleteUploadedImage
        * Purpose       : This function is for delete uploaded image
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function deleteUploadedImage(Request $request, $id = null) {
        $title      = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type       = 'error';

        try {
            if ($request->ajax()) {
                $primaryId  = $request->primaryId ? customEncryptionDecryption($request->primaryId, 'decrypt') : null;
                $dbField    = $request->dbField ? $request->dbField : '';

                if ($primaryId != null && $dbField != '') {
                    $details = $this->model->where('id', $primaryId)->first();
                    if ($details != '') {
                        $response = unlinkFiles($details->profile_pic, 'account', true);
                        if ($response) {
                            $details->$dbField = null;
                            if ($details->save()) {
                                $title      = trans('custom_admin.message_success');
                                $message    = trans('custom_admin.message_image_uploaded_successfully');
                                $type       = 'success';
                            } else {
                                $message    = trans('custom_admin.error_took_place_while_deleting');
                            }
                        } else {
                            $message    = trans('custom_admin.error_took_place_while_deleting');
                        }
                    } else {
                        $message = trans('custom_admin.error_invalid');
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