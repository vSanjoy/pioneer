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
						'name'  => 'updateRoleAssignmentForm',
						'id'    => 'updateRoleAssignmentForm',
						'files' => true,
						'novalidate' => true ]) }}
						<div class="form-body mt-4-5">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_distributor')/@lang('custom_admin.label_seller')<span class="red_star">*</span></label>
										<select name="distributor_id" id="distributor_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true" disabled>
											<option value="">--@lang('custom_admin.label_select')--</option>
										@foreach ($userList as $user)
											<option value="{{ $user->id }}" @if ($details->id == $user->id)selected @endif>{!! $user->full_name.' ('.$user->email.')' !!}</option>
										@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_role')<span class="red_star">*</span></label>
										<select class="form-control select2" id="role" name="role[]" multiple="multiple">
									@if (count($roleList) > 0)
										@foreach ($roleList as $role)
											<option value="{{$role->id}}" @if(in_array($role->id,$selectedRoles) || in_array($role->id, $roleIds))selected @endif>{{$role->name}}</option>
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