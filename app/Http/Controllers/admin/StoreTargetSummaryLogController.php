<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : StoreTargetSummaryLog
# Purpose           : Store Target Summary Log Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Traits\GeneralMethods;
use App\Models\Store;
use App\Models\StoreTargetSummaryLog;
use DataTables;

class StoreTargetSummaryLogController extends Controller
{
    use GeneralMethods;
    public $controllerName  = 'StoreTargetSummaryLog';
    public $management;
    public $modelName       = 'StoreTargetSummaryLog';
    public $breadcrumb;
    public $routePrefix     = 'admin';
    public $pageRoute       = 'storeTargetSummaryLog';
    public $listUrl         = '';
    public $listRequestUrl  = 'storeTargetSummaryLog.ajax-list-request';
    public $addUrl          = '';
    public $editUrl         = '';
    public $statusUrl       = '';
    public $deleteUrl       = '';
    public $viewFolderPath  = 'admin.storeTargetSummaryLog';
    public $model           = 'StoreTargetSummaryLog';

    /*
        * Function Name : __construct
        * Purpose       : It sets some public variables for being accessed throughout this
        *                   controller and its related view pages
        * Input Params  : Void
        * Return Value  : Mixed
    */
    public function __construct() {
        parent::__construct();

        $this->management  = __('custom_admin.label_menu_store_target_summary_log');
        $this->model       = new StoreTargetSummaryLog();

        // Assign breadcrumb
        $this->assignBreadcrumb();
        
        // Variables assign for view page
        $this->assignShareVariables();
    }

