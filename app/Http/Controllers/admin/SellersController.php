<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : SellersController
# Purpose           : Distributor Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Traits\GeneralMethods;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserRole;
use App\Models\UserDistributionArea;
use App\Models\DistributionArea;
use DataTables;

class SellersController extends Controller
{
    use GeneralMethods;
    public $controllerName  = 'Sellers';
    public $management;
    public $modelName       = 'User';
    public $breadcrumb;
    public $routePrefix     = 'admin';
    public $pageRoute       = 'seller';
    public $listUrl         = 'seller.list';
    public $listRequestUrl  = 'seller.ajax-list-request';
    public $addUrl          = 'seller.add';
    public $editUrl         = 'seller.edit';
    public $statusUrl       = 'seller.change-status';
    public $deleteUrl       = 'seller.delete';
    public $viewFolderPath  = 'admin.seller';
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

        $this->management  = trans('custom_admin.label_menu_seller');
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
            'pageTitle'     => trans('custom_admin.label_seller_list'),
            'panelTitle'    => trans('custom_admin.label_seller_list'),
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
        $data['pageTitle'] = trans('custom_admin.label_seller_list');
        $data['panelTitle']= trans('custom_admin.label_seller_list');

        try {
            if ($request->ajax()) {
                $data = $this->model->where(['type' => 'S'])->whereNull('deleted_at');

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
                        ->addColumn('full_name', function ($row) {
                            return '<a href="javascript: void(0);" data-microtip-position="right" role="tooltip" aria-label="'.trans('custom_admin.label_double_click_to_open_in_new_window').'" class="doubleClick">'.$row->full_name.'</a>';
                        })
                        ->addColumn('image', function ($row) use ($isAllow, $allowedRoutes) {
                            $image = asset('images/'.config('global.NO_IMAGE'));
                            if ($row->profile_pic != null && file_exists(public_path('images/uploads/distributor/'.$row->profile_pic))) {
                                $image = asset('images/uploads/distributor/'.$row->profile_pic);
                                if (file_exists(public_path('images/uploads/distributor/thumbs/'.$row->profile_pic))) {
                                    $image = asset('images/uploads/distributor/thumbs/'.$row->profile_pic);
                                }
                            }
                            return $image;
                        })
                        ->addColumn('phone_no', function ($row) {
                            if ($row->phone_no !== NULL) {
                                return $row->phone_no;
                            } else {
                                return 'N/A';
                            }
                        })
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
                        ->addColumn('edit_link', function ($row) use ($isAllow, $allowedRoutes) {
                            $editLink = '';
                            if ($isAllow || in_array($this->editUrl, $allowedRoutes)) {
                                $editLink = route($this->routePrefix.'.'.$this->editUrl, customEncryptionDecryption($row->id));
                            }
                            return $editLink;
                        })
                        ->rawColumns(['full_name','edit_link','whatsapp_no','status','action'])
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
            'pageTitle'     => trans('custom_admin.label_add_seller'),
            'panelTitle'    => trans('custom_admin.label_add_seller'),
            'pageType'      => 'CREATEPAGE'
        ];

        try {
            $data['distributionAreas'] = DistributionArea::where(['status' => '1'])->whereNull('deleted_at')->orderBy('title', 'ASC')->get();

            if ($request->isMethod('POST')) {
                $validationCondition = array(
                    'full_name'             => 'required',
                    'username'              => 'required|unique:'.($this->model)->getTable().',username,NULL,id,deleted_at,NULL|regex:'.config('global.VALID_ALPHANUMERIC_WITHOUT_SPACE_SPECIAL_CHARACTERS'),
                    'email'                 => 'required|regex:'.config('global.EMAIL_REGEX').'|unique:'.($this->model)->getTable().',email,NULL,id,deleted_at,NULL',
                    'password'              => 'required|regex:'.config('global.PASSWORD_REGEX'),
                    'confirm_password'      => 'required|regex:'.config('global.PASSWORD_REGEX').'|same:password',
                    'profile_pic'           => 'mimes:'.config('global.IMAGE_FILE_TYPES').'|max:'.config('global.IMAGE_MAX_UPLOAD_SIZE'),
                );
                $validationMessages = array(
                    'full_name.required'            => trans('custom_admin.error_name'),
                    'username.required'             => trans('custom_admin.error_username'),
                    'username.unique'               => trans('custom_admin.error_username_unique'),
                    'username.regex'                => trans('custom_admin.error_valid_alphanumeric_without_space_special_characters'),
                    'email.required'                => trans('custom_admin.error_email'),
                    'email.regex'                   => trans('custom_admin.error_valid_email'),
                    'email.unique'                  => trans('custom_admin.error_email_unique'),
                    'password.required'             => trans('custom_admin.error_enter_password'),
                    'password.regex'                => trans('custom_admin.error_enter_password_regex'),
                    'confirm_password.required'     => trans('custom_admin.error_enter_confirm_password'),
                    'confirm_password.regex'        => trans('custom_admin.error_enter_password_regex'),
                    'confirm_password.same'         => trans('custom_admin.error_same_password'),
                    'profile_pic.mimes'             => trans('custom_admin.error_image_mimes'),
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $details            = $this->model;
                    $randomString       = $request->password;
                    $password           = $randomString;

                    $profilePic         = $request->file('profile_pic');
                    $uploadedImage      = '';
                    if ($profilePic != '') {
                        $uploadedImage  = singleImageUpload($this->modelName, $profilePic, 'seller', $this->pageRoute, true); // If thumb true, mention size in global.php
                    }

                    if ($request->full_name == trim($request->full_name) && strpos($request->full_name, ' ') !== false) {
                        $explodedFullName           = explode(' ', $request->full_name);

                        $details->first_name        = $explodedFullName[0];
                        $details->last_name         = $explodedFullName[1];
                    } else {
                        $details->first_name        = $request->full_name ?? null;
                    }
                    
                    $details->full_name             = $request->full_name ?? null;
                    $details->email                 = $request->email ?? null;
                    $details->phone_no              = $request->phone_no ?? null;
                    $details->username              = $request->username ?? null;
                    $details->profile_pic           = $uploadedImage;
                    $details->password              = $password;
                    $details->type                  = 'S';

                    if ($details->save()) {
                        // Start :: Inserting data to user_details table
                        $userDetailData                    = new UserDetail;
                        $userDetailData->user_id           = $details->id;
                        $userDetailData->whatsapp_no       = $request->whatsapp_no ?? null;
                        $userDetailData->street            = $request->street ?? null;
                        $userDetailData->city              = $request->city ?? null;
                        $userDetailData->district_region   = $request->district_region ?? null;
                        $userDetailData->state_province    = $request->state_province ?? null;
                        $userDetailData->zip               = $request->zip ?? null;
                        $userDetailData->save();
                        // End :: Inserting data to user_details table

                        // Start :: Inserting data to user_roles table
                        $userRoleData           = new UserRole;
                        $userRoleData->user_id  = $details->id;
                        $userRoleData->role_id  = 3;    // Role id (3 => Seller Role) from roles table
                        $userRoleData->save();
                        // End :: Inserting data to user_roles table

                        // Start :: Inserting user_distribution_areas table
                        if (isset($request->distribution_area_ids) && count($request->distribution_area_ids)) {
                            $assignmentIds = [];
                            foreach ($request->distribution_area_ids as $key => $item) {                    
                                $assignmentIds[$key]['user_id']             = $details->id;
                                $assignmentIds[$key]['distribution_area_id']= $item;
                            }
                            if (count($assignmentIds)) {
                                UserDistributionArea::insert($assignmentIds);
                            }
                        }
                        // End :: Inserting user_distribution_areas table

                        $this->generateToastMessage('success', trans('custom_admin.success_data_updated_successfully'), false);
                        return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                    } else {
                        // If files uploaded then delete those files
                        unlinkFiles($uploadedImage, $this->pageRoute, true);

                        $this->generateToastMessage('error', trans('custom_admin.error_took_place_while_adding'), false);
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
            'pageTitle'     => trans('custom_admin.label_edit_seller'),
            'panelTitle'    => trans('custom_admin.label_edit_seller'),
            'pageType'      => 'EDITPAGE'
        ];

        try {
            $data['id']                 = $id;
            $data['sellerId']           = $id = customEncryptionDecryption($id, 'decrypt');
            $data['details']            = $details = $this->model->where(['id' => $id])->first();
            $data['distributionAreas']  = DistributionArea::where(['status' => '1'])->whereNull('deleted_at')->orderBy('title', 'ASC')->get();
            
            if ($request->isMethod('POST')) {
                if ($id == null) {
                    $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
                    return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                }
                $validationCondition = array(
                    'full_name'             => 'required',
                    'username'              => 'required|unique:'.($this->model)->getTable().',username,'.$id.',id,deleted_at,NULL|regex:'.config('global.VALID_ALPHANUMERIC_WITHOUT_SPACE_SPECIAL_CHARACTERS'),
                    'email'                 => 'required|regex:'.config('global.EMAIL_REGEX'),
                    'profile_pic'           => 'mimes:'.config('global.IMAGE_FILE_TYPES').'|max:'.config('global.IMAGE_MAX_UPLOAD_SIZE'),
                );
                $validationMessages = array(
                    'full_name.required'    => trans('custom_admin.error_name'),
                    'username.required'     => trans('custom_admin.error_username'),
                    'username.unique'       => trans('custom_admin.error_username_unique'),
                    'username.regex'        => trans('custom_admin.error_valid_alphanumeric_without_space_special_characters'),
                    'email.required'        => trans('custom_admin.error_email'),
                    'email.regex'           => trans('custom_admin.error_valid_email'),
                    'email.unique'          => trans('custom_admin.error_email_unique'),
                    'profile_pic.mimes'     => trans('custom_admin.error_image_mimes'),
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $updateData     = [];
                    $validationFlag = false;
                    // Unique Email validation for User type "Seller"
                    $userEmailExistCheck = $this->model->where('id', '<>', $id)
                                                ->where(['email' => $request->email])
                                                ->count();
                    if ($userEmailExistCheck > 0) {
                        $validationFlag = true;
                    }
                    
                    if (!$validationFlag) {
                        $profilePic         = $request->file('profile_pic');
                        $uploadedImage      = '';
                        $previousFileName   = null;
                        $unlinkStatus       = false;
                        
                        if ($profilePic != '') {
                            if ($details['profile_pic'] != null) {
                                $previousFileName           = $details['profile_pic'];
                                $unlinkStatus               = true;
                            }
                            $uploadedImage                  = singleImageUpload($this->modelName, $profilePic, 'distributor', $this->pageRoute, true, $previousFileName, $unlinkStatus);
                            $updateData['profile_pic']      = $uploadedImage;
                        }

                        if ($request->full_name == trim($request->full_name) && strpos($request->full_name, ' ') !== false) {
                            $explodedFullName               = explode(' ', $request->full_name);
    
                            $updateData['first_name']       = $explodedFullName[0];
                            $updateData['last_name']        = $explodedFullName[1];
                        } else {
                            $updateData['first_name']       = $request->full_name ?? null;
                        }
                        
                        $updateData['full_name']            = $request->full_name ?? null;
                        $updateData['email']                = $request->email ?? null;
                        $updateData['username']             = $request->username ?? null;
                        $updateData['phone_no']             = $request->phone_no ?? null;
                        $update = $this->model->where(['id' => $id])->update($updateData);
                        
                        if ($update) {
                            // Start :: update data to user_details table
                            UserDetail::where(['user_id' => $id])->update([
                                'whatsapp_no'   => $request->whatsapp_no ?? null,
                                'street'        => $request->street ?? null,
                                'city'          => $request->city ?? null,
                                'district_region'=> $request->district_region ?? null,
                                'state_province'=> $request->state_province ?? null,
                                'zip'           => $request->zip ?? null
                            ]);
                            // End :: update data to user_details table

                            // Start :: Inserting user_distribution_areas table
                            UserDistributionArea::where('user_id', $id)->delete();
                            if (isset($request->distribution_area_ids) && count($request->distribution_area_ids)) {
                                $assignmentIds = [];
                                foreach ($request->distribution_area_ids as $key => $item) {                    
                                    $assignmentIds[$key]['user_id']             = $details->id;
                                    $assignmentIds[$key]['distribution_area_id']= $item;
                                }
                                if (count($assignmentIds)) {
                                    UserDistributionArea::insert($assignmentIds);
                                }
                            }
                            // End :: Inserting user_distribution_areas table

                            $this->generateToastMessage('success', trans('custom_admin.success_data_updated_successfully'), false);
                            $this->windowCloseOnSuccess();
                            // return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                        } else {
                            // If files uploaded then delete those files
                            unlinkFiles($uploadedImage, $this->pageRoute, false);
                            
                            $this->generateToastMessage('error', trans('custom_admin.error_took_place_while_updating'), false);
                            return redirect()->back()->withInput();
                        }
                    } else {
                        $this->generateToastMessage('error', trans('custom_admin.error_email_unique'), false);
                        return redirect()->back()->withInput();
                    }
                }
            }

            $selectedDistributionAreaIds = [];
            if ($details->userDistributionAreaDetails) {
                foreach ($details->userDistributionAreaDetails as $item) {
                    $selectedDistributionAreaIds[] = $item->distribution_area_id;
                }
            }
            $data['selectedDistributionAreaIds'] = $selectedDistributionAreaIds;

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
}
