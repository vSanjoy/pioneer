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
						'name'  => 'createSellerForm',
						'id'    => 'createSellerForm',
						'files' => true,
						'novalidate' => true ]) }}
						<div class="form-body mt-4-5">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_name')<span class="red_star">*</span></label>
										{{ Form::text('full_name', null, [
                                                                'id' => 'full_name',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => 'required' ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_phone')</label>
										{{ Form::text('phone_no', null, [
                                                                'id' => 'phone_no',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_whatsapp_no')</label>
										{{ Form::text('whatsapp_no', null, [
                                                                'id' => 'whatsapp_no',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_street')</label>
										{{ Form::textarea('street', null, [
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
										<label class="text-dark font-bold">@lang('custom_admin.label_city')</label>
										{{ Form::text('city', null, [
																'id' => 'city',
																'class' => 'form-control',
																'placeholder' => '' ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_district_region')</label>
										{{ Form::text('district_region', null, [
																	'id' => 'district_region',
																	'class' => 'form-control',
																	'placeholder' => '' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_state_province')</label>
										{{ Form::text('state_province', null, [
																'id' => 'state_province',
																'class' => 'form-control',
																'placeholder' => '' ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_zip_postal_code')</label>
										{{ Form::text('zip', null, [
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
										{{ Form::text('username', null, ['id' => 'username','class' => 'form-control','placeholder' => '' ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_email')<span class="red_star">*</span></label>
										{{ Form::text('email', null, [
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
										<label class="text-dark font-bold">@lang('custom_admin.label_new_password')<span class="red_star">*</span></label>
										{{ Form::password('password',array(
																		'id' => 'password',
																		'class' => 'form-control password-checker',
																		'data-pcid'	=> 'new-password-checker',
																		'placeholder' => '',
																		'required' => 'required' )) }}
									</div>
									<div class="progress" id="new-password-checker">
										<div class="progress" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_confirm_password')<span class="red_star">*</span></label>
										{{ Form::password('confirm_password', array(
																				'id' => 'confirm_password',
																				'class' => 'form-control',
																				'placeholder' => '',
																				'required' => 'required' )) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
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
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row mt-1" id="all_distribution_area_div">
								<div class="col-md-12">
									<div class="form-group">
										<label class="text-dark font-bold">Distribution Area<span class="red_star">*</span></label>
										<select multiple class="selectpicker form-control" id="distribution_area_ids" name="distribution_area_ids[]" data-container="body" data-live-search="true" title="--@lang('custom_admin.label_select')--" data-hide-disabled="true" data-actions-box="true" data-virtual-scroll="false" required>
									@if (count($distributionAreas))
										@foreach ($distributionAreas as $keyDistributionArea => $valDistributionArea)
											<option value="{{ $valDistributionArea->id }}">{!! $valDistributionArea->title !!}</option>
										@endforeach
									@endif
										</select>
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
@include($routePrefix.'.includes.image_preview')
@endpush