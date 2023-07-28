@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	<style>
	.fs14{font-size: 14px !important;}
	.fs12{font-size: 12px !important;}
	.error{font-size: 10px !important;}
	.form-control{height: 26px; line-height: 20px; padding: 0.275rem 0.25rem;}
	.table td{padding: 5px 10px;}
	.table th{padding: 5px 10px;}
	.btn-padding{padding: 0.175rem 0.5rem}
	/* .fab-container{ position:fixed; bottom:50px; right:50px; cursor:pointer; z-index: 99;}
	.iconbutton{width:50px; height:50px; border-radius: 100%; background: #FF4F79; box-shadow: 10px 10px 5px #aaaaaa;}
	.button{width:60px; height:60px; background:#A11692;}
	.iconbutton i{display:flex; align-items:center; justify-content:center; height: 100%; color:white;}
	.options li{display:flex; justify-content:flex-end; padding:5px;}
	.options{list-style-type: none; position:absolute; bottom:70px; right:0;}
	.btn-label{padding:2px 5px; margin-right:10px; align-self: center; user-select:none; background-color: black; color:white; border-radius: 3px; box-shadow: 10px 10px 5px #aaaaaa;} */
	</style>

	@php
	$countOrderProduct = 1;
	if (!$invoiceDetails) {
		if (count($details->singleStepOrderDetails) > 0) {
			$countOrderProduct = count($details->singleStepOrderDetails);
		}
	} else {
		if (count($invoiceDetails->invoiceDetails) > 0) {
			$countOrderProduct = count($invoiceDetails->invoiceDetails);
		}
	}
	@endphp

	{{-- Start :: If invoice not created (data will come from single step order) --}}
	@if (!$invoiceDetails)

	{{ Form::open([
		'method'=> 'POST',
		'class' => '',
		'route' => [$routePrefix.'.'.$editUrl.'-submit', $id],
		'name'  => 'createInvoiceSingleStepOrderForm',
		'id'    => 'createInvoiceSingleStepOrderForm',
		'files' => true,
		'novalidate' => true ]) }}

		{{ Form::hidden('id', $id, ['id' => 'id', 'class' => 'form-control']) }}

		<div class="row">
			<div class="col-12">
				<div class="card" style="margin-bottom: 15px;">
					<div class="table-responsive">
						<table class="table table-bordered table-responsive-lg" style="margin-bottom: 0;">
							<tbody>
								<tr>
									<td class="fs14"><strong>@lang('custom_admin.label_unique_order_id'):</strong> {!! $details->unique_order_id ?? 'NA' !!}</td>
									<td class="fs14"><strong>@lang('custom_admin.label_order_date_time'):</strong> {!! changeDateFormat($details->created_at) !!}</td>
									<td class="fs14"><strong>@lang('custom_admin.label_season'):</strong> {!! $details->analysisSeasonDetails->title ?? 'NA' !!}</td>
									<td class="fs14"><strong>@lang('custom_admin.label_distribution_area'):</strong> {!! $details->distributionAreaDetails->title ?? 'NA' !!}</td>
									<td class="fs14"><strong>@lang('custom_admin.label_beat'):</strong> {!! $details->beatDetails->title ?? 'NA' !!}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="card" style="margin-bottom: 15px;">
					<div class="table-responsive">
						<table class="table table-bordered table-responsive-lg" style="margin-bottom: 0;">
							<tbody>
								<tr>
									<td class="fs14"><strong>@lang('custom_admin.label_store'):</strong> {!! $details->storeDetails->store_name ?? 'NA' !!}</td>
									<td class="fs14"><strong>@lang('custom_admin.label_owner'):</strong> {!! $details->storeDetails->name_1 ?? 'NA' !!}</td>
									<td class="fs14"><strong>@lang('custom_admin.label_phone'):</strong> {!! $details->storeDetails->phone_no_1 ?? 'NA' !!}</td>
									<td class="fs14"><strong>@lang('custom_admin.label_representative'):</strong> {!! $details->sellerDetails->full_name ?? 'NA' !!}</td>
									<td>
										<span class="float-right">
											<button type="submit" class="btn btn-primary waves-effect waves-light btn-rounded shadow-md fs12 btn-padding" id="btn-processing">
												<i class="far fa-save"></i> @lang('custom_admin.btn_create_invoice')
											</button>
											{{-- <a class="btn btn-success waves-effect waves-light btn-rounded shadow-md ml-1 fs12 btn-padding" href="javascript: void(0);">
												<i class="fas fa-shipping-fast"></i> @lang('custom_admin.btn_ship_order')
											</a>
											<a class="btn btn-warning waves-effect waves-light btn-rounded shadow-md ml-1 fs12 btn-padding" href="javascript: void(0);">
												<i class="fa fa-check-circle" aria-hidden="true"></i> @lang('custom_admin.btn_complete_order')
											</a> --}}
											<a class="btn btn-danger waves-effect waves-light btn-rounded shadow-md ml-1 fs12 btn-padding deleteInvoice" data-ordid="{{ $details->id }}" data-type="single_step_order" href="javascript: void(0);">
												<i class="fa fa-trash" aria-hidden="true"></i> @lang('custom_admin.btn_delete_order')
											</a>
										</span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
			
		<div class="row">
			<div class="col-12">
				<div class="card" style="margin-bottom: 15px;">
					<div class="table-responsive">
						<input type="hidden" id="single_step_order_count" value="{{ $countOrderProduct }}">
						<table class="table table-bordered table-responsive-lg" style="margin-bottom: 0;">
							<thead>
								<tr class="fs12">
									<th scope="col">@lang('custom_admin.label_category')</th>
									<th scope="col">@lang('custom_admin.label_product')</th>
									<th scope="col">@lang('custom_admin.label_qty')</th>
									<th scope="col">@lang('custom_admin.label_unit_price')</th>
									<th scope="col">@lang('custom_admin.label_discount_percent')</th>
									<th scope="col">@lang('custom_admin.label_discount_amount')</th>
									<th scope="col">@lang('custom_admin.label_total_price')</th>
									<th scope="col">@lang('custom_admin.label_status')</th>
									<th scope="col">@lang('custom_admin.label_action')</th>
								</tr>
							</thead>
							<tbody>
						@if ($details->singleStepOrderDetails)
							@foreach ($details->singleStepOrderDetails as $keyItem => $item)
								@php
								$analysisDetails = analysisDetails($details->analyses_id, $item->categoryDetails->id, $item->productDetails->id);
								$getCategoryWiseProducts = orderProductsCategoryWise($item->categoryDetails->id);

								$quanty = $item->qty ?? 1;
								@endphp
								<tr id="section_id_{{ $item->id }}">
									<th scope="row">
										<select name="category_id[{{ $keyItem }}]" id="category_id_{{ $keyItem }}" class="form-control fs12 categoryDiscountCalculation" data-iid="{{ $keyItem }}" required>
											<option value="">--@lang('custom_admin.label_select')--</option>
										@foreach ($categories as $itemCategory)
											<option value="{{ $itemCategory->id }}" @if ($itemCategory->id == $item->category_id)selected @endif>{!! $itemCategory->title !!}</option>
										@endforeach
										</select>
									</th>
									<td>
										<select name="product_id[{{ $keyItem }}]" id="product_id_{{ $keyItem }}" class="form-control fs12 productDiscountCalculation" data-iid="{{ $keyItem }}" required>
											<option value="">--@lang('custom_admin.label_select')--</option>
										@foreach ($getCategoryWiseProducts as $itemProduct)
											<option value="{{ $itemProduct->id }}" @if ($itemProduct->id == $item->product_id)selected @endif>{!! $itemProduct->title !!}</option>
										@endforeach
										</select>
									</td>
									<td>
										{{ Form::number('qty['.$keyItem.']', $quanty, [
																	'id' => 'qty_'.$keyItem,
																	'placeholder' => '',
																	'class' => 'form-control fs12 qtyUnit qtyDiscountCalculation',
																	'data-iid' => $keyItem,
																	'min' => 1,
																	'required' => true
																]) }}
									</td>
									<td>
										{{ Form::number('unit_price['.$keyItem.']', $item->productDetails->retailer_price ? formatToTwoDecimalPlaces($item->productDetails->retailer_price) : $item->productDetails->retailer_price, [
												'id' => 'unit_price_'.$keyItem,
												'placeholder' => '',
												'class' => 'form-control fs12 unitPriceDiscountCalculation',
												'data-iid' => $keyItem,
												'min' => 0,
												'required' => true
											]) }}
									</td>
									<td>
										{{ Form::number('discount_percent['.$keyItem.']', null, [
																					'id' => 'discount_percent_'.$keyItem,
																					'placeholder' => '',
																					'class' => 'form-control fs12 discountCalculation',
																					'data-iid' => $keyItem,
																					'min' => 0,
																					'onkeyup' => "if(this.value < 0){this.value= this.value * -1}"
																				]) }}
									</td>
									<td>
										{{ Form::number('discount_amount['.$keyItem.']', null, [
																					'id' => 'discount_amount_'.$keyItem,
																					'placeholder' => '',
																					'class' => 'form-control fs12',
																					'readonly' => true,
																					'min' => 0
																				]) }}
									</td>
									<td>
										{{ Form::number('total_price['.$keyItem.']', $item->productDetails->retailer_price ? formatToTwoDecimalPlaces($item->productDetails->retailer_price * $quanty) : $item->productDetails->retailer_price, [
												'id' => 'total_price_'.$keyItem,
												'placeholder' => '',
												'class' => 'form-control fs12 totalPrice',
												'readonly' => true,
												'min' => 0
											]) }}
									</td>
									<td>
										<select name="status[{{ $keyItem }}]" id="status_{{ $keyItem }}" class="form-control fs12" required>
											<option value="">@lang('custom_admin.label_select')</option>
											<option value="A">@lang('custom_admin.label_allocated')</option>
											<option value="I">@lang('custom_admin.label_invoice')</option>
											<option value="S">@lang('custom_admin.label_shipped')</option>
											<option value="H">@lang('custom_admin.label_on_hold')</option>
											<option value="C">@lang('custom_admin.label_complete')</option>
										</select>
									</td>
									<td>
										<a class="deleteRow btn btn-danger ibtnDel btn-rounded" href="javascript: void(0);" style="padding: 0.300rem 0.45rem; font-size: 11px; line-height: 1.4;" data-cid="{{ $item->id }}" data-type="old"><i class="fa fa-trash" aria-hidden="true"></i></a>
									</td>
								</tr>
							@endforeach
						@endif	
							</tbody>
							<tbody class="addMoreProduct"></tbody>
							<tbody>
								<tr>
									<th scope="row" colspan="2">&nbsp;</th>
									<td id="totalQuantity" class="fs14">&nbsp;</td>
									<td class="fs14" colspan="3">&nbsp;</td>
									<td id="totalAmount" class="fs14">&nbsp;</td>
									<td id="totalAmount" class="fs14" colspan="2">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	{{ Form::close() }}
	{{-- End :: If invoice not created (data will come from single step order) --}}

	{{-- Start :: If invoice already created --}}
	@else

	{{ Form::open([
		'method'=> 'POST',
		'class' => '',
		'route' => [$routePrefix.'.'.'singleStepOrder.update-invoice', customEncryptionDecryption($invoiceDetails->id)],
		'name'  => 'updateInvoiceForm',
		'id'    => 'updateInvoiceForm',
		'files' => true,
		'novalidate' => true ]) }}

		<div class="row">
			<div class="col-12">
				<div class="card" style="margin-bottom: 15px;">
					<div class="table-responsive">
						<table class="table table-bordered table-responsive-lg" style="margin-bottom: 0;">
							<tbody>
								<tr>
									<td class="fs14"><strong>@lang('custom_admin.label_store'):</strong> {!! $invoiceDetails->singleStepOrder->storeDetails->store_name ?? 'NA' !!}</td>
									<td class="fs14"><strong>@lang('custom_admin.label_owner'):</strong> {!! $invoiceDetails->singleStepOrder->storeDetails->name_1 ?? 'NA' !!}</td>
									<td class="fs14"><strong>@lang('custom_admin.label_phone'):</strong> {!! $invoiceDetails->singleStepOrder->storeDetails->phone_no_1 ?? 'NA' !!}</td>
									<td class="fs14"><strong>@lang('custom_admin.label_representative'):</strong> {!! $invoiceDetails->singleStepOrder->sellerDetails->full_name ?? 'NA' !!}</td>
									<td>
										<span class="float-right">
											<button type="submit" class="btn btn-success waves-effect waves-light btn-rounded shadow-md fs12 btn-padding formButton" id="btn-updating" data-type="update_invoice">
												<i class="far fa-save"></i> @lang('custom_admin.btn_update_invoice')
											</button>
											<a class="btn btn-primary waves-effect waves-light btn-rounded shadow-md ml-1 fs12 btn-padding shipOrder" href="javascript: void(0);" data-ordid="{{ $invoiceDetails->id }}">
												<i class="fas fa-shipping-fast"></i> @lang('custom_admin.btn_ship_order')
											</a>
											<a class="btn btn-warning waves-effect waves-light btn-rounded shadow-md ml-1 fs12 btn-padding completeOrder" href="javascript: void(0);" data-ordid="{{ $invoiceDetails->id }}">
												<i class="fa fa-check-circle" aria-hidden="true"></i> @lang('custom_admin.btn_complete_order')
											</a>
											<a class="btn btn-danger waves-effect waves-light btn-rounded shadow-md ml-1 fs12 btn-padding deleteInvoice" data-ordid="{{ $invoiceDetails->id }}" data-type="invoice" href="javascript: void(0);">
												<i class="fa fa-trash" aria-hidden="true"></i> @lang('custom_admin.btn_delete_invoice')
											</a>
											<a class="btn btn-dark waves-effect waves-light btn-rounded shadow-md ml-1 fs12 btn-padding" href="{{ route($routePrefix.'.'.'singleStepOrder.download-invoice', customEncryptionDecryption($invoiceDetails->id)) }}" title="{{ __('custom_admin.btn_download_invoice') }}">
												<i class="fa fa-download" aria-hidden="true"></i>
											</a>
										</span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="card" style="margin-bottom: 15px;">
					<div class="table-responsive">
						<input type="hidden" id="single_step_order_count" value="{{ $countOrderProduct }}">
						<table class="table table-bordered table-responsive-lg" style="margin-bottom: 0;">
							<thead>
								<tr class="fs12">
									<th scope="col">@lang('custom_admin.label_category')</th>
									<th scope="col">@lang('custom_admin.label_product')</th>
									<th scope="col">@lang('custom_admin.label_qty')</th>
									<th scope="col">@lang('custom_admin.label_unit_price')</th>
									<th scope="col">@lang('custom_admin.label_discount_percent')</th>
									<th scope="col">@lang('custom_admin.label_discount_amount')</th>
									<th scope="col">@lang('custom_admin.label_total_price')</th>
									<th scope="col">@lang('custom_admin.label_status')</th>
									<th scope="col" style="width: 80px;">@lang('custom_admin.label_action')</th>
								</tr>
							</thead>
							<tbody>
						@if ($invoiceDetails->invoiceDetails)
							@foreach ($invoiceDetails->invoiceDetails as $keyItem => $item)
								@php
								$getCategoryWiseProducts = invoiceProductsCategoryWise($item->categoryDetails->id);
								@endphp
								<tr id="section_id_{{ $item->id }}">
									<th scope="row">
										{{ Form::hidden('id[]', $item->id, ['id' => 'invoice_id_'.$keyItem]) }}
										
										<select name="category_id[{{ $keyItem }}]" id="category_id_{{ $keyItem }}" class="form-control fs12 categoryDiscountCalculation" data-iid="{{ $keyItem }}" required>
											<option value="">--@lang('custom_admin.label_select')--</option>
										@foreach ($categories as $itemCategory)
											<option value="{{ $itemCategory->id }}" @if ($itemCategory->id == $item->category_id)selected @endif>{!! $itemCategory->title !!}</option>
										@endforeach
										</select>
									</th>
									<td>
										<select name="product_id[{{ $keyItem }}]" id="product_id_{{ $keyItem }}" class="form-control fs12 productDiscountCalculation" data-iid="{{ $keyItem }}" required>
											<option value="">--@lang('custom_admin.label_select')--</option>
										@foreach ($getCategoryWiseProducts as $itemProduct)
											<option value="{{ $itemProduct->id }}" @if ($itemProduct->id == $item->product_id)selected @endif>{!! $itemProduct->title !!}</option>
										@endforeach
										</select>
									</td>
									<td>
										{{ Form::number('qty['.$keyItem.']', $item->qty, [
																	'id' => 'qty_'.$keyItem,
																	'placeholder' => '',
																	'class' => 'form-control fs12 qtyUnit qtyDiscountCalculation',
																	'data-iid' => $keyItem,
																	'min' => 1,
																	'required' => true
																]) }}
									</td>
									<td>
										{{ Form::number('unit_price['.$keyItem.']', $item->unit_price ? formatToTwoDecimalPlaces($item->unit_price) : null, [
												'id' => 'unit_price_'.$keyItem,
												'placeholder' => '',
												'class' => 'form-control fs12 unitPriceDiscountCalculation',
												'data-iid' => $keyItem,
												'min' => 0,
												'required' => true
											]) }}
									</td>
									<td>
										{{ Form::number('discount_percent['.$keyItem.']', $item->discount_percent ?? null, [
																					'id' => 'discount_percent_'.$keyItem,
																					'placeholder' => '',
																					'class' => 'form-control fs12 discountCalculation',
																					'data-iid' => $keyItem,
																					'min' => 0,
																					'onkeyup' => "if(this.value < 0){this.value= this.value * -1}"
																				]) }}
									</td>
									<td>
										{{ Form::number('discount_amount['.$keyItem.']', $item->discount_amount ? formatToTwoDecimalPlaces($item->discount_amount) : null, [
																					'id' => 'discount_amount_'.$keyItem,
																					'placeholder' => '',
																					'class' => 'form-control fs12',
																					'readonly' => true,
																					'min' => 0
																				]) }}
									</td>
									<td>
										{{ Form::number('total_price['.$keyItem.']', $item->total_price ? formatToTwoDecimalPlaces($item->total_price) : null, [
												'id' => 'total_price_'.$keyItem,
												'placeholder' => '',
												'class' => 'form-control fs12 totalPrice',
												'readonly' => true,
												'min' => 0
											]) }}
									</td>
									<td>
										<select name="status[{{ $keyItem }}]" id="status_{{ $keyItem }}" class="form-control fs12" required>
											<option value="">@lang('custom_admin.label_select')</option>
											<option value="A" @if($item->status == 'A')selected @endif>@lang('custom_admin.label_allocated')</option>
											<option value="I" @if($item->status == 'I')selected @endif>@lang('custom_admin.label_invoice')</option>
											<option value="S" @if($item->status == 'S')selected @endif>@lang('custom_admin.label_shipped')</option>
											<option value="H" @if($item->status == 'H')selected @endif>@lang('custom_admin.label_on_hold')</option>
											<option value="C" @if($item->status == 'C')selected @endif>@lang('custom_admin.label_complete')</option>
										</select>
									</td>
									<td>
										{{-- <a class="btn btn-success btn-rounded updateInvoice" href="javascript: void(0);" style="padding: 0.300rem 0.45rem; font-size: 11px; line-height: 1.4;" data-cid="{{ $item->id }}" data-itemid="{{ $keyItem }}" title="Update">
											<i class="far fa-save"></i>
										</a> --}}
										<a class="deleteRow btn btn-danger ibtnDel btn-rounded" href="javascript: void(0);" style="padding: 0.300rem 0.45rem; font-size: 11px; line-height: 1.4;" data-cid="{{ $item->id }}" data-type="invoice" title="Delete">
											<i class="fa fa-trash" aria-hidden="true"></i>
										</a>
									</td>
								</tr>
							@endforeach
						@endif
							</tbody>
							<tbody class="addMoreProduct"></tbody>
							@if (count($invoiceDetails->invoiceDetails) > 0)
							<tbody>
								<tr>
									<th scope="row" colspan="2">&nbsp;</th>
									<td id="totalQuantity" class="fs14">&nbsp;</td>
									<td class="fs14" colspan="3">&nbsp;</td>
									<td id="totalAmount" class="fs14">&nbsp;</td>
									<td class="fs14" colspan="2">&nbsp;</td>
								</tr>
							</tbody>
							@endif
						</table>
					</div>
				</div>
			</div>
		</div>

	{{ Form::close() }}

	@endif
	{{-- End :: If invoice already created --}}
	
		<div class="row">
			<div class="col-md-12">
				<div class="float-right">
					<a class="btn btn-warning waves-effect waves-light btn-rounded shadow-md pr-3 pl-3 fs12" id="addMore" href="javascript: void(0);">
						<i class="fas fa-plus-circle"></i> @lang('custom_admin.btn_add_more_product')
					</a>
				</div>
			</div>
		</div>

