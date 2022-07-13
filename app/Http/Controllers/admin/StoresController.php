<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : StoresController
# Purpose           : Store Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Traits\GeneralMethods;
use App\Models\Store;
use App\Models\DistributionArea;
use App\Models\User;
use App\Models\Beat;
use App\Models\Grade;
use DataTables;

class StoresController extends Controller
{
    use GeneralMethods;
    public $controllerName  = 'Stores';
    public $management;
    public $modelName       = 'Store';
    public $breadcrumb;
    public $routePrefix     = 'admin';
    public $pageRoute       = 'store';
    public $listUrl         = 'store.list';
    public $listRequestUrl  = 'store.ajax-list-request';
    public $addUrl          = 'store.add';
    public $editUrl         = 'store.edit';
    public $statusUrl       = 'store.change-status';
    public $deleteUrl       = 'store.delete';
    public $viewFolderPath  = 'admin.store';
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

        $this->management  = trans('custom_admin.label_menu_store');
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
            'pageTitle'     => trans('custom_admin.label_store_list'),
            'panelTitle'    => trans('custom_admin.label_store_list'),
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

            $data['distributionAreas']  = DistributionArea::where(['status' => '1'])->whereNull('deleted_at')->select('id','title')->orderBy('title', 'ASC')->get();
            $data['distributors']       = User::where(['type' => 'D', 'status' => '1'])->whereNull('deleted_at')->select('id','full_name','email')->orderBy('full_name', 'ASC')->get();
            $data['stores']             = $this->model->where(['status' => '1'])->whereNull('deleted_at')->select('id','store_name','email','beat_name','name_1')->orderBy('store_name', 'ASC')->get();
            $data['beats']              = Beat::where(['status' => '1'])->whereNull('deleted_at')->select('id','title')->orderBy('title', 'ASC')->get();
            $data['grades']             = Grade::where(['status' => '1'])->whereNull('deleted_at')->select('id','title')->orderBy('title', 'ASC')->get();

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
                $filterBydistributionArea   = false;
                if ($distributionAreaId != '') {
                    $filterBydistributionArea = true;
                    $filter['distribution_area_id'] = $distributionAreaId;
                }
                // Distributor
                $distributorId         = $request->distributor_id;
                $filterByDistributor   = false;
                if ($distributorId != '') {
                    $filterByDistributor = true;
                    $filter['distributor_id'] = $distributorId;
                }
                // Beat
                $beatId       = $request->beat_id;
                $filterByBeat = false;
                if ($beatId != '') {
                    $filterByBeat = true;
                    $filter['beat_id'] = $beatId;
                }
                // Store
                $storeId       = $request->store_id;
                $filterByStore = false;
                if ($storeId != '') {
                    $filterByStore = true;
                    $filter['store_id'] = $storeId;
                }
                // Name 1
                $name1Id         = $request->name_1_id;
                $filterByName1   = false;
                if ($name1Id != '') {
                    $filterByName1 = true;
                    $filter['name_1_id'] = $name1Id;
                }
                // Grade
                $gradeId       = $request->grade_id;
                $filterByGrade = false;
                if ($gradeId != '') {
                    $filterByGrade = true;
                    $filter['grade_id'] = $gradeId;
                }

                // Main query
                $data = $this->model->whereNull(['deleted_at']);

                // Based on disribution area filter
                if ($filterBydistributionArea) {
                    $data = $data->where('distribution_area_id', $distributionAreaId);
                }
                // Based on distributor filter
                if ($filterByDistributor) {
                    $distributorDetails = User::where(['id' => $distributorId])->select('id','distribution_area_id')->first();
                    if ($distributorDetails != null) {
                        $data = $data->where('distribution_area_id', $distributorDetails->distribution_area_id);
                    }
                }
                // Based on beat filter
                if ($filterByBeat) {
                    $data = $data->where('beat_id', $beatId);
                }
                // Based on store filter
                if ($filterByStore) {
                    $data = $data->where('id', $storeId);
                }
                // Based on name filter
                if ($filterByName1) {
                    $data = $data->where('id', $name1Id);
                }
                // Based on grade filter
                if ($filterByGrade) {
                    $data = $data->where('grade_id', $gradeId);
                }

