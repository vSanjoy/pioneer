@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	<style type="text/css">
	.actions {pointer-events: none !important;}
	</style>

	@php
	$dateRange = $storeId = '';
	$hideStatus = 'style="display: none;"';
	$showStatus = 'style="display: block;"';
	if (isset($_GET['date_range']) && $_GET['date_range'] != '') { $dateRange = $_GET['date_range']; }
	if (isset($_GET['store_id']) && $_GET['store_id'] != '') { $storeId = $_GET['store_id']; }
	
	if ( (isset($_GET['date_range']) && $_GET['date_range'] != '') || (isset($_GET['store_id']) && $_GET['store_id'] != '') || (isset($_GET['order_status']) && $_GET['order_status'] != '') ) {
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
								<div class="col-md-4">
									<div class="form-group">
										<label class="text-dark font-bold">{{ __('custom_admin.label_date_range') }}</label>
										{{ Form::text('date_range', $dateRange, [
																	'id' => 'date_range',
																	'class' => 'form-control dateRangePickerWithoutTime',
																	'placeholder' => '',
																	'readonly' => true
																	]) }}
									</div>
								</div>
								{{-- End :: Date Range --}}
								{{-- Start :: Store --}}
								<div class="col-md-4">
									<div class="form-group">
										<label class="text-dark font-bold">{{ __('custom_admin.label_store') }}</label>
										<select name="store_id" id="store_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
											<option value="">--@lang('custom_admin.label_select')--</option>
										@if ($stores)
											@foreach ($stores as $itemStore)
											<option value="{{ $itemStore->id }}" @if ($storeId == $itemStore->id)selected @endif>{!! $itemStore->store_name !!}</option>
											@endforeach
										@endif
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

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $pageTitle }}</h4>
					<div class="table-responsive mt-4-5">
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

                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                	<th class="firstColumn">{{ __('custom_admin.label_hash') }}</th>
                                    <th>{{ __('custom_admin.label_date') }}</th>
                                    <th>{{ __('custom_admin.label_invoice_no') }}</th>
                                    <th>{{ __('custom_admin.label_store') }}</th>
                                    <th>{{ __('custom_admin.label_owner') }}</th>
                                    <th>{{ __('custom_admin.label_phone') }}</th>
                                    <!-- <th>{{ __('custom_admin.label_representative') }}</th>
                                    <th>{{ __('custom_admin.label_phone') }}</th> -->
                                    <th class="actions">{{ __('custom_admin.label_action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2023-08-08</td>
                                    <td>Di/08/2023/20066</td>
                                    <td>SARAT STORES</td>
                                    <td>SHIBLAL SARKAR</td>
                                    <td>9231879588</td>
                                    <!-- <td>Demo Representative</td>
                                    <td>9231879588</td> -->
                                    <td>
                                    	<a href="#" data-microtip-position="top" role="tooltip" class="btn btn-dark btn-circle btn-circle-sm" target="_blank" style="padding-left: 7px;"><i class="fa fa-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>2023-07-29</td>
                                    <td>Di/07/2023/20051</td>
                                    <td>SARKAR ENTERPRISE</td>
                                    <td>SANJOY SARKAR</td>
                                    <td>9874160892</td>
                                    <!-- <td>Uttam Sinha Roy</td>
                                    <td>9085416320</td> -->
                                    <td>
                                    	<a href="#" data-microtip-position="top" role="tooltip" class="btn btn-dark btn-circle btn-circle-sm" target="_blank" style="padding-left: 7px;"><i class="fa fa-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>2023-06-29</td>
                                    <td>Di/06/2023/20050</td>
                                    <td>SARKAR ENTERPRISE</td>
                                    <td>SANJOY SARKAR</td>
                                    <td>9874160892</td>
                                    <!-- <td>Uttam Sinha Roy</td>
                                    <td>9085416320</td> -->
                                    <td>
                                    	<a href="#" data-microtip-position="top" role="tooltip" class="btn btn-dark btn-circle btn-circle-sm" target="_blank" style="padding-left: 7px;"><i class="fa fa-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>2023-06-25</td>
                                    <td>Di/06/2023/20040</td>
                                    <td>SUBHAS LAHA</td>
                                    <td>SUBHAS LAHA</td>
                                    <td>9735185468</td>
                                    <!-- <td>Uttam Sinha Roy</td>
                                    <td>9085416320</td> -->
                                    <td>
                                    	<a href="#" data-microtip-position="top" role="tooltip" class="btn btn-dark btn-circle btn-circle-sm" target="_blank" style="padding-left: 7px;"><i class="fa fa-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>2023-06-20</td>
                                    <td>Di/06/2023/20038</td>
                                    <td>B.K VARIETY</td>
                                    <td>NASIR HUSSEN KHAN</td>
                                    <td>9732326124</td>
                                    <!-- <td>Uttam Sinha Roy</td>
                                    <td>9085416320</td> -->
                                    <td>
                                    	<a href="#" data-microtip-position="top" role="tooltip" class="btn btn-dark btn-circle btn-circle-sm" target="_blank" style="padding-left: 7px;"><i class="fa fa-download"></i></a>
                                    </td>
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