@endsection

@push('scripts')
@include($routePrefix.'.'.$pageRoute.'.scripts')

<script>
$(document).ready(function() {
	var counter = $('#single_step_order_count').val();
	$("#addMore").on("click", function () {
		var cols = '';
		var newRow = $('<tr id="append_div_'+counter+'" style="position: relative;">');
			cols += '		<th scope="row">'+
								'<select name="category_id['+counter+']" id="category_id_'+counter+'" class="form-control fs12 categoryDiscountCalculation" data-iid="'+counter+'" required>'+
										'<option value="">--@lang("custom_admin.label_select")--</option>'+
									@foreach ($categories as $item)
										'<option value="{{ $item->id }}">{!! $item->title !!}</option>'+
									@endforeach
									'</select>'+
								'</th>';
			cols += '		<td>'+
								'<select name="product_id['+counter+']" id="product_id_'+counter+'" class="form-control fs12 productDiscountCalculation" data-iid="'+counter+'" required>'+
									'<option value="">--@lang("custom_admin.label_select")--</option>'+
								'</select>'+
							'</td>';
			cols += '		<td>'+
								'<input id="qty_'+counter+'" placeholder="" class="form-control fs12 qtyUnit qtyDiscountCalculation" data-iid="'+counter+'" min="1" name="qty['+counter+']" type="number" value="" required>'+
							'</td>';
			cols += '		<td>'+
								'<input data-iid="'+counter+'" id="unit_price_'+counter+'" placeholder="" class="form-control fs12 unitPriceDiscountCalculation" min="0" name="unit_price['+counter+']" type="number" required>'+
							'</td>';
			cols += '		<td>'+
								'<input id="discount_percent_'+counter+'" placeholder="" class="form-control fs12 discountCalculation" name="discount_percent['+counter+']" type="number" data-iid="'+counter+'">'+
							'</td>';
			cols += '		<td>'+
								'<input id="discount_amount_'+counter+'" placeholder="" class="form-control fs12" readonly="" min="0" name="discount_amount['+counter+']" type="number">'+
							'</td>';
			cols += '		<td>'+
								'<input id="total_price_'+counter+'" placeholder="" class="form-control fs12 totalPrice" readonly="" min="0" name="total_price['+counter+']" type="number" value="">'+
							'</td>';
			cols += '		<td>'+
								'<select name="status['+counter+']" id="status_'+counter+'" class="form-control fs12" required>'+
									'<option value="">@lang("custom_admin.label_select")</option>'+
									'<option value="A">@lang("custom_admin.label_allocated")</option>'+
									'<option value="I">@lang("custom_admin.label_invoice")</option>'+
									'<option value="S">@lang("custom_admin.label_shipped")</option>'+
									'<option value="H">@lang("custom_admin.label_on_hold")</option>'+
									'<option value="C">@lang("custom_admin.label_complete")</option>'
								'</select>'+
							'</td>';
			cols += '		<td>';
			cols += '			<a class="deleteRow btn btn-danger ibtnDel btn-rounded" href="javascript: void(0);" style="padding: 0.300rem 0.45rem; font-size: 11px; line-height: 1.4;" data-cid="'+counter+'" data-type="new"><i class="fa fa-trash" aria-hidden="true"></i></a>';
			cols += '		</td>';
			cols += '	</tr>';

		newRow.append(cols);
		$(".addMoreProduct").append(newRow);

		counter++;
	});
});
$(document).on('click','.deleteRow',function() {
	var divId	= $(this).data('cid');
	var type	= $(this).data('type');
	removeInvoiceProduct(divId, type);
});