                return Datatables::of($data, $isAllow, $allowedRoutes)
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
                        ->addColumn('grade_id', function ($row) {
                            if ($row->gradeDetails !== NULL) {
                                return $row->gradeDetails->title;
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
                        ->rawColumns(['distribution_area_id','sale_size_category','status','action'])
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
            'pageTitle'     => trans('custom_admin.label_add_store'),
            'panelTitle'    => trans('custom_admin.label_add_store'),
            'pageType'      => 'CREATEPAGE'
        ];

        try {
            if ($request->isMethod('POST')) {
                $validationCondition = array(
                    'distribution_area_id'  => 'required',
                    'name_1'                => 'required|unique:'.($this->model)->getTable().',name_1,NULL,id,deleted_at,NULL',
                    'store_name'            => 'required|unique:'.($this->model)->getTable().',store_name,NULL,id,deleted_at,NULL',
                    // 'email'                 => 'required|regex:'.config('global.EMAIL_REGEX').'|unique:'.($this->model)->getTable().',email,NULL,id,deleted_at,NULL',
                    'beat_id'               => 'required',
                );
                $validationMessages = array(
                    'distribution_area_id.required' => 'Please select distribution area.',
                    'name_1.required'               => 'Please enter name 1.',
                    'name_1.unique'                 => 'Please enter unique name 1.',
                    'store_name.required'           => 'Please enter store name.',
                    'store_name.unique'             => 'Please enter unique store name.',
                    // 'email.required'            => trans('custom_admin.error_email'),
                    // 'email.regex'               => trans('custom_admin.error_valid_email'),
                    // 'email.unique'              => trans('custom_admin.error_email_unique'),
                    'beat_id.required'             => 'Please select beat.',
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $saveData                           = [];
                    $saveData['distribution_area_id']   = $request->distribution_area_id ?? null;
                    $saveData['name_1']                 = $request->name_1 ?? null;
                    $saveData['name_2']                 = $request->name_2 ?? null;
                    $saveData['store_name']             = $request->store_name ?? null;
                    $saveData['slug']                   = generateUniqueSlug($this->model, trim($request->store_name,' '));
                    $saveData['phone_no_1']             = $request->phone_no_1 ?? null;
                    $saveData['whatsapp_no_1']          = $request->whatsapp_no_1 ?? null;
                    $saveData['phone_no_2']             = $request->phone_no_2 ?? null;
                    $saveData['whatsapp_no_2']          = $request->whatsapp_no_2 ?? null;
                    $saveData['street']                 = $request->street ?? null;
                    $saveData['district_region']        = $request->district_region ?? null;
                    $saveData['zip']                    = $request->zip ?? null;
                    $saveData['beat_id']                = $request->beat_id ?? null;
                    $saveData['grade_id']               = $request->grade_id ?? null;
                    $saveData['beat_name']              = $request->beat_name ?? null;
                    $saveData['email']                  = $request->email ?? null;
                    $saveData['sale_size_category']     = $request->sale_size_category ?? 'S';
                    $saveData['integrity']              = $request->integrity ?? 'A+';
                    $saveData['notes']                  = $request->notes ?? null;
                    $saveData['sort']                   = generateSortNumber($this->model);
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
            $data['beats'] = Beat::where(['status' => '1'])->select('id','title')->get();
            $data['grades']= Grade::where(['status' => '1'])->whereNull('deleted_at')->select('id','title')->orderBy('title', 'ASC')->get();
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
            'pageTitle'     => trans('custom_admin.label_edit_store'),
            'panelTitle'    => trans('custom_admin.label_edit_store'),
            'pageType'      => 'EDITPAGE'
        ];

        try {
            $data['id']                 = $id;
            $data['storeId']            = $id = customEncryptionDecryption($id, 'decrypt');
            $data['distributionAreas']  = DistributionArea::where(['status' => '1'])->select('id','title')->get();
            $data['beats']              = Beat::where(['status' => '1'])->select('id','title')->get();
            $data['grades']             = Grade::where(['status' => '1'])->whereNull('deleted_at')->select('id','title')->orderBy('title', 'ASC')->get();
            $data['details']            = $details = $this->model->where(['id' => $id])->first();
            
            if ($request->isMethod('POST')) {
                if ($id == null) {
                    $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
                    return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                }
                $validationCondition = array(
                    'distribution_area_id'  => 'required',
                    'name_1'                => 'required|unique:'.($this->model)->getTable().',name_1,'.$id.',id,deleted_at,NULL',
                    'store_name'            => 'required|unique:'.($this->model)->getTable().',store_name,'.$id.',id,deleted_at,NULL',
                    // 'email'                 => 'required|regex:'.config('global.EMAIL_REGEX').'|unique:'.($this->model)->getTable().',email,NULL,id,deleted_at,NULL',
                    'beat_id'               => 'required',
                );
                $validationMessages = array(
                    'distribution_area_id.required' => 'Please select distributor.',
                    'name_1.required'               => 'Please enter name 1.',
                    'name_1.unique'                 => 'Please enter unique name 1.',
                    'store_name.required'           => 'Please enter store name.',
                    'store_name.unique'             => 'Please enter unique store name.',
                    // 'email.required'                => trans('custom_admin.error_email'),
                    // 'email.regex'                   => trans('custom_admin.error_valid_email'),
                    // 'email.unique'                  => trans('custom_admin.error_email_unique'),
                    'beat_id.required'             => 'Please select beat.',
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $updateData                         = [];
                    $updateData['distribution_area_id'] = $request->distribution_area_id ?? null;
                    $updateData['name_1']               = $request->name_1 ?? null;
                    $updateData['name_2']               = $request->name_2 ?? null;
                    $updateData['store_name']           = $request->store_name ?? null;
                    $updateData['slug']                 = generateUniqueSlug($this->model, trim($request->store_name,' '), $data['id']);
                    $updateData['phone_no_1']           = $request->phone_no_1 ?? null;
                    $updateData['whatsapp_no_1']        = $request->whatsapp_no_1 ?? null;
                    $updateData['phone_no_2']           = $request->phone_no_2 ?? null;
                    $updateData['whatsapp_no_2']        = $request->whatsapp_no_2 ?? null;
                    $updateData['street']               = $request->street ?? null;
                    $updateData['district_region']      = $request->district_region ?? null;
                    $updateData['zip']                  = $request->zip ?? null;
                    $updateData['beat_id']              = $request->beat_id ?? null;
                    $updateData['grade_id']             = $request->grade_id ?? null;
                    $updateData['beat_name']            = $request->beat_name ?? null;
                    $updateData['email']                = $request->email ?? null;
                    $updateData['sale_size_category']   = $request->sale_size_category ?? 'S';
                    $updateData['integrity']            = $request->integrity ?? 'A+';
                    $updateData['notes']                = $request->notes ?? null;
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
