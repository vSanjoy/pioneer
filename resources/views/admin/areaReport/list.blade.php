@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	@php
	$distributionAreaId = '';
	$hideStatus = 'style="display: none;"';
	$showStatus = 'style="display: block;"';
	if (isset($_GET['distribution_area_id']) && $_GET['distribution_area_id'] != '') { $distributionAreaId = $_GET['distribution_area_id']; }

	if ( (isset($_GET['distribution_area_id']) && $_GET['distribution_area_id'] != '') ) {
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
								{{-- Start :: Distributor --}}
								<div class="col-md-4">
									<div class="form-group">
										<label class="text-dark font-bold">Distribution Area</label>
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
								{{-- End :: Distributor --}}

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
					<h4 class="card-title">
						{{ $pageTitle }}

						<a class="btn btn-dark waves-effect waves-light btn-rounded shadow-md pr-3 pl-3 export-all-contacts export-analysis" style="display: block" href="javascript: void(0);">
							<i class="fa fa-download"></i> @lang('custom_admin.label_export')
						</a>
					</h4>					
					<div class="table-responsive mt-4-5">
						<table id="list-table" class="table table-striped table-bordered no-wrap list-data custom-table custom-table-second-column">
							<thead>
								<tr>
									<th class="zeroColumn table-th-display-none"></th>
									<th class="firstColumn">@lang('custom_admin.label_hash')</th>
									<th>@lang('custom_admin.label_distribution_area')</th>
									<th>@lang('custom_admin.label_beat')</th>
									<th>@lang('custom_admin.label_store')</th>
									<th>@lang('custom_admin.label_store_phone')</th>
									<th>@lang('custom_admin.label_store_owner')</th>
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