// Start :: Calculate Discount Amount //
$(document).on('change','.categoryDiscountCalculation',function() {
	var itemId = $(this).data('iid');
	$('#qty_'+itemId).val(1);
	$('#unit_price_'+itemId).val('');
	$('#discount_percent_'+itemId).val('');
	$('#discount_amount_'+itemId).val('');
	$('#total_price_'+itemId).val('');

	var actionUrl = adminPanelUrl+'/singleStepOrder/ajax-categoey-wise-products';
	// $('.preloader').show();
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: actionUrl,
		method: 'GET',
		data: {
			'categoryId': $(this).val()
		},
		success: function (response) {
			// $('.preloader').hide();
			if (response.type == 'success') {
				$('#product_id_'+itemId).html(response.options);
			} else {
				$('#product_id_'+itemId).html('<option value="">--Select--</option>');
			}

			// calculate total quantity & amount
			calculateTotalQuantityAndAmount();
		}
	});
});
$(document).on('change','.productDiscountCalculation',function() {
	var itemId = $(this).data('iid');
	$('#qty_'+itemId).val(1);
	$('#unit_price_'+itemId).val('');
	$('#discount_percent_'+itemId).val('');
	$('#discount_amount_'+itemId).val('');
	$('#total_price_'+itemId).val('');

	var actionUrl = adminPanelUrl+'/singleStepOrder/ajax-product-details';
	// $('.preloader').show();
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: actionUrl,
		method: 'GET',
		data: {
			'productId': $(this).val()
		},
		success: function (response) {
			// $('.preloader').hide();
			if (response.type == 'success') {
				$('#unit_price_'+itemId).val(response.price);
				$('#total_price_'+itemId).val(response.price);
			} else {
				$('#unit_price_'+itemId).val('');
				$('#total_price_'+itemId).val('');
			}

			// calculate total quantity & amount
			calculateTotalQuantityAndAmount();
		}
	});
});
$(document).on('keyup keydown change','.qtyDiscountCalculation',function() {
	var qty				= $(this).val();
	var itemId			= $(this).data('iid');
	var productId		= $('#product_id_'+itemId).find(":selected").val();
	var unitPrice		= $('#unit_price_'+itemId).val();
	var discountPercent	= $('#discount_percent_'+itemId).val();
	discountPercent		= discountPercent.replace(/[^\d.]/g, '');
	calculateDiscountAmpount(itemId, productId, qty, unitPrice, discountPercent);
});
$(document).on('keyup keydown change','.unitPriceDiscountCalculation',function() {
	var itemId			= $(this).data('iid');
	var qty				= $('#qty_'+itemId).val();
	var productId		= $('#product_id_'+itemId).find(":selected").val();
	var unitPrice		= $(this).val();
	var discountPercent	= $('#discount_percent_'+itemId).val();
	discountPercent		= discountPercent.replace(/[^\d.]/g, '');
	calculateDiscountAmpount(itemId, productId, qty, unitPrice, discountPercent);
});
$(document).on('keyup keydown change','.discountCalculation',function() {
	var itemId			= $(this).data('iid');
	var qty				= $('#qty_'+itemId).val();
	var productId		= $('#product_id_'+itemId).find(":selected").val();
	var unitPrice		= $('#unit_price_'+itemId).val();
	var discountPercent	= $('#discount_percent_'+itemId).val();
	discountPercent		= discountPercent.replace(/[^\d.]/g, '');
	calculateDiscountAmpount(itemId, productId, qty, unitPrice, discountPercent);
});

