@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $pageTitle }}</h4>
					{{ Form::open([
						'method'=> 'POST',
						'class' => '',
						'route' => [$routePrefix.'.'.$addUrl.'-submit', $areaAnalysisId],
						'name'  => 'createAnalysesForm',
						'id'    => 'createAnalysesForm',
						'files' => true,
						'novalidate' => true ]) }}
						<div class="form-header mt-4-5">
							@php
							$season = $distributionArea = $distributor = $store = $category = $product = 'NA';
							if ($areaAnalysis->seasonDetails !== NULL) { $season = $areaAnalysis->seasonDetails->title; }
							if ($areaAnalysis->distributionAreaDetails !== NULL) { $distributionArea = $areaAnalysis->distributionAreaDetails->title; }
							if ($areaAnalysis->distributorDetails !== NULL) { $distributor = $areaAnalysis->distributorDetails->full_name; }
							if ($areaAnalysis->storeDetails !== NULL) { $store = $areaAnalysis->storeDetails->store_name; }
							if ($areaAnalysis->categoryDetails !== NULL) { $category = $areaAnalysis->categoryDetails->title; }
							if ($areaAnalysis->productDetails !== NULL) { $product = $areaAnalysis->productDetails->title; }
							@endphp

							<table class="table table-hover">
								<tbody id="analysis-data">
									<tr>
										<td><strong>@lang('custom_admin.label_season'):</strong></td>
										<td>{!! $season !!}</td>
										<td><strong>@lang('custom_admin.label_year'):</td>
										<td>{!! $areaAnalysis->year !!}</td>
									</tr>
									<tr>
										<td><strong>@lang('custom_admin.label_analysis_date'):</strong></td>
										<td>{!! changeDateFormat($areaAnalysis->analysis_date, 'd-m-Y') !!}</td>
										<td><strong>@lang('custom_admin.label_distribution_area'):</strong></td>
										<td>{!! $distributionArea !!}</td>
									</tr>
									<tr>
										<td><strong>@lang('custom_admin.label_distributor'):</strong></td>
										<td>{!! $distributor !!}</td>
										<td><strong>@lang('custom_admin.label_store'):</strong></td>
										<td>{!! $store !!}</td>
									</tr>
									<tr>
										<td><strong>@lang('custom_admin.label_category'):</strong></td>
										<td>{!! $category !!}</td>
										<td><strong>@lang('custom_admin.label_product'):</strong></td>
										<td>{!! $product !!}</td>
									</tr>
									<tr>
										<td><strong>@lang('custom_admin.label_target_monthly_sales') (@lang('custom_admin.label_rs')):</strong></td>
										<td>{!! $areaAnalysis->target_monthly_sales !!}</td>
										<td><strong>@lang('custom_admin.label_type_of_analysis'):</strong></td>
										<td>{!! $areaAnalysis->type_of_analysis !!}</td>
									</tr>
									<tr>
										<td><strong>@lang('custom_admin.label_analysis_action'):</strong></td>
										<td>{!! $areaAnalysis->action !!}</td>
										<td><strong>@lang('custom_admin.label_result'):</strong></td>
										<td>{!! $areaAnalysis->result !!}</td>
									</tr>
									<tr>
										<td><strong>@lang('custom_admin.label_why'):</strong></td>
										<td>{!! $areaAnalysis->why !!}</td>
										<td><strong>@lang('custom_admin.label_comment'):</strong></td>
										<td>{!! $areaAnalysis->comment !!}</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="form-body mt-4-5">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_result')<span class="red_star">*</span></label>
										{{ Form::textarea('result', null, [
                                                                'id' => 'result',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => true,
																]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_why')<span class="red_star">*</span></label>
										{{ Form::textarea('why', null, [
                                                                'id' => 'why',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => true,
																]) }}
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions mt-4">
							<div class="float-left">
								<a class="btn btn-secondary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3" href="{{ route($routePrefix.'.'.$detailsListUrl, $areaAnalysisId) }}">
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

@endsection

@push('scripts')
@include($routePrefix.'.'.$pageRoute.'.scripts')
@endpush