@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $pageTitle }}</h4>
					<h3>{!! $distributionArea->title !!} - {!! $beat->title !!} - {!! $store->name_1.' ('.$store->store_name.')' !!} - {!! $season->title.' ('.$season->year.')' !!}</h3>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
		{{ Form::open([
			'method'=> 'POST',
			'class' => '',
			'route' => [$routePrefix.'.singleStepSellerAnalyses.analysis-update', $distributionAreaId, $beatId, $storeId, $seasonId],
			'name'  => 'updateSingleStepSellerAnalysesForm',
			'id'    => 'updateSingleStepSellerAnalysesForm',
			'files' => true,
			'novalidate' => true ]) }}
			<div id="accordion" class="custom-accordion mb-4">
				@php $i = 1; @endphp
				@foreach ($categories as $category)
				<div class="card mb-2">
					<div class="card-header bg-white" id="heading_{{$i}}">
						<h5 class="m-0">
							<a class="custom-accordion-title d-block pt-2 pb-2" data-toggle="collapse" href="#collapse_{{$i}}" @if ($i == 1) aria-expanded="true" @else aria-expanded="false" @endif aria-controls="collapse_{{$i}}">
								{!! $category->title !!} <span class="float-right"></span>
							</a>
						</h5>
					</div>
					<div id="collapse_{{$i}}" class="collapse accordion-border-top @if ($i == 1)show @endif" aria-labelledby="heading_{{$i}}" data-parent="#accordion">
						<div class="card-body">

							<div id="accordion_{{$i}}" class="custom-accordion mb-4">
							@php $k = 1; @endphp
							@foreach ($category->products as $product)
								@php
								$categoryId = $category->id;
								$productId	= $product->id;
								$analysisDetails = getAnalysisDetails($distributionAreaId, $beatId, $storeId, $seasonId, $categoryId, $productId);
								@endphp
								<div class="card mb-3">
									<div class="card-header" id="headingOne_{{$productId}}">
										<h5 class="m-0">
											<a class="custom-accordion-title d-block pt-2 pb-2" data-toggle="collapse" href="#collapseProduct_{{$productId}}" aria-expanded="true" aria-controls="collapseProduct_{{$productId}}">
												{!! $product->title !!} <span class="float-right"></span>
											</a>
										</h5>
									</div>
									<div id="collapseProduct_{{$productId}}" class="collapse accordion-border-top @if ($k == 1)show @endif" aria-labelledby="headingOne_{{$productId}}" data-parent="#accordion_{{$i}}">
										<div class="card-body">
											{{-- Start :: Display Analysis Data --}}
											<div class="row">
												<div class="col-md-2">
													<div class="form-group">
														<label class="text-dark font-bold">@lang('custom_admin.label_target_monthly_sales') (@lang('custom_admin.label_rs')):</label>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="text-dark font-bold">{!! $analysisDetails->analysesDetails[0]->target_monthly_sales ?? 'NA' !!}</label>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label class="text-dark font-bold">@lang('custom_admin.label_pack_size'):</label>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="text-dark font-bold">{!! $product->pack_size ?? 'NA' !!}</label>
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
														<label class="text-dark font-bold">{!! $product->retailer_price ? formatToTwoDecimalPlaces($product->retailer_price) : 'NA' !!}</label>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label class="text-dark font-bold">@lang('custom_admin.label_mrp'):</label>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="text-dark font-bold">{!! $product->mrp ? formatToTwoDecimalPlaces($product->mrp) : 'NA' !!}</label>
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
														<label class="text-dark font-bold">{!! $analysisDetails->analysesDetails[0]->type_of_analysis ?? 'NA' !!}</label>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label class="text-dark font-bold">@lang('custom_admin.label_analysis_action'):</label>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="text-dark font-bold">{!! $analysisDetails->analysesDetails[0]->action ?? 'NA' !!}</label>
													</div>
												</div>
											</div>
											{{-- End :: Display Analysis Data --}}

											{{-- Start :: Analysis fields --}}
											{{ Form::hidden('analysis['.$categoryId.']['.$productId.'][category_id]', $categoryId) }}
											{{ Form::hidden('analysis['.$categoryId.']['.$productId.'][product_id]', $productId) }}
											<div class="row mt-2">
												<div class="col-md-6">
													<div class="form-group">
														<label class="text-dark font-bold">@lang('custom_admin.label_order_qty')</label>
														{{ Form::text('analysis['.$categoryId.']['.$productId.'][qty]', null, [
																				'class' => 'form-control',
																				'placeholder' => '' ]) }}
													</div>
												</div>
											</div>
											<div class="row mt-1">
												<div class="col-md-6">
													<div class="form-group">
														<label class="text-dark font-bold">@lang('custom_admin.label_why')</label>
														{{ Form::textarea('analysis['.$categoryId.']['.$productId.'][why]', null, [
																				'class' => 'form-control',
																				'placeholder' => '',
																				'rows' => 5 ]) }}
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="text-dark font-bold">@lang('custom_admin.label_result')</label>
														{{ Form::textarea('analysis['.$categoryId.']['.$productId.'][result]', null, [
																				'class' => 'form-control',
																				'placeholder' => '',
																				'rows' => 5 ]) }}
													</div>
												</div>
											</div>
											{{-- End :: Analysis fields --}}

										</div>
									</div>
								</div> <!-- end card-->
								@php $k++; @endphp
							@endforeach
							</div> <!-- end custom accordions-->
							
						</div>
					</div>
				</div>
					@php $i++; @endphp
				@endforeach
			</div> <!-- end custom accordions-->

			<div class="form-actions mt-4">
				<div class="float-right">
					<button type="submit" id="btn-processing" class="btn btn-primary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3">
						<i class="far fa-save" aria-hidden="true"></i> @lang('custom_admin.btn_submit')
					</button>
				</div>
			</div>
		{{ Form::close() }}


		</div> <!-- end col -->
	</div>	

@endsection

@push('scripts')
@include($routePrefix.'.'.$pageRoute.'.scripts')
@endpush