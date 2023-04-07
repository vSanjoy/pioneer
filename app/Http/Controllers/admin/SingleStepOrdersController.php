<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : Single Step Orders Controller
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
use App\Models\SingleStepOrder;
use App\Models\SingleStepOrderDetail;
use App\Models\DistributionArea;
use App\Models\Beat;
use App\Models\Store;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use DataTables;


class SingleStepOrdersController extends Controller
{
    use GeneralMethods;
    public $controllerName  = 'SingleStepOrders';
    public $management;
    public $modelName       = 'SingleStepOrder';
    public $breadcrumb;
    public $routePrefix     = 'admin';
    public $pageRoute       = 'singleStepOrder';
    public $listUrl         = 'singleStepOrder.list';
    public $listRequestUrl  = 'singleStepOrder.ajax-list-request';
    public $addUrl          = 'singleStepOrder.add';
    public $editUrl         = 'singleStepOrder.edit';
    public $viewUrl         = 'singleStepOrder.view';
    public $statusUrl       = 'singleStepOrder.change-status';
    public $deleteUrl       = 'singleStepOrder.delete';
    public $viewFolderPath  = 'admin.singleStepOrder';
    public $model           = 'SingleStepOrder';

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
        $this->model        = new SingleStepOrder();

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
            $data['beats'] = Beat::where(['status' => '1'])->whereNull('deleted_at')->select('id','title')->orderBy('title', 'ASC')->get();
            $data['distributionAreas'] = DistributionArea::where(['status' => '1'])->whereNull('deleted_at')->select('id','title')->orderBy('title', 'ASC')->get();
            $data['stores'] = Store::where(['status' => '1'])->whereNull('deleted_at')->select('id','store_name')->orderBy('store_name', 'ASC')->get();

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
                // Order list logged in user wise
                if (Auth::guard('admin')->user()->type == 'D') {
                    $data = $this->model->where([
                                            'distributor_id' => Auth::guard('admin')->user()->id
                                        ])
                                        ->orderBy('id', 'desc');
                } else if (Auth::guard('admin')->user()->type == 'S') {
                    $data = $this->model->where([
                                            'seller_id' => Auth::guard('admin')->user()->id
                                        ])
                                        ->orderBy('id', 'desc');
                } else {
                    $data = $this->model->orderBy('id', 'desc');
                }
                // Order list logged in user wise

                $dateRange          = $request->date_range;
                $filterByDateRange  = false;
                if ($dateRange != '') {
                    $filterByDateRange  = true;
                    $filter['date_range'] = $dateRange;

                    $explodedDateRange = explode(' - ', $dateRange);

                    $from   = $explodedDateRange[0];
                    $to     = $explodedDateRange[1];
                }
                // Distribution Area
                $distributionAreaId         = $request->distribution_area_id;
                $filterByDistributionArea   = false;
                if ($distributionAreaId != '') {
                    $filterByDistributionArea = true;
                    $filter['distribution_area_id'] = $distributionAreaId;
                }
                // Beat
                $beatId         = $request->beat_id;
                $filterByBeat   = false;
                if ($beatId != '') {
                    $filterByBeat = true;
                    $filter['beat_id'] = $beatId;
                }
                // Store
                $storeId            = $request->store_id;
                $filterByStore      = false;
                if ($storeId != '') {
                    $filterByStore  = true;
                    $filter['store_id'] = $storeId;
                }

                // Start :: Manage restriction
                $isAllow = false;
                $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
                if ($restrictions['is_super_admin']) {
                    $isAllow = true;
                }
                $allowedRoutes  = $restrictions['allow_routes'];
                // End :: Manage restriction

                // Based on disribution area filter
                if ($filterByDateRange) {
                    $data = $data->whereBetween('created_at', [$from, $to]);
                }
                if ($filterByDistributionArea) {
                    $data = $data->where('distribution_area_id', $distributionAreaId);
                }
                if ($filterByBeat) {
                    $data = $data->where('beat_id', $beatId);
                }
                if ($filterByStore) {
                    $data = $data->where('store_id', $storeId);
                }
                $data = $data->get();

