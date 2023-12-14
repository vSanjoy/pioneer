<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : InvoiceController
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

class InvoiceController extends Controller
{
    use GeneralMethods;
    public $controllerName          = 'InvoiceController';
    public $management;
    public $modelName               = 'User';
    public $breadcrumb;
    public $routePrefix             = 'admin';
    public $pageRoute               = 'invoice';
    public $listUrl                 = 'invoice.list';
    public $listRequestUrl          = 'invoice.ajax-list-request';
    public $viewFolderPath          = 'admin.invoice';
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

        $this->management  = trans('custom_admin.label_menu_invoice');
        $this->model       = new Store();

        // Assign breadcrumb
        $this->assignBreadcrumb();
        
        // Variables assign for view page
        $this->assignShareVariables();
    }

    /*
        * Function name : list
        * Purpose       : This function is to show list of invoice
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function list(Request $request) {
        $data = [
            'pageTitle'     => 'Invoice List',
            'panelTitle'    => 'Invoice List',
            'pageType'      => 'LISTPAGE'
        ];

        try {
            $data['stores'] = $this->model->where(['status' => '1'])->whereNull('deleted_at')->select('id','store_name','email','beat_name','name_1','distribution_area_id','beat_id')->orderBy('store_name', 'ASC')->get();

            return view($this->viewFolderPath.'.list', $data);
        } catch (Exception $e) {
            dd($e);
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        } catch (\Throwable $e) {
            dd($e);
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        }
    }

}
