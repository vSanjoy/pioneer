@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	{{ Form::open([
			'method'=> 'POST',
			'class' => '',
			'route' => [$routePrefix.'.analysisSeason.analysis-update', $distributionAreaId, $beatId, $storeId, $categoryId, $productId],
			'name'  => 'updateSellerAnalysesForm',
			'id'    => 'updateSellerAnalysesForm',
			'files' => true,
			'novalidate' => true ]) }}
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $pageTitle }}</h4>
					<h3>{!! $distributionArea->title !!} - {!! $beat->title !!} - {!! $store->name_1.' ('.$store->store_name.')' !!} - {!! $category->title !!} - {!! $product->title !!}</h3>
				</div>
			</div>
		</div>
	</div>

	@if ($details != null)
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_analysis_date')</label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $details != null ? changeDateFormat($details->analysis_date, 'm/d/Y') : 'NA' !!}</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_product_name')</label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $product->title ?? 'NA' !!}</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_target_monthly_sales')</label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $details->analysesDetails[0]->target_monthly_sales ?? 'NA' !!}</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_type_of_analysis')</label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $details->analysesDetails[0]->type_of_analysis ?? 'NA' !!}</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_pack_size')</label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $product->pack_size ?? 'NA' !!}</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_retailer_price')</label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $product->retailer_price ? formatToTwoDecimalPlaces($product->rate_per_pcs) : 'NA' !!}</label>
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
					<div class="form-body mt-4-5">
						<div class="row">
							
						</div>
					</div>
					<div class="form-actions mt-4">
						<div class="float-left">
							<a class="btn btn-secondary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3" href="{{ route($routePrefix.'.sellerAnalyses.product-list', [$distributionAreaId, $beatId, $storeId, $categoryId, $productId]) }}">
								<i class="far fa-arrow-alt-circle-left"></i> @lang('custom_admin.btn_cancel')
							</a>
						</div>
						<div class="float-right">
							<button type="submit" id="btn-processing" class="btn btn-primary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3">
								<i class="far fa-save" aria-hidden="true"></i> @lang('custom_admin.btn_update')
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@else
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.message_no_analysis_found')</label>
							</div>
						</div>
					</div>
					<div class="form-actions mt-4">
						<div class="float-left">
							<a class="btn btn-secondary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3" href="{{ route($routePrefix.'.sellerAnalyses.product-list', [$distributionAreaId, $beatId, $storeId, $categoryId]) }}">
								<i class="far fa-arrow-alt-circle-left"></i> @lang('custom_admin.btn_back')
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif

@endsection

@push('scripts')
@include($routePrefix.'.'.$pageRoute.'.scripts')
@endpush