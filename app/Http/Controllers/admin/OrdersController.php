<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : OrdersController
# Purpose           : Category Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Carbon\Carbon;
use App\Traits\GeneralMethods;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use DataTables;

class OrdersController extends Controller
{
    use GeneralMethods;
    public $controllerName  = 'Orders';
    public $management;
    public $modelName       = 'Order';
    public $breadcrumb;
    public $routePrefix     = 'admin';
    public $pageRoute       = 'order';
    public $listUrl         = 'order.list';
    public $listRequestUrl  = 'order.ajax-list-request';
    public $addUrl          = 'order.add';
    public $editUrl         = 'order.edit';
    public $viewUrl         = 'order.view';
    public $statusUrl       = 'order.change-status';
    public $deleteUrl       = 'order.delete';
    public $viewFolderPath  = 'admin.order';
    public $model           = 'Order';

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

        $this->management   = trans('custom_admin.label_menu_order');
        $this->model        = new Order();

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
        * Modified Date : 
        * Input Params  : Request $request
        * Return Value  : Returns to the list page
    */
    public function list(Request $request) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_order_list'),
            'panelTitle'    => trans('custom_admin.label_order_list'),
            'pageType'      => 'LISTPAGE'
        ];

        try {
            // Start :: Manage restriction
            $data['isAllow'] = false;
            $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
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
        * Purpose       : This function is for the reutrn ajax data
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : Request $request
        * Return Value  : Returns order data
    */
    public function ajaxListRequest(Request $request) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_order_list'),
            'panelTitle'    => trans('custom_admin.label_order_list')
        ];

        try {
            if ($request->ajax()) {
                if (Auth::guard('admin')->user()->type == 'D') {
                    $data = $this->model->where([
                                            'distributor_id' => Auth::guard('admin')->user()->id
                                        ])
                                        ->orderBy('id', 'desc')
                                        ->get();
                } else if (Auth::guard('admin')->user()->type == 'S') {
                    $data = $this->model->where([
                                            'seller_id' => Auth::guard('admin')->user()->id
                                        ])
                                        ->orderBy('id', 'desc')
                                        ->get();
                } else {
                    $data = $this->model->orderBy('id', 'desc')->get();
                }

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
                        ->addColumn('created_at', function ($row) {
                            return changeDateFormat($row->created_at, 'd-m-Y');
                        })
                        ->addColumn('seller_id', function ($row) {
                            if ($row->sellerDetails) {
                                return $row->sellerDetails->full_name;
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('store_id', function ($row) {
                            if ($row->storeDetails) {
                                return $row->storeDetails->store_name;
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('product_id', function ($row) {
                            if ($row->productDetails) {
                                return $row->productDetails->title;
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
                            if (Auth::guard('admin')->user()->type == 'S') {
                                if ($isAllow || in_array($this->viewUrl, $allowedRoutes)) {
                                    $btn .= '<a href="'.route($this->routePrefix.'.order.view', customEncryptionDecryption($row->id)).'" data-microtip-position="top" role="tooltip" class="btn btn-primary btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_view').'" target="_blank"><i class="fa fa-eye ml_minus_2"></i></a>';
                                }
                                if ($isAllow || in_array($this->deleteUrl, $allowedRoutes)) {
                                    $btn .= ' <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-danger btn-circle btn-circle-sm delete" aria-label="'.trans('custom_admin.label_delete').'" data-action-type="delete" data-id="'.customEncryptionDecryption($row->id).'"><i class="fa fa-trash"></i></a>';
                                }
                            } else {
                                $btn .= '<a href="'.route($this->routePrefix.'.order.view', customEncryptionDecryption($row->id)).'" data-microtip-position="top" role="tooltip" class="btn btn-primary btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_view').'" target="_blank"><i class="fa fa-eye ml_minus_2"></i></a>';
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
        * Function name : edit
        * Purpose       : This function is to edit order
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : Request $request
        * Return Value  : Returns order data
    */
    public function edit(Request $request, $id = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_edit_order'),
            'panelTitle'    => trans('custom_admin.label_edit_order'),
            'pageType'      => 'EDITPAGE'
        ];

        try {
            $data['id']         = $id;
            $data['orderId']    = $id = customEncryptionDecryption($id, 'decrypt');
            $data['details']    = $details = $this->model->where(['id' => $id])->first();
            
            if ($request->isMethod('POST')) {
                if ($id == null) {
                    $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
                    return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                }
                $validationCondition = array(
                    'qty'   => 'required|regex:'.config('global.VALID_NUMERIC'),
                    'why'   => 'required',
                    'result'=> 'required',
                );
                $validationMessages = array(
                    'qty.required'      => trans('custom_admin.error_qty'),
                    'qty.regex'         => trans('custom_admin.error_enter_valid_number'),
                    'why.required'      => trans('custom_admin.error_why'),
                    'result.required'   => trans('custom_admin.error_result')
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $updateData             = [];
                    $updateData['qty']      = $request->qty ?? null;
                    $updateData['why']      = $request->why ?? null;
                    $updateData['result']   = $request->result ?? null;
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
        * Function name : view
        * Purpose       : This function is to view order
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : Request $request
        * Return Value  : Returns order data
    */
    public function view(Request $request, $id = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_view_order'),
            'panelTitle'    => trans('custom_admin.label_view_order'),
            'pageType'      => 'VIEWPAGE'
        ];

        try {
            $data['id']         = $id;
            $data['orderId']    = $id = customEncryptionDecryption($id, 'decrypt');
            $data['details']    = $details = $this->model->where(['id' => $id])->first();
            
            return view($this->viewFolderPath.'.view', $data);
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