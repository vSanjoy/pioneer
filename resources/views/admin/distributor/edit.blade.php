@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	@php
	$selectedRoles = old('role');
	if ($selectedRoles == null) $selectedRoles = [];
	@endphp

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $pageTitle }}</h4>
					{{ Form::open([
						'method'=> 'POST',
						'class' => '',
						'route' => [$routePrefix.'.'.$editUrl.'-submit', $id],
						'name'  => 'updateDistributorForm',
						'id'    => 'updateDistributorForm',
						'files' => true,
						'novalidate' => true ]) }}
						<div class="form-body mt-4-5">
							<div class="row mt-1">
								<div class="col-md-12">
									<div class="form-group" id="distribution-area-div">
										<label class="text-dark font-bold">@lang('custom_admin.label_distribution_area')<span class="red_star">*</span></label>
										<select name="distribution_area_id" id="distribution_area_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true" required>
											<option value="">--@lang('custom_admin.label_select')--</option>
										@foreach ($distributionAreas as $item)
											<option value="{{ $item->id }}" @if ($details->distribution_area_id == $item->id)selected @endif>{!! $item->title !!}</option>
										@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_job_title_1')<span class="red_star">*</span></label>
										{{ Form::text('job_title_1', $details->job_title_1 ?? null, [
                                                                'id' => 'job_title_1',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => 'required' ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_name') 1<span class="red_star">*</span></label>
										{{ Form::text('full_name', $details->full_name ?? null, [
                                                                'id' => 'full_name',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => 'required' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_job_title_2')</label>
										{{ Form::text('job_title_2', $details->userDetails->job_title_2 ?? null, [
                                                                'id' => 'job_title_2',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_name') 2</label>
										{{ Form::text('full_name_2', $details->userDetails->full_name_2 ?? null, [
                                                                'id' => 'full_name_2',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_company')<span class="red_star">*</span></label>
										{{ Form::text('company', $details->company ?? null, [
                                                                'id' => 'company',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
																'required' => true ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_phone') 1</label>
										{{ Form::text('phone_no', $details->phone_no ?? null, [
                                                                'id' => 'phone_no',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_phone') 2</label>
										{{ Form::text('phone_no_2', $details->userDetails->phone_no_2 ?? null, [
                                                                'id' => 'phone_no_2',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_whatsapp_no')</label>
										{{ Form::text('whatsapp_no', $details->userDetails->whatsapp_no ?? null, [
                                                                'id' => 'whatsapp_no',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_street')</label>
										{{ Form::textarea('street', $details->userDetails->street ?? null, [
																		'id' => 'street',
																		'class' => 'form-control',
																		'placeholder' => '',
																		'rows' => 2 ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_city')</label>
										{{ Form::text('city', $details->userDetails->city ?? null, [
																'id' => 'city',
																'class' => 'form-control',
																'placeholder' => '' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_district_region')</label>
										{{ Form::text('district_region', $details->userDetails->district_region ?? null, [
																	'id' => 'district_region',
																	'class' => 'form-control',
																	'placeholder' => '' ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_state_province')</label>
										{{ Form::text('state_province', $details->userDetails->state_province ?? null, [
																'id' => 'state_province',
																'class' => 'form-control',
																'placeholder' => '' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_zip_postal_code')</label>
										{{ Form::text('zip', $details->userDetails->zip ?? null, [
																'id' => 'zip',
																'class' => 'form-control',
																'placeholder' => '' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_username')<span class="red_star">*</span></label>
										{{ Form::text('username', $details -> username, [
                                                                'id' => 'username',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => 'required' ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_email')<span class="red_star">*</span></label>
										{{ Form::text('email', $details->email ?? null, [
                                                                'id' => 'email',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => 'required' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_notes')</label>
										{{ Form::textarea('notes', $details->userDetails->notes ?? null, [
																		'id' => 'notes',
																		'placeholder' => '',
																		'class' => 'form-control',
																		'rows' => 3
																	]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label class="text-dark font-bold">@lang('custom_admin.label_image')</label>
												{{ Form::file('profile_pic', [
																		'id' => 'profile_pic',
																		'class' => 'form-control upload-image',
																		'placeholder' => 'Upload Image',
																	]) }}
											</div>
										</div>
										<div class="col-md-4">
											<div class="preview_img_div_profile_pic">
												<img id="profile_pic_preview" class="mt-2" style="display: none;" />
											@if ($details->profile_pic != null)
												@if (file_exists(public_path('/images/uploads/'.$pageRoute.'/'.$details->profile_pic)))
													<div class="image-preview-holder" id="image_holder_profile_pic">
														<a data-fancybox="gallery" href="{{ asset('images/uploads/'.$pageRoute.'/'.$details->profile_pic) }}">
															<img class="image-preview-border" id="image_preview mt-2" src="{{ asset('images/uploads/'.$pageRoute.'/'.$details->profile_pic) }}" width="170" height="" />
														</a>														
														{{-- <span class="delete-preview-image delete-uploaded-preview-image" data-primaryid="{{ $id }}" data-imageid="image_preview" data-dbfield="image" data-routeprefix="{{ $pageRoute }}"><i class="fa fa-trash"></i></span> --}}
													</div>
												@endif												
											@endif
											</div>
										</div>
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
@include($routePrefix.'.includes.image_preview')
@endpush