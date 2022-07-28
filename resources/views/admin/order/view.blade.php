@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $pageTitle }}</h4>
					<h3 class="mb-heading">{!! $details->distributionAreaDetails->title !!} - {!! $details->beatDetails->title !!} - {!! $details->storeDetails->name_1.' ('.$details->storeDetails->store_name.')' !!} - {!! $details->categoryDetails->title !!} - {!! $details->productDetails->title !!}</h3>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold"><strong>@lang('custom_admin.label_product_name'):</strong></label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold"><strong>{!! $details->productDetails->title ?? 'NA' !!}</strong></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_target_monthly_sales') (@lang('custom_admin.label_rs')):</label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $details->analysesDetails->target_monthly_sales ?? 'NA' !!}</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_type_of_analysis'):</label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $details->analysesDetails->type_of_analysis ?? 'NA' !!}</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_analysis_action'):</label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $details->analysesDetails->action ?? 'NA' !!}</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_pack_size'):</label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $details->productDetails->pack_size ?? 'NA' !!}</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_retailer_price'):</label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $details->productDetails->retailer_price ? formatToTwoDecimalPlaces($details->productDetails->retailer_price) : 'NA' !!}</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_mrp'):</label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $details->productDetails->mrp ? formatToTwoDecimalPlaces($details->productDetails->mrp) : 'NA' !!}</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold"><strong>@lang('custom_admin.label_seller'):</strong></label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold"><strong>{!! $details->sellerDetails->full_name.' ('.$details->sellerDetails->email.')' ?? 'NA' !!}</strong></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_order_qty'):</label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $details->qty ?? 'NA' !!}</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_why'):</label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $details->why ?? 'NA' !!}</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_result'):</label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $details->result ?? 'NA' !!}</label>
							</div>
						</div>
					</div>
					<div class="row mt-4 mb-hide">
						<div class="col-md-12">
							<a class="btn btn-secondary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3" href="javascript: void(0);" onclick="window.close();">
								<i class="fas fa-times-circle"></i> @lang('custom_admin.btn_close')
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@push('scripts')
@include($routePrefix.'.'.$pageRoute.'.scripts')
@endpush