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
						'route' => [$routePrefix.'.'.$editUrl.'-submit', $id],
						'name'  => 'updateAreaAnalysisForm',
						'id'    => 'updateAreaAnalysisForm',
						'files' => true,
						'novalidate' => true ]) }}
						<div class="form-body mt-4-5">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_season')<span class="red_star">*</span></label>
										<select name="season_id" id="season_id" class="form-control">
											<option value="">--@lang('custom_admin.label_select')--</option>
										@foreach ($seasons as $season)
											<option value="{{ $season -> id }}" @if ( $details -> season_id == $season -> id) selected @endif >
												{!! $season -> title !!}
											</option>
										@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_year')<span class="red_star">*</span></label>
										<select name="year" id="year" class="form-control">
											<option value="">--@lang('custom_admin.label_select')--</option>
										@for ($i = date('Y'); $i >= 2022; $i--)
											<option value="{{ $i }}" @if ($i == $details->year)selected @endif>{!! $i !!}</option>
										@endfor
										</select>
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_analysis_date')<span class="red_star">*</span></label>
										{{ Form::text('analysis_date', date('m/d/Y', strtotime($details->analysis_date)),[
												'id' => 'analysis_date', 
												'class' => 'form-control date', 
												'placeholder' => '', 
												'required' => true 
											]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group" id="distribution_area-div">
										<label class="text-dark font-bold">@lang('custom_admin.label_distribution_area')<span class="red_star">*</span></label>
										<select name="distribution_area_id" id="distribution_area_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
											<option value="">--@lang('custom_admin.label_select')--</option>
										@foreach ($distributionAreas as $distributionArea)
											<option value="{{ $distributionArea -> id }}" @if ($distributionArea -> id == $details -> distribution_area_id) selected @endif >
												{!! $distributionArea -> title !!}
											</option>
										@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group" id="distributor_id-div">
										<label class="text-dark font-bold">@lang('custom_admin.label_distributor')<span class="red_star">*</span></label>
										<select name="distributor_id" id="distributor_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
											<option value="">--@lang('custom_admin.label_select')--</option>
											@foreach ($distributors as $distributor)
												<option value="{{ $distributor -> id }}"  @if ($distributor -> id == $details -> distributor_id) selected @endif>
													{{ $distributor -> first_name }}
												</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group" id="store_id-div">
										<label class="text-dark font-bold">@lang('custom_admin.label_store')<span class="red_star">*</span></label>
										<select name="store_id" id="store_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
											<option value="">--@lang('custom_admin.label_select')--</option>
											@foreach ($stores as $store)
												<option value="{{ $store -> id }}" @if ( $store -> id == $details -> store_id ) selected @endif >
													{{ $store -> store_name }}
												</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group" id="category_id-div">
										<label class="text-dark font-bold">@lang('custom_admin.label_category')<span class="red_star">*</span></label>
										<select name="category_id" id="category_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
											<option value="">--@lang('custom_admin.label_select')--</option>
										@foreach ($categories as $category)
											<option value="{{ $category -> id }}" @if ( $category -> id == $details -> category_id ) selected @endif>
												{!! $category -> title !!}
											</option>
										@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group" id="product_id-div">
										<label class="text-dark font-bold">@lang('custom_admin.label_product')<span class="red_star">*</span></label>
										<select name="product_id" id="product_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
											<option value="">--@lang('custom_admin.label_select')--</option>
											@foreach ($products as $product)
												<option value="{{ $product -> id }}" @if ( $product -> id == $details -> product_id ) selected @endif>
													{!! $product -> title !!}
												</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_target_monthly_sales') (@lang('custom_admin.label_rs'))<span class="red_star">*</span></label>
										{{ Form::text('target_monthly_sales', $details -> target_monthly_sales, [
                                                                'id' => 'target_monthly_sales',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => true ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_type_of_analysis')<span class="red_star">*</span></label>
										{{ Form::textarea('type_of_analysis', $details -> type_of_analysis, [
                                                                'id' => 'type_of_analysis',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => true,
																'rows' => 2 ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_analysis_action')<span class="red_star">*</span></label>
										{{ Form::textarea('action', $details -> action, [
                                                                'id' => 'action',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => true,
																'rows' => 2 ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_result')<span class="red_star">*</span></label>
										{{ Form::textarea('result', $details -> result, [
                                                                'id' => 'result',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => true,
																'rows' => 2 ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_why')<span class="red_star">*</span></label>
										{{ Form::textarea('why', $details -> why, [
                                                                'id' => 'why',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => true,
																'rows' => 2 ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_comment')<span class="red_star">*</span></label>
										{{ Form::textarea('comment', $details ->  comment, [
                                                                'id' => 'comment',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => true,
																'rows' => 2 ]) }}
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions mt-4">
							<div class="float-left">
								<a class="btn btn-secondary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3" href="{{ route($routePrefix.'.'.$listUrl) }}">
									<i class="far fa-arrow-alt-circle-left"></i> @lang('custom_admin.btn_cancel')
								</a>
							</div>
							<div class="float-right">
								<button type="submit" id="btn-processing" class="btn btn-primary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3">
									<i class="far fa-save" aria-hidden="true"></i> @lang('custom_admin.btn_update')
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