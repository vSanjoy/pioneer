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
						'name'  => 'updateProductForm',
						'id'    => 'updateProductForm',
						'files' => true,
						'novalidate' => true ]) }}
						<div class="form-body mt-4-5">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group" id="category-div">
										<label class="text-dark font-bold">@lang('custom_admin.label_category')<span class="red_star">*</span></label>
										<select name="category_id" id="category_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
											<option value="">--@lang('custom_admin.label_select')--</option>
										@foreach ($categories as $item)
											<option value="{{ $item->id }}" @if ($details->category_id == $item->id)selected @endif>{!! $item->title !!}</option>
										@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_title')<span class="red_star">*</span></label>
										{{ Form::text('title', $details->title ?? null, [
																		'id' => 'title',
																		'placeholder' => '',
																		'class' => 'form-control',
																		'required' => true,
																	]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group" id="grade-div">
										<label class="text-dark font-bold">@lang('custom_admin.label_grade_name')</label>
										<select name="grade_id" id="grade_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
											<option value="">--@lang('custom_admin.label_select')--</option>
										@foreach ($grades as $item)
											<option value="{{ $item->id }}" @if ($item->id == $details->grade_id)selected @endif>{!! $item->title !!}</option>
										@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_pack_size')</label>
										{{ Form::text('pack_size', $details->pack_size ?? null, [
																		'id' => 'pack_size',
																		'placeholder' => '',
																		'class' => 'form-control',
																	]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_rate_per_pcs')<span class="red_star">*</span></label>
										{{ Form::text('rate_per_pcs', $details->rate_per_pcs ? formatToTwoDecimalPlaces($details->rate_per_pcs) : null, [
																		'id' => 'rate_per_pcs',
																		'placeholder' => '',
																		'class' => 'form-control',
																		'required' => true,
																	]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_mrp')</label>
										{{ Form::text('mrp', $details->mrp ? formatToTwoDecimalPlaces($details->mrp) : null, [
																	'id' => 'mrp',
																	'placeholder' => '',
																	'class' => 'form-control',
																]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_retailer_price')<span class="red_star">*</span></label>
										{{ Form::text('retailer_price', $details->retailer_price ? formatToTwoDecimalPlaces($details->retailer_price) : null, [
																		'id' => 'retailer_price',
																		'placeholder' => '',
																		'class' => 'form-control',
																		'required' => true,
																	]) }}
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