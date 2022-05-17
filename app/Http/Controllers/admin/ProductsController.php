<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : ProductsController
# Purpose           : Product Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Traits\GeneralMethods;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\DistributionArea;
use DataTables;

class ProductsController extends Controller
{
    use GeneralMethods;
    public $controllerName  = 'Products';
    public $management;
    public $modelName       = 'Product';
    public $breadcrumb;
    public $routePrefix     = 'admin';
    public $pageRoute       = 'product';
    public $listUrl         = 'product.list';
    public $listRequestUrl  = 'product.ajax-list-request';
    public $addUrl          = 'product.add';
    public $editUrl         = 'product.edit';
    public $statusUrl       = 'product.change-status';
    public $deleteUrl       = 'product.delete';
    public $viewFolderPath  = 'admin.product';
    public $model           = 'Product';

    /*
        * Function Name : __construct
        * Purpose       : It sets some public variables for being accessed throughout this
        *                   controller and its related view pages
        * Input Params  : Void
        * Return Value  : Mixed
    */
    public function __construct() {
        parent::__construct();

        $this->management  = trans('custom_admin.label_menu_product');
        $this->model       = new Product();

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
            'pageTitle'     => trans('custom_admin.label_product_list'),
            'panelTitle'    => trans('custom_admin.label_product_list'),
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
        $data['pageTitle'] = trans('custom_admin.label_product_list');
        $data['panelTitle']= trans('custom_admin.label_product_list');

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

                                $btn .= '<a href="'.$editLink.'" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_edit').'"><i class="fa fa-edit"></i></a>';
                            }
                            if ($isAllow || in_array($this->deleteUrl, $allowedRoutes)) {
                                $btn .= ' <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-danger btn-circle btn-circle-sm delete" aria-label="'.trans('custom_admin.label_delete').'" data-action-type="delete" data-id="'.customEncryptionDecryption($row->id).'"><i class="fa fa-trash"></i></a>';
                            }                            
                            return $btn;
                        })
                        ->rawColumns(['whatsapp_no','status','action'])
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
            'pageTitle'     => trans('custom_admin.label_add_product'),
            'panelTitle'    => trans('custom_admin.label_add_product'),
            'pageType'      => 'CREATEPAGE'
        ];

        try {
            if ($request->isMethod('POST')) {
                $validationCondition = array(
                    'category_id'   => 'required',
                    'title'         => 'required',
                );
                $validationMessages = array(
                    'category_id.required'  => 'Please select distribution area',
                    'title.required'        => 'Please enter title',
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $saveData                   = [];
                    $saveData['category_id']    = $request->category_id ?? null;
                    $saveData['title']          = $request->title ?? null;
                    $saveData['slug']           = generateUniqueSlug($this->model, trim($request->store_name,' '));
                    $saveData['rate_per_pc']    = $request->rate_per_pc ?? null;
                    $saveData['mrp']            = $request->mrp ?? null;
                    $saveData['sort']           = generateSortNumber($this->model);
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

            $data['distributionAreas'] = DistributionArea::where(['status' => '1'])
                                                        ->select('id','title')
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
            'pageTitle'     => trans('custom_admin.label_edit_product'),
            'panelTitle'    => trans('custom_admin.label_edit_product'),
            'pageType'      => 'EDITPAGE'
        ];

        try {
            $data['id']                 = $id;
            $data['distributorId']      = $id = customEncryptionDecryption($id, 'decrypt');
            $data['distributionAreas']  = DistributionArea::where(['status' => '1'])
                                                            ->select('id','title')
                                                            ->get();



                                                            
            $data['details']            = $details = $this->model->where(['id' => $id])->first();
            
            if ($request->isMethod('POST')) {
                if ($id == null) {
                    $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
                    return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                }
                $validationCondition = array(
                    'distribution_area_id'  => 'required',
                    'job_title_1'           => 'required',
                    'full_name'             => 'required',
                    'company'               => 'required',
                    'email'                 => 'required|regex:'.config('global.EMAIL_REGEX'),
                    // 'phone_no'              => 'required',
                    'profile_pic'           => 'mimes:'.config('global.IMAGE_FILE_TYPES').'|max:'.config('global.IMAGE_MAX_UPLOAD_SIZE'),
                );
                $validationMessages = array(
                    'distribution_area_id.required' => 'Please select distribution area',
                    'job_title_1.required'          => 'Please enter job title 1',
                    'full_name.required'            => 'Please enter name 1',
                    'company.required'              => 'Please enter company',
                    'email.required'                => trans('custom_admin.error_email'),
                    'email.regex'                   => trans('custom_admin.error_valid_email'),
                    'email.unique'                  => trans('custom_admin.error_email_unique'),
                    // 'phone_no.required'             => trans('custom_admin.error_enter_phone_no'),
                    'profile_pic.mimes'             => trans('custom_admin.error_image_mimes'),
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $updateData     = [];
                    $validationFlag = false;
                    // Unique Email validation for User type "Distributor"
                    $userEmailExistCheck = $this->model->where('id', '<>', $id)
                                                ->where(['email' => $request->email, 'type' => 'D'])
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
                        
                        $updateData['job_title_1']          = $request->job_title_1 ?? null;
                        $updateData['full_name']            = $request->full_name ?? null;
                        $updateData['email']                = $request->email ?? null;
                        $updateData['company']              = $request->company ?? null;
                        $updateData['phone_no']             = $request->phone_no ?? null;
                        $updateData['distribution_area_id'] = $request->distribution_area_id ?? null;
                        $update = $this->model->where(['id' => $id])->update($updateData);
                        
                        if ($update) {
                            // Start :: update data to user_details table
                            UserDetail::where(['user_id' => $id])->update([
                                'job_title_2'   => $request->job_title_2 ?? null,
                                'full_name_2'   => $request->full_name_2 ?? null,
                                'phone_no_2'    => $request->phone_no_2 ?? null,
                                'whatsapp_no'   => $request->whatsapp_no ?? null,
                                'street'        => $request->street ?? null,
                                'city'          => $request->city ?? null,
                                'district_region'=> $request->district_region ?? null,
                                'state_province'=> $request->state_province ?? null,
                                'zip'           => $request->zip ?? null,
                                'notes'         => $request->notes ?? null
                            ]);
                            // End :: update data to user_details table                        

                            $this->generateToastMessage('success', trans('custom_admin.success_data_updated_successfully'), false);
                            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
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
