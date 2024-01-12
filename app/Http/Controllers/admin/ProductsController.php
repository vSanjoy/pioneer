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
use App\Models\Category;
use App\Models\Product;
use App\Models\Grade;
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
            $data['categories'] = Category::where(['status' => '1'])->whereNull(['deleted_at'])->select('id', 'title')->orderBy('sort', 'ASC')->get();

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
                $categoryId = $request->category_id ?? '';
                if ($categoryId == '') {
                    $data = $this->model->whereNull('deleted_at')->get();
                } else {
                    $data = $this->model->where(['category_id' => $categoryId])->whereNull('deleted_at')->get();    // Based on category search
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
                        ->addColumn('category', function ($row) {
                            if ($row->categoryDetails !== NULL) {
                                return $row->categoryDetails->title;
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('title', function ($row) {
                            return '<a href="javascript: void(0);" data-microtip-position="right" role="tooltip" aria-label="'.trans('custom_admin.label_double_click_to_open_in_new_window').'" class="doubleClick">'.$row->title.'</a>';
                        })
                        ->addColumn('rate_per_pcs', function ($row) {
                            return formatToTwoDecimalPlaces($row->rate_per_pcs);
                        })
                        ->addColumn('mrp', function ($row) {
                            if ($row->mrp !== NULL) {
                                return formatToTwoDecimalPlaces($row->mrp);
                            } else {
                                return 'N/A';
                            }
                        })
                        ->addColumn('retailer_price', function ($row) {
                            if ($row->retailer_price !== NULL) {
                                return formatToTwoDecimalPlaces($row->retailer_price);
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
                        ->rawColumns(['category','title', 'edit_link','status','action'])
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
                    'title'         => 'required|unique:'.($this->model)->getTable().',title,NULL,id,deleted_at,NULL',
                    'rate_per_pcs'  => 'required|regex:'.config('global.VALID_AMOUNT_REGEX'),
                    'mrp'           => 'nullable|regex:'.config('global.VALID_AMOUNT_REGEX'),
                    'retailer_price'=> 'required|regex:'.config('global.VALID_AMOUNT_REGEX'),
                );
                $validationMessages = array(
                    'category_id.required'      => trans('custom_admin.error_category'),
                    'title.required'            => trans('custom_admin.error_title'),
                    'title.unique'              => trans('custom_admin.error_unique_product_title'),
                    'rate_per_pcs.required'     => trans('custom_admin.error_rate_per_pcs'),
                    'rate_per_pcs.regex'        => trans('custom_admin.error_valid_amount'),
                    'mrp.regex'                 => trans('custom_admin.error_valid_amount'),
                    'retailer_price.required'   => trans('custom_admin.error_retailer_price'),
                    'retailer_price.regex'      => trans('custom_admin.error_valid_amount'),
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $saveData                   = [];
                    $saveData['category_id']    = $request->category_id ?? null;
                    $saveData['grade_id']       = $request->grade_id ?? null;
                    $saveData['title']          = $request->title ?? null;
                    $saveData['slug']           = generateUniqueSlug($this->model, trim($request->title,' '));
                    $saveData['rate_per_pcs']   = $request->rate_per_pcs ?? 0;
                    $saveData['mrp']            = $request->mrp ?? null;
                    $saveData['retailer_price'] = $request->retailer_price ?? 0;
                    $saveData['pack_size']      = $request->pack_size ?? null;
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

            $data['categories'] = Category::where(['status' => '1'])
                                            ->select('id','title')
                                            ->get();
            $data['grades']     = Grade::where(['status' => '1'])
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
            $data['id']         = $id;
            $data['productId']  = $id = customEncryptionDecryption($id, 'decrypt');
            $data['categories'] = Category::where(['status' => '1'])
                                            ->select('id','title')
                                            ->get();
            $data['grades']     = Grade::where(['status' => '1'])
                                            ->select('id','title')
                                            ->get();
            $data['details']    = $details = $this->model->where(['id' => $id])->first();
            
            if ($request->isMethod('POST')) {
                if ($id == null) {
                    $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
                    return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                }
                $validationCondition = array(
                    'category_id'   => 'required',
                    'title'         => 'required|unique:'.($this->model)->getTable().',title,'.$id.',id,deleted_at,NULL',
                    'rate_per_pcs'  => 'required|regex:'.config('global.VALID_AMOUNT_REGEX'),
                    'mrp'           => 'nullable|regex:'.config('global.VALID_AMOUNT_REGEX'),
                    'retailer_price'=> 'required|regex:'.config('global.VALID_AMOUNT_REGEX'),
                );
                $validationMessages = array(
                    'category_id.required'      => trans('custom_admin.error_category'),
                    'title.required'            => trans('custom_admin.error_title'),
                    'title.unique'              => trans('custom_admin.error_unique_product_title'),
                    'rate_per_pcs.required'     => trans('custom_admin.error_rate_per_pcs'),
                    'rate_per_pcs.regex'        => trans('custom_admin.error_valid_amount'),
                    'mrp.regex'                 => trans('custom_admin.error_valid_amount'),
                    'retailer_price.required'   => trans('custom_admin.error_retailer_price'),
                    'retailer_price.regex'      => trans('custom_admin.error_valid_amount'),
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $updateData                     = [];
                    $updateData['category_id']      = $request->category_id ?? null;
                    $updateData['grade_id']         = $request->grade_id ?? null;
                    $updateData['title']            = $request->title ?? null;
                    $updateData['slug']             = generateUniqueSlug($this->model, trim($request->title,' '), $data['id']);
                    $updateData['rate_per_pcs']     = $request->rate_per_pcs ?? 0;
                    $updateData['mrp']              = $request->mrp ?? null;
                    $updateData['retailer_price']   = $request->retailer_price ?? 0;
                    $updateData['pack_size']        = $request->pack_size ?? null;
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