    /*
        * Function name : ajaxListRequest
        * Purpose       : This function is for the reutrn ajax data
        * Input Params  : Request $request
        * Return Value  : Returns sub admin data
    */
    public function ajaxListRequest(Request $request) {
        $data['pageTitle'] = __('custom_admin.label_store_target_summary_log_list');
        $data['panelTitle']= __('custom_admin.label_store_target_summary_log_list');

        try {
            if ($request->ajax()) {
                // Start :: Manage restriction
                $isAllow = true;

                $storeId = $request->store_id ? customEncryptionDecryption($request->store_id, 'decrypt') : '';
                
                // Main query
                $data = $this->model->where(['store_id' => $storeId]);

                return Datatables::of($data, $isAllow)
                        ->addIndexColumn()
                        ->addColumn('date', function ($row) {
                            return date('d-m-Y', strtotime($row->date));
                        })
                        ->addColumn('current_target', function ($row) {
                            return formatToTwoDecimalPlaces($row->current_target);
                        })
                        ->addColumn('weekly_payment', function ($row) {
                            return formatToTwoDecimalPlaces($row->current_target);
                        })
                        ->addColumn('weekly_payment', function ($row) {
                            if ($row->weekly_payment !== NULL) {
                                return $row->weekly_payment;
                            } else {
                                return 'N/A';
                            }
                        })
                        ->rawColumns(['date','current_target','weekly_payment','weekly_payment'])
                        ->make(true);
            }
            
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
            'pageTitle'     => __('custom_admin.label_add_store'),
            'panelTitle'    => __('custom_admin.label_add_store'),
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
                    // 'email.required'            => __('custom_admin.error_email'),
                    // 'email.regex'               => __('custom_admin.error_valid_email'),
                    // 'email.unique'              => __('custom_admin.error_email_unique'),
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
                        $this->generateToastMessage('success', __('custom_admin.success_data_updated_successfully'), false);
                        return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                    } else {
                        $this->generateToastMessage('error', __('custom_admin.error_took_place_while_updating'), false);
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
            $this->generateToastMessage('error', __('custom_admin.error_something_went_wrong'), false);
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
            'pageTitle'     => __('custom_admin.label_edit_store'),
            'panelTitle'    => __('custom_admin.label_edit_store'),
            'pageType'      => 'EDITPAGE'
        ];

        try {
            $data['id']                 = $id;
            $data['storeId']            = $id = customEncryptionDecryption($id, 'decrypt');
            $data['details']            = $details = $this->model->where(['id' => $id])->first();
            $data['distributionAreas']  = DistributionArea::where(['status' => '1'])->select('id','title')->get();
            $data['beats']              = Beat::where(['distribution_area_id' => $details->distribution_area_id,  'status' => '1'])->select('id','title')->get();
            $data['grades']             = Grade::where(['status' => '1'])->whereNull('deleted_at')->select('id','title')->orderBy('title', 'ASC')->get();
            
            if ($request->isMethod('POST')) {
                if ($id == null) {
                    $this->generateToastMessage('error', __('custom_admin.error_something_went_wrong'), false);
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
                    // 'email.required'                => __('custom_admin.error_email'),
                    // 'email.regex'                   => __('custom_admin.error_valid_email'),
                    // 'email.unique'                  => __('custom_admin.error_email_unique'),
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
                    // $updateData['beat_name']            = $request->beat_name ?? null;
                    $updateData['email']                = $request->email ?? null;
                    $updateData['sale_size_category']   = $request->sale_size_category ?? 'S';
                    $updateData['integrity']            = $request->integrity ?? 'A+';
                    $updateData['notes']                = $request->notes ?? null;
                    $update = $details->update($updateData);

                    if ($update) {
                        $this->generateToastMessage('success', __('custom_admin.success_data_updated_successfully'), false);
                        $this->windowCloseOnSuccess();
                        // return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                    } else {
                        $this->generateToastMessage('error', __('custom_admin.error_took_place_while_updating'), false);
                        return redirect()->back()->withInput();
                    }
                }
            }

            return view($this->viewFolderPath.'.edit', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', __('custom_admin.error_something_went_wrong'), false);
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
        $title      = __('custom_admin.message_error');
        $message    = __('custom_admin.error_something_went_wrong');
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
                            
                            $title      = __('custom_admin.message_success');
                            $message    = __('custom_admin.success_status_updated_successfully');
                            $type       = 'success';        
                        } else if ($details->status == 0) {
                            $details->status = '1';
                            $details->save();
        
                            $title      = __('custom_admin.message_success');
                            $message    = __('custom_admin.success_status_updated_successfully');
                            $type       = 'success';
                        }
                    } else {
                        $message = __('custom_admin.error_invalid');
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
        $title      = __('custom_admin.message_error');
        $message    = __('custom_admin.error_something_went_wrong');
        $type       = 'error';

        try {
            if ($request->ajax()) {
                $id = customEncryptionDecryption($id, 'decrypt');
                if ($id != null) {
                    $details = $this->model->where('id', $id)->first();
                    if ($details != null) {
                        $delete = $details->delete();
                        if ($delete) {
                            $title      = __('custom_admin.message_success');
                            $message    = __('custom_admin.success_data_deleted_successfully');
                            $type       = 'success';
                        } else {
                            $message    = __('custom_admin.error_took_place_while_deleting');
                        }
                    } else {
                        $message = __('custom_admin.error_invalid');
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
        * Function Name : ajaxStoreTargetSummaryLogsDetails
        * Purpose       : This function is to get distribution area wise stores
        * Author        : 
        * Created Date  : 
        * Modified date : 
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function ajaxStoreTargetSummaryLogsDetails(Request $request) {
        $title          = __('custom_admin.message_error');
        $message        = __('custom_admin.error_something_went_wrong');
        $type           = 'error';
        $storeDetails   = $storeName = $encryptedStoreId = '';
        $storeTargetSummaryLog = [];

        try {
            if ($request->ajax()) {
                $storeId = $request->store_id ?? '';
                if ($storeId) {
                    $storeDetails = Store::where('id', $storeId)->first();
                    if ($storeDetails) {
                        $storeName = $storeDetails->store_name.' ('.$storeDetails->name_1;
                        if ($storeDetails->phone_no_1 != null) {
                            $storeName .= ' - '.$storeDetails->phone_no_1;
                        }
                        $storeName .= ')';

                        $title      = __('custom_admin.message_success');
                        $message    = __('custom_admin.success_data_fetched_successfully');
                        $type       = 'success';

                        $encryptedStoreId       = customEncryptionDecryption($storeDetails->id);
                        $storeTargetSummaryLog  = $storeDetails->storeTargetSummaryLogDetails;
                    } else {
                        $message    = __('custom_admin.message_store_not_found');
                    }
                } else {
                    $message    = __('custom_admin.message_store_not_found');
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }
        return response()->json(['title' => $title, 'message' => $message, 'type' => $type, 'storeDetails' => $storeDetails, 'storeName' => $storeName, 'storeTargetSummaryLog' => $storeTargetSummaryLog, 'encryptedStoreId' => $encryptedStoreId]);
    }

    /*
        * Function Name : ajaxStoreTargetSummaryLog
        * Purpose       : This function is to store target summary log
        * Author        : 
        * Created Date  : 
        * Modified date : 
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function ajaxStoreTargetSummaryLog(Request $request) {
        $title      = __('custom_admin.message_error');
        $message    = __('custom_admin.error_something_went_wrong');
        $type       = 'error';

        try {
            if ($request->ajax()) {
                $storeId = $request->store_id ? customEncryptionDecryption($request->store_id, 'decrypt') : '';
                if ($storeId) {
                    $storeDetails = Store::where('id', $storeId)->first();
                    if ($storeDetails) {
                        $saveData                   = [];
                        $saveData['store_id']       = $storeId;
                        $saveData['date']           = $request->date ?? null;
                        $saveData['credit_days']    = $request->credit_days ?? 0;
                        $saveData['current_target'] = $request->current_target ?? 0;
                        $saveData['weekly_payment'] = $request->weekly_payment ?? 0;
                        $saveData['visit_cycle']    = $request->visit_cycle ?? null;
                        $save = $this->model->create($saveData);
                        
                        if ($save) {
                            $title      = __('custom_admin.message_success');
                            $message    = __('custom_admin.success_data_added_successfully');
                            $type       = 'success';
                        }
                        
                    } else {
                        $message = __('custom_admin.message_store_not_found');
                    }
                } else {
                    $message = __('custom_admin.message_store_not_found');
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
            dd($message);
        } catch (\Throwable $e) {
            $message = $e->getMessage();
            dd($message);
        }
        return response()->json(['title' => $title, 'message' => $message, 'type' => $type]);
    }

}

