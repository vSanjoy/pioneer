@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	@php
	$dateRange = '2023-08-01 - 2023-12-15'; $storeId = '21';
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
								<div class="col-md-4">
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
                                    <th>{{ __('custom_admin.label_reference_no') }}</th>
                                    <th>{{ __('custom_admin.label_debit') }}</th>
									<th>{{ __('custom_admin.label_credit') }}</th>
									<th>{{ __('custom_admin.label_balance') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2023-08-08</td>
                                    <td>Di/08/2023/20066</td>
                                    <td></td>
                                    <td>60740.00</td>
                                    <td>0.00</td>
                                    <td>271307.50</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>2023-08-08</td>
                                    <td>Di/08/2023/182</td>
                                    <td></td>
                                    <td>5325.00</td>
                                    <td>0.00</td>
                                    <td>276632.50</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>2023-09-21</td>
                                    <td>Di/09/2023/20088</td>
                                    <td></td>
                                    <td>35200.00</td>
                                    <td>0.00</td>
                                    <td>311832.50</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>2023-09-21</td>
                                    <td>Di/09/2023/247</td>
                                    <td></td>
                                    <td>17700.00</td>
                                    <td>0.00</td>
                                    <td>329532.50</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>2023-09-27</td>
                                    <td></td>
                                    <td>8691</td>
                                    <td>0.00</td>
                                    <td>126204.00</td>
                                    <td>203328.50</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>2023-09-28</td>
                                    <td>Di/09/2023/20094</td>
                                    <td></td>
                                    <td>53360.00</td>
                                    <td>0.00</td>
                                    <td>256688.50</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>2023-10-04</td>
                                    <td>Di/10/2023/268</td>
                                    <td></td>
                                    <td>3800.00</td>
                                    <td>0.00</td>
                                    <td>260488.50</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>2023-10-04</td>
                                    <td>Di/10/2023/20098</td>
                                    <td></td>
                                    <td>6600.00</td>
                                    <td>0.00</td>
                                    <td>267088.50</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>2023-10-06</td>
                                    <td>Di/10/2023/20103</td>
                                    <td></td>
                                    <td>19440.00</td>
                                    <td>0.00</td>
                                    <td>286528.50</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>2023-10-16</td>
                                    <td>Di/10/2023/20116</td>
                                    <td></td>
                                    <td>28080.00</td>
                                    <td>0.00</td>
                                    <td>314608.50</td>
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
@include($routePrefix.'.'.$pageRoute.'.scripts')
@endpush