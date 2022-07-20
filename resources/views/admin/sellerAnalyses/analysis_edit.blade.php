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
					<h3>{!! $distributionArea->title !!} - {!! $beat->title !!} - {!! $store->name_1.' ('.$store->store_name.')' !!} - {!! $category->title !!}</h3>
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

{{-- @if ($categories->count())
	@foreach ($categories as $category)
		@php $categoryId = $category->id; @endphp
		@if ($category->products->count())
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">{!! $category->title !!}</h4>
						<button type="button" class="btn search-toggle-icon toggleCategoryhBox" id="toggleCategoryhBox_{{$categoryId}}" data-catid="{{$categoryId}}">
							<i class="fas fa-plus" id="plus_{{$categoryId}}" data-ctoggle="1" style="display: none;"></i>
							<i class="fas fa-minus" id="minus_{{$categoryId}}" data-ctoggle="0"></i>
						</button>
						<div class="mt-4" id="showFilterStatus_{{$categoryId}}">
							<div class="form-body">
								@foreach ($category->products as $product)
									@php
									$productId			= $product->id;
									$analysisDetailsId	= $analysisValues[$categoryId][$productId]['analyses_details_id'] ?? null;
									@endphp
								<div class="row">
									<div class="col-md-12">
										<label class="text-dark font-bold">{!! $product->title !!}</label>
										<input type="hidden" name="analyses[{{$categoryId}}][products][{{$productId}}][category_id]" value="{{$categoryId}}" />
										<input type="hidden" name="analyses[{{$categoryId}}][products][{{$productId}}][id]" value="{{$productId}}" />
										<input type="hidden" name="analyses[{{$categoryId}}][products][{{$productId}}][analyses_details_id]" value="{{$analysisDetailsId}}" />
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											{{ Form::text('analyses['.$categoryId.'][products]['.$productId.'][target_monthly_sales]', $analysisValues[$categoryId][$productId]['target_monthly_sales'] ?? null, [
																	'class' => 'form-control',
																	'placeholder' => trans('custom_admin.label_target_monthly_sales').' ('.trans('custom_admin.label_rs').')'
																	]) }}
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											{{ Form::textarea('analyses['.$categoryId.'][products]['.$productId.'][type_of_analysis]', $analysisValues[$categoryId][$productId]['type_of_analysis'] ?? null, [
																	'class' => 'form-control',
																	'placeholder' => trans('custom_admin.label_type_of_analysis'),
																	'rows' => 2 ]) }}
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											{{ Form::textarea('analyses['.$categoryId.'][products]['.$productId.'][action]', $analysisValues[$categoryId][$productId]['action'] ?? null, [
																	'class' => 'form-control',
																	'placeholder' => trans('custom_admin.label_analysis_action'),
																	'rows' => 2 ]) }}
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
	@endforeach
@endif --}}

	{{ Form::close() }}

@endsection

@push('scripts')
@include($routePrefix.'.'.$pageRoute.'.scripts')
@endpush