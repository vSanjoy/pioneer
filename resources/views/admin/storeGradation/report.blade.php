@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	<style type="text/css">
	.actions {pointer-events: none !important;}
	</style>

	@php
	$dateRange = '2023-09-01 - 2023-12-15'; $storeId = '21';
	$hideStatus = 'style="display: none;"';
	$showStatus = 'style="display: block;"';
	if (isset($_GET['date_range']) && $_GET['date_range'] != '') { $dateRange = $_GET['date_range']; }
	if (isset($_GET['store_id']) && $_GET['store_id'] != '') { $storeId = $_GET['store_id']; }
	
	if ( (isset($_GET['date_range']) && $_GET['date_range'] != '') || (isset($_GET['store_id']) && $_GET['store_id'] != '') ) {
		$showStatus = 'style="display: block;"';
		$hideStatus = 'style="display: none;"';
	}
	@endphp

	<!-- Start :: Filter -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Filter</h4>
					<button type="button" class="btn search-toggle-icon" id="toggleSearchBox">
						<i class="fas fa-plus" id="plus" data-ctoggle="1" {!! $hideStatus !!}></i>
						<i class="fas fa-minus" id="minus" data-ctoggle="0" {!! $showStatus !!}></i>
					</button>
					<form class="mt-4" id="showFilterStatus" {!! $showStatus !!}>
						<div class="form-body">
							<div class="row">
								{{-- Start :: Date Range --}}
								<div class="col-md-3">
									<div class="form-group">
										<label class="text-dark font-bold">Date Range</label>
										{{ Form::text('date_range', $dateRange, [
																	'id' => 'date_range',
																	'class' => 'form-control dateRangePickerWithoutTime',
																	'placeholder' => '',
																	'readonly' => true
																	]) }}
									</div>
								</div>
								{{-- End :: Date Range --}}

								{{-- Start :: Beat --}}
		                        <div class="col-md-3">
		                            <div class="form-group">
		                                <label class="text-dark font-bold">{{ __('custom_admin.label_beat') }}</label>
		                                <select name="store_id" id="store_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
		                                    <option value="">--@lang('custom_admin.label_select')--</option>
		                                    <option value="6" selected>Bandel</option>
		                                    <option value="1">Bhadreswar</option>
		                                    <option value="2">Mankundu jotir more</option>
		                                    <option value="3">Chandannagar</option>
		                                    <option value="4">Hooghly</option>
		                                    <option value="5">Chinsurah</option>
		                                </select>
		                            </div>
		                        </div>
		                        {{-- End :: Beat --}}

								{{-- Start :: Store --}}
		                        <div class="col-md-6">
		                            <div class="form-group">
		                                <label class="text-dark font-bold">Store<span class="red_star">*</span></label>
		                                <select class="selectpicker form-control" id="distribution_area_ids" name="distribution_area_ids[]" data-container="body" data-live-search="true" title="--@lang('custom_admin.label_select')--" data-hide-disabled="true" data-actions-box="true" data-virtual-scroll="false" required>
		                                    <option value="">--@lang('custom_admin.label_select')--</option>
		                                    <option value="1" selected>SARAT STORES (SHIBLAL SARKAR - 9231879588)</option>
		                                    <option value="2">JAISWAL (SURESH JAISWAL - 9830366115)</option>
		                                    <option value="3">SARKAR ENTERPRISE (SANJOY SARKAR - 9874160892)</option>
		                                    <option value="4">RAJENDRA XEROX (PRANAB BISWAS - 8013218899)</option>
		                                    <option value="5">ROY ENTERPRISE (SHISIR ROY - 9836530815)</option>
		                                </select>
		                            </div>
		                        </div>
		                        {{-- End :: Store --}}
								
								<div class="col-md-4">
									<div class="form-group">
										<label class="text-dark font-bold">&nbsp;</label><br />
										{{-- <button class="btn btn-info btn-circle btn-circle-sm filterList" type="button" title="Filter">
											<i class="fas fa-search"></i>
										</button> --}}
										<button class="btn btn-dark btn-circle btn-circle-sm resetFilter" type="button" title="Reset">
											<i class="fas fa-sync-alt ml_minus_1" aria-hidden="true"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- End :: Filter -->

	<!-- <table id="list-table" class="table table-striped table-bordered no-wrap list-data custom-table custom-table-second-column">
							<thead>
								<tr>
									<th class="zeroColumn table-th-display-none"></th>
									<th class="firstColumn">@lang('custom_admin.label_hash')</th>
									<th class="modifiedColumn">@lang('custom_admin.label_date')</th>
									<th class="modifiedColumn">Inv. No.</th>
									<th class="modifiedColumn">Ref. No.</th>
									<th class="modifiedColumn">@lang('custom_admin.label_store')</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Balance</th>
								</tr>
							</thead>
						</table> -->

	<!-- <div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $pageTitle }}</h4>
					<div class="table-responsive mt-4-5">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                	<th class="firstColumn">{{ __('custom_admin.label_hash') }}</th>
                                    <th>{{ __('custom_admin.label_date') }}</th>
                                    <th>{{ __('custom_admin.label_beat') }}</th>
                                    <th>{{ __('custom_admin.label_store') }}</th>
                                    <th>{{ __('custom_admin.label_owner') }}</th>
                                    <th>{{ __('custom_admin.label_phone') }}</th>
                                    <th>{{ __('custom_admin.label_grade') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2023-12-02</td>
                                    <td>Bandel</td>
                                    <td>SARAT STORES</td>
                                    <td>SHIBLAL SARKAR</td>
                                    <td>9231879588</td>
                                    <td>4.0</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>2023-12-01</td>
                                    <td>Bandel</td>
                                    <td>SARKAR ENTERPRISE</td>
                                    <td>SANJOY SARKAR</td>
                                    <td>9874160892</td>
                                    <td>5.0</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>2023-11-25</td>
                                    <td>Hooghly</td>
                                    <td>Paramounts</td>
                                    <td>Pranab Dey</td>
                                    <td>9831666260</td>
                                    <td>2.0</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>2023-11-15</td>
                                    <td>Hooghly</td>
                                    <td>Student Aquariam</td>
                                    <td>Satyajit Debnath</td>
                                    <td>9051812818</td>
                                    <td>3.4</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>2023-11-08</td>
                                    <td>Hooghly</td>
                                    <td>Student Corner</td>
                                    <td>Deboprasad Roy</td>
                                    <td>9903998833</td>
                                    <td>4.0</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>2023-11-02</td>
                                    <td>Bandel</td>
                                    <td>SARAT STORES</td>
                                    <td>SHIBLAL SARKAR</td>
                                    <td>9231879588</td>
                                    <td>3.2</td>
                                </tr>
                            </tbody>
                        </table>
					</div>
				</div>
			</div>
		</div>
	</div> -->

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $pageTitle }}</h4>
					<div class="table-responsive mt-4-5">
						<table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                	<th class="firstColumn">{{ __('custom_admin.label_hash') }}</th>
                                    <th>{{ __('custom_admin.label_date') }}</th>
                                    <th>{{ __('custom_admin.label_beat') }}</th>
                                    <th>{{ __('custom_admin.label_store') }}</th>
                                    <th>{{ __('custom_admin.label_owner') }}</th>
                                    <th>{{ __('custom_admin.label_phone') }}</th>
                                    <th>{{ __('custom_admin.label_grade') }}</th>
                                    <!-- <th class="actions">{{ __('custom_admin.label_action') }}</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2023-12-02</td>
                                    <td>Bandel</td>
                                    <td>SARAT STORES</td>
                                    <td>SHIBLAL SARKAR</td>
                                    <td>9231879588</td>
                                    <td>4.0</td>
                                    <!-- <td>
	                                    <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-danger btn-circle btn-circle-sm"><i class="fa fa-trash"></i></a>
	                                </td> -->
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>2023-11-02</td>
                                    <td>Bandel</td>
                                    <td>SARAT STORES</td>
                                    <td>SHIBLAL SARKAR</td>
                                    <td>9231879588</td>
                                    <td>3.2</td>
                                    <!-- <td>
	                                    <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-danger btn-circle btn-circle-sm"><i class="fa fa-trash"></i></a>
	                                </td> -->
                                </tr>
                            </tbody>
                        </table>
                        
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function () {
    $(".actions").removeClass("sorting");
});
$(document).on('click', '#toggleSearchBox', function() {
	if ($('#showFilterStatus').is(':visible')) {
		$('#plus').show();
		$('#minus').hide();	
	} else {
		$('#minus').show();
		$('#plus').hide();
	}
	$('#showFilterStatus').toggle(400);
});
</script>
@endpush