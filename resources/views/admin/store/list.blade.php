@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

@if (\Auth::guard('admin')->user()->type == 'SA')
	@include($routePrefix.'.includes.filter_for_store')
@endif

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $pageTitle }}</h4>					
					<div class="table-responsive mt-4-5">
						<table id="list-table" class="table table-striped table-bordered no-wrap list-data custom-table custom-table-second-column">
							<thead>
								<tr>
								@if ($isAllow || in_array($statusUrl, $allowedRoutes) || in_array($deleteUrl, $allowedRoutes))
									<th class="firstColumn">
										<div class="btn-group">
											<button type="button" class="btn btn-default btn-bulkAction">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="checkAll" id="customCheck2">
													<label class="" for="customCheck2"></label>
												</div>
											</button>
											<button class="dropdown-toggle btn btn-default dropdown-toggle dropdown-icon custom-padding0" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fas fa-sort-down"></i>

												<div class="dropdown-menu" aria-labelledby="navbarDropdown">
												@if ($isAllow || in_array($statusUrl, $allowedRoutes))
													<a class="dropdown-item bulkAction" data-action-type="active">
														@lang('custom_admin.label_active_selected')
													</a>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item bulkAction" data-action-type="inactive">
														@lang('custom_admin.label_inactive_selected')
													</a>
												@endif
												@if ($isAllow || (in_array($statusUrl, $allowedRoutes) && in_array($pageRoute, $allowedRoutes)))
													<div class="dropdown-divider"></div>
												@endif
												@if ($isAllow || in_array($pageRoute, $allowedRoutes))
													<a class="dropdown-item bulkAction" data-action-type="delete">
														@lang('custom_admin.label_delete_selected')
													</a>
												@endif
												</div>
											</button>
										</div>
									</th>
								@endif
									<th class="zeroColumn table-th-display-none"></th>
									<th class="firstColumn">@lang('custom_admin.label_hash')</th>
									<th class="display-none">@lang('custom_admin.label_hash')</th>
									<th>@lang('custom_admin.label_name') 1</th>
									<th>@lang('custom_admin.label_phone') 1</th>
									<th>@lang('custom_admin.label_beat_name')</th>
									<th>@lang('custom_admin.label_distribution_area')</th>
									<th>@lang('custom_admin.label_store_email')</th>
									<th>@lang('custom_admin.label_store_name')</th>
									<th>@lang('custom_admin.label_grade_name')</th>
									<th>@lang('custom_admin.label_sale_size_category')</th>
									<th>@lang('custom_admin.label_integrity')</th>
									{{-- <th class="modifiedColumn">@lang('custom_admin.label_modified')</th> --}}
									<th class="row_status">@lang('custom_admin.label_status')</th>
									<th class="actions">@lang('custom_admin.label_action')</th>
								</tr>
							</thead>							
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Store Target Summary Logs modal content -->
    <div id="store-target-summary-logs-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 900px;">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-dark">
                    <h4 class="modal-title" id="dark-header-modalLabel">{{ __('custom_admin.label_menu_store_target_summary_log') }}<span id="store-details-area"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                	<form name="createStoreTargetSummaryLogForm" id="createStoreTargetSummaryLogForm">
                    	<input type="hidden" name="store_id" id="store-id" value="">
	                    <div class="row">
	                        <div class="col-md-4">
	                            <div class="form-group">
	                                <label class="text-dark font-bold">{{ __('custom_admin.label_date') }}<span class="red_star">*</span></label>
	                                {{ Form::text('date', null, [
	                                                            'id' => 'date',
	                                                            'class' => 'form-control datePickerPayment',
	                                                            'placeholder' => '',
	                                                            'readonly' => true
	                                                            ]) }}
	                            </div>
	                        </div>
	                        <div class="col-md-4">
	                            <div class="form-group">
	                                <label class="text-dark font-bold">{{ __('custom_admin.label_current_credit_days') }}<span class="red_star">*</span></label>
	                                {{ Form::number('credit_days', null, [
	                                                            'id' => 'credit_days',
	                                                            'min' => 0,
	                                                            'class' => 'form-control',
	                                                            'placeholder' => ''
	                                                            ]) }}
	                            </div>
	                        </div>
	                        <div class="col-md-4">
	                            <div class="form-group">
	                                <label class="text-dark font-bold">{{ __('custom_admin.label_current_target') }}<span class="red_star">*</span></label>
	                                {{ Form::number('current_target', null, [
	                                                            'id' => 'current_target',
	                                                            'min' => 0,
	                                                            'class' => 'form-control',
	                                                            'placeholder' => ''
	                                                            ]) }}
	                            </div>
	                        </div>
	                        <div class="col-md-4">
	                            <div class="form-group">
	                                <label class="text-dark font-bold">{{ __('custom_admin.label_weekly_payment') }}<span class="red_star">*</span></label>
	                                {{ Form::number('weekly_payment', null, [
	                                                            'id' => 'weekly_payment',
	                                                            'min' => 0,
	                                                            'class' => 'form-control',
	                                                            'placeholder' => ''
	                                                            ]) }}
	                            </div>
	                        </div>
	                        
	                        <div class="col-md-4">
	                            <div class="form-group">
	                                <label class="text-dark font-bold">{{ __('custom_admin.label_visit_cycle') }}</label>
	                                {{ Form::text('visit_cycle', null, [
	                                                            'id' => 'visit_cycle',
	                                                            'class' => 'form-control',
	                                                            'placeholder' => ''
	                                                            ]) }}
	                            </div>
	                        </div>
	                        <div class="col-md-4">
	                        	<label class="text-dark font-bold" style="width: 100%;">&nbsp;</label>
	                        	<button type="submit" id="btn-processing" class="btn btn-success btn-rounded createStoreTargetSummaryLog"><i class="far fa-save" aria-hidden="true"></i> {{ __('custom_admin.btn_submit') }}</button>
	                        </div>
	                    </div>
	                </form>
                </div>
                <div class="modal-footer">
                    <div class="table-responsive mt-4-5">
						<table id="store-target-summary-log" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                	<th class="zeroColumn table-th-display-none"></th>
									<th>{{ __('custom_admin.label_date') }}</th>
                                    <th>{{ __('custom_admin.label_current_credit_days') }}</th>
                                    <th>{{ __('custom_admin.label_current_target') }}</th>
                                    <th>{{ __('custom_admin.label_weekly_payment') }}</th>
                                    <th>{{ __('custom_admin.label_visit_cycle') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2023-08-08</td>
                                    <td>Di/08/2023/20066</td>
                                    <td>Bandel</td>
                                    <td>SARAT STORES</td>
                                    <td>SHIBLAL SARKAR</td>
                                </tr>
                                <tr>
                                    <td>2023-07-29</td>
                                    <td>Di/07/2023/20051</td>
                                    <td>Bandel</td>
                                    <td>SARAT STORES</td>
                                    <td>SHIBLAL SARKAR</td>
                                </tr>
                            </tbody>
                        </table>
                	</div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@endsection

@push('scripts')
@include($routePrefix.'.'.$pageRoute.'.scripts')
@endpush