function calculateDiscountAmpount(itemId, productId, qty, unitPrice, discountPercent) {
	var actionUrl = adminPanelUrl+'/singleStepOrder/ajax-discount-amount-calculation';

	$('.preloader').show();
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: actionUrl,
		method: 'GET',
		data: {
			'productId': productId,
			'qty': qty,
			'unitPrice': unitPrice,
			'discountPercent': discountPercent
		},
		success: function (response) {
			$('.preloader').hide();
			if (response.type == 'success') {
				if (discountPercent != '') {
					$('#discount_amount_'+itemId).val(response.discountAmount);
				} else {
					$('#discount_amount_'+itemId).val('');
				}
				$('#total_price_'+itemId).val(response.totalAmountAfterDiscount);

				// calculate total quantity & amount
				calculateTotalQuantityAndAmount();
			} else {
				$('#discount_amount_'+itemId).val('');
				$('#total_price_'+itemId).val('');
			}
		}
	});
}
// End :: Calculate Discount Amount //

// Delete single step order
$(document).on('click','.deleteInvoice',function() {
	var id 	= $(this).data('ordid');
	var type= $(this).data('type');

	if (id != '' && type != '') {
		deleteInvoice(id, type);
	}
});

// Update invoice
$(document).on('click','.updateInvoice',function() {
	var invoiceDetailId = $(this).data('cid');
	var itemId			= $(this).data('itemid');
	var categoryId		= $('#category_id_'+itemId).val();
	var productId		= $('#product_id_'+itemId).val();
	var qty				= $('#qty_'+itemId).val();
	var unitPrice		= $('#unit_price_'+itemId).val();
	var discountPercent	= $('#discount_percent_'+itemId).val();
	var discountAmount	= $('#discount_amount_'+itemId).val();
	var totalPrice		= $('#total_price_'+itemId).val();
	var status			= $('#status_'+itemId).val();

	if (invoiceDetailId != '' && categoryId != '' && productId != '' && qty != '' && status != '') {
		updateInvoice(invoiceDetailId, itemId, categoryId, productId, qty, unitPrice, discountPercent, discountAmount, totalPrice, status);
	}
});

// Calculate total quantity & amount
$(window).on("load", function() {
	calculateTotalQuantityAndAmount();
});

function calculateTotalQuantityAndAmount() {
	var totalQuantity = 0;
	$(".qtyUnit").map(function() {
		if ($(this).val() != '') {
			totalQuantity += parseFloat($(this).val());
		}
	});
	$('#totalQuantity').html(totalQuantity);

	var totalAmount = 0;
	$(".totalPrice").map(function() {
		if ($(this).val() != '') {
			totalAmount += parseFloat($(this).val());
		}
	});
	$('#totalAmount').html(totalAmount.toFixed(2));
}


// Shipped all allocated/invoiced orders
$(document).on('click','.shipOrder',function() {
	var ordId = $(this).data('ordid');

	if (ordId != '') {
		shipOrder(ordId);
	}
});

// Complete order
$(document).on('click','.completeOrder',function() {
	var ordId = $(this).data('ordid');

	if (ordId != '') {
		completeOrder(ordId);
	}
});
</script>

@endpush