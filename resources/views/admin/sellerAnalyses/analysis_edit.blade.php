@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

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
								<label class="text-dark font-bold"><strong>@lang('custom_admin.label_product_name')</strong></label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold"><strong>{!! $product->title ?? 'NA' !!}</strong></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_target_monthly_sales') (@lang('custom_admin.label_rs'))</label>
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
								<label class="text-dark font-bold">@lang('custom_admin.label_analysis_action')</label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $details->analysesDetails[0]->action ?? 'NA' !!}</label>
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
								<label class="text-dark font-bold">{!! $product->retailer_price ? formatToTwoDecimalPlaces($product->retailer_price) : 'NA' !!}</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="text-dark font-bold">@lang('custom_admin.label_mrp')</label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label class="text-dark font-bold">{!! $product->mrp ? formatToTwoDecimalPlaces($product->mrp) : 'NA' !!}</label>
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
					{{ Form::open([
						'method'=> 'POST',
						'class' => '',
						'route' => [$routePrefix.'.sellerAnalyses.analysis-update', $distributionAreaId, $beatId, $storeId, $categoryId, $productId],
						'name'  => 'updateSellerAnalysesForm',
						'id'    => 'updateSellerAnalysesForm',
						'files' => true,
						'novalidate' => true ]) }}
						<div class="form-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_order_qty')<span class="red_star">*</span></label>
										{{ Form::text('qty', null, [
                                                                'id' => 'qty',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => true ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_why')<span class="red_star">*</span></label>
										{{ Form::textarea('why', null, [
                                                                'id' => 'why',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => true,
																'rows' => 5 ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_result')<span class="red_star">*</span></label>
										{{ Form::textarea('result', null, [
                                                                'id' => 'result',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => true,
																'rows' => 5 ]) }}
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions mt-4">
							<div class="float-left">
								<a class="btn btn-secondary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3" href="{{ route($routePrefix.'.sellerAnalyses.product-list', [$distributionAreaId, $beatId, $storeId, $categoryId]) }}">
									<i class="far fa-arrow-alt-circle-left"></i> @lang('custom_admin.btn_cancel')
								</a>
							</div>
							<div class="float-right">
								<button type="submit" id="btn-processing" class="btn btn-primary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3">
									<i class="far fa-save" aria-hidden="true"></i> @lang('custom_admin.btn_submit')
								</button>
							</div>
						</div>
					{{ Form::close() }}
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