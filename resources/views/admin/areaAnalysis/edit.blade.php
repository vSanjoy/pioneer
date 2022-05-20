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
						'name'  => 'updateStoreForm',
						'id'    => 'updateStoreForm',
						'files' => true,
						'novalidate' => true ]) }}
						<div class="form-body mt-4-5">
							<div class="row mt-1">
								<div class="col-md-12">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_distribution_area')<span class="red_star">*</span></label>
										<select name="distribution_area_id" id="distribution_area_id" class="form-control">
											<option value="">--@lang('custom_admin.label_select')--</option>
										@foreach ($distributionAreas as $item)
											<option value="{{ $item->id }}" @if ($details->distribution_area_id == $item->id)selected @endif>{!! $item->title !!}</option>
										@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_name') 1<span class="red_star">*</span></label>
										{{ Form::text('name_1', $details->name_1 ?? null, [
                                                                'id' => 'name_1',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => true ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_name') 2</label>
										{{ Form::text('name_2', $details->name_2 ?? null, [
                                                                'id' => 'name_2',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_store_name')<span class="red_star">*</span></label>
										{{ Form::text('store_name', $details->store_name ?? null, [
                                                                'id' => 'store_name',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => true ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_phone') 1</label>
										{{ Form::text('phone_no_1', $details->phone_no_1 ?? null, [
                                                                'id' => 'phone_no_1',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_whatsapp_no') 1</label>
										{{ Form::text('whatsapp_no_1', $details->whatsapp_no_1 ?? null, [
                                                                'id' => 'whatsapp_no_1',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_phone') 2</label>
										{{ Form::text('phone_no_2', $details->phone_no_2 ?? null, [
                                                                'id' => 'phone_no_2',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_whatsapp_no') 2</label>
										{{ Form::text('whatsapp_no_2', $details->whatsapp_no_2 ?? null, [
                                                                'id' => 'whatsapp_no_2',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_street')</label>
										{{ Form::textarea('street', $details->street ?? null, [
																		'id' => 'street',
																		'class' => 'form-control',
																		'placeholder' => '',
																		'rows' => 2 ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_district_region')</label>
										{{ Form::text('district_region', $details->district_region ?? null, [
																	'id' => 'district_region',
																	'class' => 'form-control',
																	'placeholder' => '' ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_zip_postal_code')</label>
										{{ Form::text('zip', $details->zip ?? null, [
																'id' => 'zip',
																'class' => 'form-control',
																'placeholder' => '' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_store_email')</label>
										{{ Form::text('email', $details->email ?? null, [
                                                                'id' => 'email',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_beat_name')</label>
										{{ Form::text('beat_name', $details->beat_name ?? null, [
																		'id' => 'beat_name',
																		'class' => 'form-control',
																		'placeholder' => '' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_sale_size_category')</label>
										<select name="sale_size_category" id="sale_size_category" class="form-control">
											<option value="">--@lang('custom_admin.label_select')--</option>
											<option value="S" @if ($details->sale_size_category == 'S')selected @endif>@lang('custom_admin.label_small')</option>
											<option value="M" @if ($details->sale_size_category == 'M')selected @endif>@lang('custom_admin.label_medium')</option>
											<option value="L" @if ($details->sale_size_category == 'L')selected @endif>@lang('custom_admin.label_large')</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_integrity')</label>
										<select name="integrity" id="integrity" class="form-control">
											<option value="">--@lang('custom_admin.label_select')--</option>
											<option value="A+" @if ($details->integrity == 'A+')selected @endif>A+</option>
											<option value="A" @if ($details->integrity == 'A')selected @endif>A</option>
											<option value="B" @if ($details->integrity == 'B')selected @endif>B</option>
											<option value="B-" @if ($details->integrity == 'B-')selected @endif>B-</option>
											<option value="C" @if ($details->integrity == 'C')selected @endif>C</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_notes')</label>
										{{ Form::textarea('notes', $details->notes ?? null, [
																							'id' => 'notes',
																							'placeholder' => '',
																							'class' => 'form-control',
																							'rows' => 3
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

@push('scripts')
@endpush