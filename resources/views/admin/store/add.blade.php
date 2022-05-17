@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	@php $selectedSerIds = old('service_ids') ?? []; @endphp

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $pageTitle }}</h4>
					{{ Form::open([
						'method'=> 'POST',
						'class' => '',
						'route' => [$routePrefix.'.'.$addUrl.'-submit'],
						'name'  => 'createStoreForm',
						'id'    => 'createStoreForm',
						'files' => true,
						'novalidate' => true ]) }}
						<div class="form-body mt-4-5">
							<div class="row mt-1">
								<div class="col-md-12">
									<div class="form-group">
										<label class="text-dark font-bold">Distributor<span class="red_star">*</span></label>
										<select name="distribution_area_id" id="distribution_area_id" class="form-control">
											<option value="">--Select--</option>
										@foreach ($distributionAreas as $item)
											<option value="{{ $item->id }}">{!! $item->title !!}</option>
										@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">Name 1<span class="red_star">*</span></label>
										{{ Form::text('name_1', null, [
                                                                'id' => 'name_1',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => true ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_name') 2</label>
										{{ Form::text('name_2', null, [
                                                                'id' => 'name_2',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">Store Name</label>
										{{ Form::text('store_name', null, [
                                                                'id' => 'store_name',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => true ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">Phone 1</label>
										{{ Form::text('phone_no_1', null, [
                                                                'id' => 'phone_no_1',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">WhatsApp 1</label>
										{{ Form::text('whatsapp_no_1', null, [
                                                                'id' => 'whatsapp_no_1',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">Phone 2</label>
										{{ Form::text('phone_no_2', null, [
                                                                'id' => 'phone_no_2',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">WhatsApp 2</label>
										{{ Form::text('whatsapp_no_2', null, [
                                                                'id' => 'whatsapp_no_2',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">Street</label>
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
										<label class="text-dark font-bold">District/Region</label>
										{{ Form::text('district_region', null, [
																	'id' => 'district_region',
																	'class' => 'form-control',
																	'placeholder' => '' ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">Zip/Postal Code</label>
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
										<label class="text-dark font-bold">Store Email</label>
										{{ Form::text('email', null, [
                                                                'id' => 'email',
                                                                'class' => 'form-control',
                                                                'placeholder' => '' ]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">Beat Name</label>
										{{ Form::text('beat_name', null, [
																		'id' => 'beat_name',
																		'class' => 'form-control',
																		'placeholder' => '' ]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">Sale Size Category</label>
										<select name="sale_size_category" id="sale_size_category" class="form-control">
											<option value="">--Select--</option>
											<option value="S">Small</option>
											<option value="M">Medium</option>
											<option value="L">Large</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">Integrity</label>
										<select name="integrity" id="integrity" class="form-control">
											<option value="">--Select--</option>
											<option value="A+">A+</option>
											<option value="A">A</option>
											<option value="B">B</option>
											<option value="B-">B-</option>
											<option value="C">C</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">Notes</label>
										{{ Form::textarea('notes', null, [
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
@endpush