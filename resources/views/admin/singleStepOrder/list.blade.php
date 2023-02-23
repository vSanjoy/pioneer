@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	<style>
	.dataTables_filter{display: none;}
	</style>

	@php
	$dateRange = $beatId = $distributionAreaId = $storeId = '';
	$hideStatus = 'style="display: none;"';
	$showStatus = 'style="display: block;"';
	if (isset($_GET['date_range']) && $_GET['date_range'] != '') { $dateRange = $_GET['date_range']; }
	if (isset($_GET['distribution_area_id']) && $_GET['distribution_area_id'] != '') { $distributionAreaId = $_GET['distribution_area_id']; }
	if (isset($_GET['beat_id']) && $_GET['beat_id'] != '') { $beatId = $_GET['beat_id']; }
	if (isset($_GET['store_id']) && $_GET['store_id'] != '') { $storeId = $_GET['store_id']; }

	if ( (isset($_GET['date_range']) && $_GET['date_range'] != '') || (isset($_GET['distribution_area_id']) && $_GET['distribution_area_id'] != '') || (isset($_GET['beat_id']) && $_GET['beat_id'] != '') || (isset($_GET['store_id']) && $_GET['store_id'] != '') ) {
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
																	'class' => 'form-control dateRangePicker',
																	'placeholder' => '',
																	'readonly' => true
																	]) }}
									</div>
								</div>
								{{-- End :: Date Range --}}
								{{-- Start :: Distribution Area --}}
								<div class="col-md-4">
									<div class="form-group">
										<label class="text-dark font-bold">{{ __('custom_admin.label_distribution_area') }}</label>
										<select name="distribution_area_id" id="distribution_area_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
											<option value="">--@lang('custom_admin.label_select')--</option>
										@if ($distributionAreas)
											@foreach ($distributionAreas as $itemDistributionArea)
											<option value="{{ $itemDistributionArea->id }}" @if ($distributionAreaId == $itemDistributionArea->id)selected @endif>{!! $itemDistributionArea->title !!}</option>
											@endforeach
										@endif
										</select>
									</div>
								</div>
								{{-- End :: Distribution Area --}}
								{{-- Start :: Beat --}}
								<div class="col-md-4">
									<div class="form-group">
										<label class="text-dark font-bold">Beat</label>
										<select name="beat_id" id="beat_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
											<option value="">--@lang('custom_admin.label_select')--</option>
										@if ($beats)
											@foreach ($beats as $itemBeat)
											<option value="{{ $itemBeat->id }}" @if ($beatId == $itemBeat->id)selected @endif>{!! $itemBeat->title !!}</option>
											@endforeach
										@endif
										</select>
									</div>
								</div>
								{{-- End :: Beat --}}
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
						<table id="list-table" class="table table-striped table-bordered no-wrap list-data custom-table custom-table-second-column">
							<thead>
								<tr>
								@if ($isAllow || in_array($deleteUrl, $allowedRoutes))
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
												@if ($isAllow || in_array($deleteUrl, $allowedRoutes))
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
									<th class="modifiedColumn">@lang('custom_admin.label_date')</th>
									<th class="modifiedColumn">@lang('custom_admin.label_unique_order_id')</th>
									@if (\Auth::guard('admin')->user()->type != 'S')
									<th>@lang('custom_admin.label_seller')</th>
									@endif
									<th>@lang('custom_admin.label_distribution_area')</th>
									<th>@lang('custom_admin.label_beat')</th>
									<th>@lang('custom_admin.label_store')</th>
									<th>@lang('custom_admin.label_season')</th>
									<th class="actions">@lang('custom_admin.label_action')</th>
								</tr>
							</thead>							
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