                return Datatables::of($data, $isAllow, $allowedRoutes)
                        ->addIndexColumn()
                        ->addColumn('created_at', function ($row) {
                            return changeDateFormat($row->created_at, 'd-m-Y H:i');
                        })
                        ->addColumn('unique_order_id', function ($row) {
                            return $row->unique_order_id;
                        })
                        ->addColumn('seller_id', function ($row) {
                            if ($row->sellerDetails) {
                                return $row->sellerDetails->full_name;
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('distribution_area_id', function ($row) {
                            if ($row->distributionAreaDetails) {
                                return $row->distributionAreaDetails->title;
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('beat_id', function ($row) {
                            if ($row->beatDetails) {
                                return $row->beatDetails->title;
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
                        ->addColumn('analysis_season_id', function ($row) {
                            if ($row->analysisSeasonDetails) {
                                return $row->analysisSeasonDetails->title.' ('.$row->analysisSeasonDetails->year.')';
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
                                    $btn .= '<a href="'.route($this->routePrefix.'.singleStepOrder.view', customEncryptionDecryption($row->id)).'" data-microtip-position="top" role="tooltip" class="btn btn-primary btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_view').'" target="_blank"><i class="fa fa-eye ml_minus_2"></i></a>';
                                }
                                if ($isAllow || in_array($this->deleteUrl, $allowedRoutes)) {
                                    $btn .= ' <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-danger btn-circle btn-circle-sm delete" aria-label="'.trans('custom_admin.label_delete').'" data-action-type="delete" data-id="'.customEncryptionDecryption($row->id).'"><i class="fa fa-trash"></i></a>';
                                }
                            } else {
                                $btn .= '<a href="'.route($this->routePrefix.'.singleStepOrder.view', customEncryptionDecryption($row->id)).'" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_view').'" target="_blank"><i class="fa fa-eye ml_minus_2"></i></a>';

                                $btn .= ' <a href="'.route($this->routePrefix.'.singleStepOrder.edit', customEncryptionDecryption($row->id)).'" data-microtip-position="top" role="tooltip" class="btn btn-primary btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_edit').'" target="_blank"><i class="fa fa-edit"></i></a>';

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
            $data['details']    = $details = $this->model->where(['id' => $id])->with(['singleStepOrderDetails','analysesDetails','analysisSeasonDetails'])->first();
            
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
                        SingleStepOrderDetail::where(['single_step_order_id' => $id])->delete();
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
            $data['id']             = $id;
            $data['orderId']        = $id = customEncryptionDecryption($id, 'decrypt');
            $data['details']        = $details = $this->model->where(['id' => $id])->with(['singleStepOrderDetails','analysesDetails','analysisSeasonDetails'])->first();
            $data['invoiceDetails'] = Invoice::where(['single_step_order_id' => $id])->with(['singleStepOrder','invoiceDetails'])->first();
            $data['categories']     = Category::where(['status' => '1'])->select('id','title')->get();
            $data['products']       = Product::where(['status' => '1'])->select('id','category_id','title')->get();

            if ($request->isMethod('POST')) {
                if ($id == null) {
                    $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
                    return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                }

                if (count($request->category_id)) {
                    // Invoice table insertion
                    $newInvoice = new Invoice();
                    $newInvoice->single_step_order_id = $id;
                    if ($newInvoice->save()) {
                        // Invoice details table insertion
                        foreach ($request->category_id as $keyItem => $valItem) {
                            if ($valItem != '') {
                                $newInvoiceDetail                   = new InvoiceDetail();
                                $newInvoiceDetail->invoice_id       = $newInvoice->id;
                                $newInvoiceDetail->category_id      = $valItem;
                                $newInvoiceDetail->product_id       = $request->product_id[$keyItem];
                                $newInvoiceDetail->qty              = $request->qty[$keyItem];
                                $newInvoiceDetail->unit_price       = $request->unit_price[$keyItem];
                                $newInvoiceDetail->discount_percent = $request->discount_percent[$keyItem];
                                $newInvoiceDetail->discount_amount  = $request->discount_amount[$keyItem];
                                $newInvoiceDetail->total_price      = $request->total_price[$keyItem];
                                $newInvoiceDetail->status           = $request->status[$keyItem];
                                $newInvoiceDetail->save();
                            }
                        }

                        $this->generateToastMessage('success', trans('custom_admin.success_invoice_created_successfully'), false);
                        return redirect()->back();
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
        * Function name : updateInvoice
        * Purpose       : This function is to update invoice
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : Request $request
        * Return Value  : Returns invoice data
    */
    public function updateInvoice(Request $request, $id = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_edit_order'),
            'panelTitle'    => trans('custom_admin.label_edit_order'),
            'pageType'      => 'EDITPAGE'
        ];

        try {
            $data['id']             = $id;
            $data['invoiceId']      = $id = customEncryptionDecryption($id, 'decrypt');
            $data['invoiceDetails'] = $invoiceDetails = Invoice::where(['id' => $id])->with(['singleStepOrder','invoiceDetails'])->first();

            $data['details']        = $details = $this->model->where(['id' => $invoiceDetails->single_step_order_id])->with(['singleStepOrderDetails','analysesDetails','analysisSeasonDetails'])->first();
            $data['categories']     = Category::where(['status' => '1'])->select('id','title')->get();
            $data['products']       = Product::where(['status' => '1'])->select('id','category_id','title')->get();
            
            if ($request->isMethod('POST')) {
                if ($id == null) {
                    $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
                    return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                }

                if (count($request->category_id)) {
                    foreach ($request->category_id as $keyItem => $valItem) {
                        if ($valItem != '') {
                            if (array_key_exists($keyItem, $request->id)) {
                                InvoiceDetail::where(['id' => $request->id[$keyItem]])
                                                ->update([
                                                    'category_id'       => $valItem,
                                                    'product_id'        => $request->product_id[$keyItem],
                                                    'qty'               => $request->qty[$keyItem],
                                                    'unit_price'        => $request->unit_price[$keyItem],
                                                    'discount_percent'  => $request->discount_percent[$keyItem],
                                                    'discount_amount'   => $request->discount_amount[$keyItem],
                                                    'total_price'       => $request->total_price[$keyItem],
                                                    'status'            => $request->status[$keyItem]
                                                ]);
                            } else {
                                $newInvoiceDetail                   = new InvoiceDetail();
                                $newInvoiceDetail->invoice_id       = $id;
                                $newInvoiceDetail->category_id      = $valItem;
                                $newInvoiceDetail->product_id       = $request->product_id[$keyItem];
                                $newInvoiceDetail->qty              = $request->qty[$keyItem];
                                $newInvoiceDetail->unit_price       = $request->unit_price[$keyItem];
                                $newInvoiceDetail->discount_percent = $request->discount_percent[$keyItem];
                                $newInvoiceDetail->discount_amount  = $request->discount_amount[$keyItem];
                                $newInvoiceDetail->total_price      = $request->total_price[$keyItem];
                                $newInvoiceDetail->status           = $request->status[$keyItem];
                                $newInvoiceDetail->save();
                            }
                            $title  = trans('custom_admin.message_success');
                            $message= trans('custom_admin.success_invoice_data_updated_successfully');
                            $type   = 'success';
                        }
                    }
                    $this->generateToastMessage('success', trans('custom_admin.success_invoice_created_successfully'), false);
                    return redirect()->back();
                } else {
                    $this->generateToastMessage('error', trans('custom_admin.error_took_place_while_updating'), false);
                    return redirect()->back()->withInput();
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
        * Function name : ajaxCategoeyWiseProducts
        * Purpose       : This function to get list of products, category wise
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function ajaxCategoeyWiseProducts(Request $request) {
        $title  = trans('custom_admin.message_error');
        $message= trans('custom_admin.error_something_went_wrong');
        $type   = 'error';
        $options= '<option value="">--Select--</option>';

        try {
            if ($request->ajax()) {
                $productList = Product::where(['category_id' => $request->categoryId])->select('id','category_id','title')->get();
                if ($productList->count()) {
                    foreach ($productList as $itemProduct) {
                        $options .= '<option value="'.$itemProduct->id.'">'.$itemProduct->title.'</option>';
                    }
                    
                    $title  = trans('custom_admin.message_success');
                    $message= trans('custom_admin.message_success');
                    $type   = 'success';
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }
        return response()->json(['title' => $title, 'message' => $message, 'type' => $type, 'options' => $options]);
    }
    
    /*
        * Function name : ajaxProductDetails
        * Purpose       : This function to get product details
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function ajaxProductDetails(Request $request) {
        $title  = trans('custom_admin.message_error');
        $message= trans('custom_admin.error_something_went_wrong');
        $type   = 'error';
        $price  = 0;

        try {
            if ($request->ajax()) {
                $productDetails = Product::where(['id' => $request->productId])->select('id','title','rate_per_pcs','mrp','retailer_price')->first();
                if ($productDetails != null) {
                    $price = $productDetails->retailer_price;
                    
                    $title  = trans('custom_admin.message_success');
                    $message= trans('custom_admin.message_success');
                    $type   = 'success';
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }
        return response()->json(['title' => $title, 'message' => $message, 'type' => $type, 'price' => formatToTwoDecimalPlaces($price)]);
    }

    /*
        * Function name : ajaxDiscountAmountCalculation
        * Purpose       : This function to calculate discount of a product
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function ajaxDiscountAmountCalculation(Request $request) {
        $title  = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type   = 'error';
        $discountAmount = 0;
        $totalAmountAfterDiscount = 0;
        $qty = 1;

        try {
            if ($request->ajax()) {
                $productId = $request->productId;
                $qty = $request->qty;
                $unitPrice = $request->unitPrice;
                $discountPercent = $request->discountPercent;
                
                $productDetails = Product::where(['id' => $productId])->first();
                if ($productDetails != null) {
                    if ($qty != 0) {
                        $productRetailAmount = $unitPrice ? $unitPrice : $productDetails->retailer_price;
                        $productRetailAmount = $productRetailAmount * $qty;

                        if ($discountPercent >= 0) {
                            $discountAmount = ($productRetailAmount * $discountPercent ) / 100;
                            if ($discountAmount >= 0) {
                                if ($discountAmount > $productRetailAmount) {
                                    $discountAmount = $productRetailAmount;
                                    $totalAmountAfterDiscount = 0;
                                } else {
                                    if ($discountAmount <= 0) {
                                        $discountAmount = 0;
                                        $totalAmountAfterDiscount = $productRetailAmount;
                                    } else {
                                        $totalAmountAfterDiscount = $productRetailAmount - $discountAmount;
                                    }
                                }
                            } else if ($discountPercent == '') {
                                $discountAmount = '';
                                $totalAmountAfterDiscount = $productRetailAmount;
                            } else {
                                $discountAmount = 0;
                                $totalAmountAfterDiscount = $productRetailAmount;
                            }
                        } else {
                            $totalAmountAfterDiscount = $productRetailAmount;
                        }
                    } else {
                        $discountAmount = 0;
                        $totalAmountAfterDiscount = 0;
                    }
                    $title  = trans('custom_admin.message_success');
                    $message= trans('custom_admin.message_success');
                    $type   = 'success';
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }
        return response()->json(['title' => $title, 'message' => $message, 'type' => $type, 'qty' => $qty, 'discountAmount' => formatToTwoDecimalPlaces($discountAmount), 'totalAmountAfterDiscount' => formatToTwoDecimalPlaces($totalAmountAfterDiscount)]);
    }
    
    /*
        * Function name : ajaxDeleteInvoice
        * Purpose       : This function to delete main single step order / invoice
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function ajaxDeleteInvoice(Request $request) {
        $title      = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type       = 'error';

        try {
            if ($request->ajax()) {
                if ($request->type == 'invoice') {
                    $isExistInvoice = Invoice::where(['id' => $request->id])->first();
                    if ($isExistInvoice != null) {
                        $isExistInvoice->delete();

                        // Delete from details table
                        InvoiceDetail::where(['invoice_id' => $request->id])->delete();

                        $title  = trans('custom_admin.message_success');
                        $message= trans('custom_admin.message_success');
                        $type   = 'success';
                    }
                } else {
                    $isExistSingleStepOrder = SingleStepOrder::where(['id' => $request->id])->first();
                    if ($isExistSingleStepOrder != null) {
                        $isExistSingleStepOrder->delete();

                        // Delete from details table
                        SingleStepOrderDetail::where(['single_step_order_id' => $request->id])->delete();

                        $title  = trans('custom_admin.message_success');
                        $message= trans('custom_admin.message_success');
                        $type   = 'success';
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
        * Function name : ajaxUpdateInvoice
        * Purpose       : This function to update invoice details
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function ajaxUpdateInvoice(Request $request) {
        $title      = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type       = 'error';

        try {
            if ($request->ajax()) {
                $isExistInvoice = InvoiceDetail::where(['id' => $request->invoiceDetailId])->first();
                if ($isExistInvoice != null) {
                    $isExistInvoice->category_id        = $request->categoryId;
                    $isExistInvoice->product_id         = $request->productId;
                    $isExistInvoice->qty                = $request->qty;
                    $isExistInvoice->unit_price         = $request->unitPrice;
                    $isExistInvoice->discount_percent   = $request->discountPercent;
                    $isExistInvoice->discount_amount    = $request->discountAmount;
                    $isExistInvoice->total_price        = $request->totalPrice;
                    $isExistInvoice->status             = $request->status;
                    $isExistInvoice->save();

                    $title  = trans('custom_admin.message_success');
                    $message= trans('custom_admin.success_invoice_data_updated_successfully');
                    $type   = 'success';
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
        * Function name : ajaxDeleteInvoiceDetail
        * Purpose       : This function to delete invoice details & invoice
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function ajaxDeleteInvoiceDetail(Request $request) {
        $title      = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type       = 'error';
        $allDeleted = 0;

        try {
            if ($request->ajax()) {
                if ($request->type == 'invoice') {  // Deleten data from invoice_details & invoices table
                    $isExistInvoiceDetails = InvoiceDetail::where(['id' => $request->id])->first();
                    if ($isExistInvoiceDetails != null) {
                        $isExistInvoiceDetails->delete();

                        $count = InvoiceDetail::where(['invoice_id' => $isExistInvoiceDetails->invoice_id])->count();
                        if ($count == 0) {
                            Invoice::where(['id' => $isExistInvoiceDetails->invoice_id])->delete();
                            $allDeleted = 1;
                        }
                        $title  = trans('custom_admin.message_success');
                        $message= trans('custom_admin.message_success');
                        $type   = 'success';
                    }
                } else {  // Deleten data from single_step_order_details & single_step_orders table
                    $isExistSingleStepOrder = SingleStepOrderDetail::where(['id' => $request->id])->first();
                    if ($isExistSingleStepOrder != null) {
                        $isExistSingleStepOrder->delete();

                        $count = SingleStepOrderDetail::where(['single_step_order_id' => $isExistSingleStepOrder->single_step_order_id])->count();
                        if ($count == 0) {
                            SingleStepOrder::where(['id' => $isExistSingleStepOrder->single_step_order_id])->delete();
                            $allDeleted = 1;
                        }
                        $title  = trans('custom_admin.message_success');
                        $message= trans('custom_admin.message_success');
                        $type   = 'success';
                    }
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }
        return response()->json(['title' => $title, 'message' => $message, 'type' => $type, 'allDeleted' => $allDeleted]);
    }

}