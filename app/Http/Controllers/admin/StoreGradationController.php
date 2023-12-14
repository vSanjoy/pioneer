<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : StoreGradationController
# Purpose           : Payments Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Auth;
use App\Traits\GeneralMethods;
use App\Models\Beat;
use App\Models\DistributionArea;
use App\Models\User;
use App\Models\Store;
use DataTables;

class StoreGradationController extends Controller
{
    use GeneralMethods;
    public $controllerName          = 'StoreGradationController';
    public $management;
    public $modelName               = 'User';
    public $breadcrumb;
    public $routePrefix             = 'admin';
    public $pageRoute               = 'storeGradation';
    public $listUrl                 = 'storeGradation.list';
    public $listRequestUrl          = 'storeGradation.ajax-list-request';
    public $addUrl                  = 'storeGradation.add';
    public $viewFolderPath          = 'admin.storeGradation';
    public $model                   = 'User';

    /*
        * Function Name : __construct
        * Purpose       : It sets some public variables for being accessed throughout this
        *                   controller and its related view pages
        * Input Params  : Void
        * Return Value  : Mixed
    */
    public function __construct() {
        parent::__construct();

        $this->management  = trans('custom_admin.label_menu_store_gradation');
        $this->model       = new Store();

        // Assign breadcrumb
        $this->assignBreadcrumb();
        
        // Variables assign for view page
        $this->assignShareVariables();
    }

    /*
        * Function name : list
        * Purpose       : This function is to list
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function list(Request $request) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_list_store_grade'),
            'panelTitle'    => trans('custom_admin.label_list_store_grade'),
            'pageType'      => 'LISTPAGE'
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
            $data['stores'] = $this->model->where(['status' => '1'])->whereNull('deleted_at')->select('id','store_name','email','beat_name','name_1','distribution_area_id','beat_id')->orderBy('store_name', 'ASC')->get();

            return view($this->viewFolderPath.'.list', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        } catch (\Throwable $e) {
            dd($e);
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        }
    }

    /*
        * Function name : report
        * Purpose       : This function is to report
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function report(Request $request) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_report_store_grade'),
            'panelTitle'    => trans('custom_admin.label_report_store_grade'),
            'pageType'      => 'LISTPAGE'
        ];

        try {
            $data['distributionAreas'] = DistributionArea::where(['status' => '1'])
                                                            ->select('id','title')
                                                            ->get();
            $data['beats'] = Beat::where(['status' => '1'])->select('id','title')->get();
            $data['stores'] = $this->model->where(['status' => '1'])->whereNull('deleted_at')->select('id','store_name','email','beat_name','name_1','distribution_area_id','beat_id')->orderBy('store_name', 'ASC')->get();
            
            return view($this->viewFolderPath.'.report', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        } catch (\Throwable $e) {
            dd($e);
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        }
    }

}
