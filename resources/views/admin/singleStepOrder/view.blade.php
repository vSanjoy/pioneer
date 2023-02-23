@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $pageTitle }}</h4>
					<h3 class="mb-heading">{!! $details->distributionAreaDetails->title !!} - {!! $details->beatDetails->title !!} - {!! $details->storeDetails->name_1.' ('.$details->storeDetails->store_name.')' !!} - {!! $details->analysisSeasonDetails->title.' ('.$details->analysisSeasonDetails->year.')' !!}</h3>
				</div>
			</div>
		</div>
	</div>

	@if ($details->singleStepOrderDetails)
	<div class="row">
		<div class="col-12">
			@foreach ($details->singleStepOrderDetails as $item)
			@php
			$analysisDetails = analysisDetails($details->analyses_id, $item->categoryDetails->id, $item->productDetails->id);
			@endphp			
			<div class="card mb-3">
				<div class="card-body">
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label class="text-dark font-bold"><strong>@lang('custom_admin.label_category_name'):</strong></label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="text-dark font-bold"><strong>{!! $item->categoryDetails->title ?? 'NA' !!}</strong></label>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="text-dark font-bold"><strong>@lang('custom_admin.label_product_name'):</strong></label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="text-dark font-bold"><strong>{!! $item->productDetails->title ?? 'NA' !!}</strong></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_target_monthly_sales') (@lang('custom_admin.label_rs')):</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $analysisDetails->target_monthly_sales ?? 'NA' !!}</label>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_pack_size'):</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $item->productDetails->pack_size ?? 'NA' !!}</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_retailer_price'):</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $item->productDetails->retailer_price ? formatToTwoDecimalPlaces($item->productDetails->retailer_price) : 'NA' !!}</label>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_mrp'):</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $item->productDetails->mrp ? formatToTwoDecimalPlaces($item->productDetails->mrp) : 'NA' !!}</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_type_of_analysis'):</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $analysisDetails->type_of_analysis ?? 'NA' !!}</label>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_analysis_action'):</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $analysisDetails->action ?? 'NA' !!}</label>
							</div>
						</div>
					</div>

					<hr>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_order_qty'):</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $item->qty ?? 'NA' !!}</label>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_why'):</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $item->why ?? 'NA' !!}</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_result'):</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $item->result ?? 'NA' !!}</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			<div class="form-actions mt-4 mb-hide">
				<div class="float-left">
					<a class="btn btn-secondary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3" href="javascript: void(0);" onclick="window.close();">
						<i class="far fa-times-circle"></i> @lang('custom_admin.btn_close')
					</a>
				</div>
			</div>
		</div>
	</div>
	@endif

@endsection

@push('scripts')
@include($routePrefix.'.'.$pageRoute.'.scripts')
@endpush