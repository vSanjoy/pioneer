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
						'route' => [$routePrefix.'.'.$addUrl.'-submit'],
						'name'  => 'createAreaAnalysisForm',
						'id'    => 'createAreaAnalysisForm',
						'files' => true,
						'novalidate' => true ]) }}
						<div class="form-body mt-4-5">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_season')<span class="red_star">*</span></label>
										<select name="season_id" id="season_id" class="form-control">
											<option value="">--@lang('custom_admin.label_select')--</option>
										@foreach ($seasons as $item)
											<option value="{{ $item->id }}">{!! $item->title !!}</option>
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
											<option value="{{ $i }}" @if ($i == date('Y'))selected @endif>{!! $i !!}</option>
										@endfor
										</select>
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_analysis_date')<span class="red_star">*</span></label>
										{{ Form::text('analysis"_date', null, [
                                                                'id' => 'analysis"_date',
                                                                'class' => 'form-control date',
                                                                'placeholder' => '',
                                                                'required' => true ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_distribution_area')<span class="red_star">*</span></label>
										<select name="distribution_area_id" id="distribution_area_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
											<option value="">--@lang('custom_admin.label_select')--</option>
										@foreach ($distributionAreas as $item)
											<option value="{{ $item->id }}">{!! $item->title !!}</option>
										@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_distributor')<span class="red_star">*</span></label>
										<select name="distributor_id" id="distributor_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
											<option value="">--@lang('custom_admin.label_select')--</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_store')<span class="red_star">*</span></label>
										<select name="store_id" id="store_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
											<option value="">--@lang('custom_admin.label_select')--</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_category')<span class="red_star">*</span></label>
										<select name="category_id" id="category_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
											<option value="">--@lang('custom_admin.label_select')--</option>
										@foreach ($categories as $item)
											<option value="{{ $item->id }}">{!! $item->title !!}</option>
										@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_product')<span class="red_star">*</span></label>
										<select name="product_id" id="product_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
											<option value="">--@lang('custom_admin.label_select')--</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_target_monthly_sales')<span class="red_star">*</span></label>
										{{ Form::text('target_monthly_sales', null, [
                                                                'id' => 'target_monthly_sales',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => true ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_type_of_analysis')<span class="red_star">*</span></label>
										{{ Form::textarea('type_of_analysis', null, [
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
										{{ Form::textarea('action', null, [
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
										{{ Form::textarea('result', null, [
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
										{{ Form::textarea('why', null, [
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
										{{ Form::textarea('comment', null, [
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