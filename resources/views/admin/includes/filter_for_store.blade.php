@php
$distributionAreaId = $distributorId = $storeId = $beatId = $name1Id = $gradeId = '';
$hideStatus = 'style="display: none;"';
$showStatus = 'style="display: block;"';
if (isset($_GET['distribution_area_id']) && $_GET['distribution_area_id'] != '') { $distributionAreaId = $_GET['distribution_area_id']; }
if (isset($_GET['distributor_id']) && $_GET['distributor_id'] != '') { $distributorId = $_GET['distributor_id']; }
if (isset($_GET['beat_id']) && $_GET['beat_id'] != '') { $beatId = $_GET['beat_id']; }
if (isset($_GET['store_id']) && $_GET['store_id'] != '') { $storeId = $_GET['store_id']; }
if (isset($_GET['name_1_id']) && $_GET['name_1_id'] != '') { $name1Id = $_GET['name_1_id']; }
if (isset($_GET['grade_id']) && $_GET['grade_id'] != '') { $gradeId = $_GET['grade_id']; }

if ( (isset($_GET['distribution_area_id']) && $_GET['distribution_area_id'] != '') || (isset($_GET['distributor_id']) && $_GET['distributor_id'] != '') || (isset($_GET['beat_id']) && $_GET['beat_id'] != '') || (isset($_GET['store_id']) && $_GET['store_id'] != '') || (isset($_GET['name_1_id']) && $_GET['name_1_id'] != '') || (isset($_GET['grade_id']) && $_GET['grade_id'] != '') ) {
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
							{{-- Start :: Distribution Area --}}
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
							{{-- End :: Distribution Area --}}
                            {{-- Start :: Distributor --}}
							<div class="col-md-4">
								<div class="form-group">
									<label class="text-dark font-bold">Distributor</label>
									<select name="distributor_id" id="distributor_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
										<option value="">--@lang('custom_admin.label_select')--</option>
									@if ($distributors)
										@foreach ($distributors as $itemDistributor)
										<option value="{{ $itemDistributor->id }}" @if ($distributorId == $itemDistributor->id)selected @endif>{!! $itemDistributor->full_name.' ('.$itemDistributor->email.')' !!}</option>
										@endforeach
									@endif
									</select>
								</div>
							</div>
							{{-- End :: Distributor --}}
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
						</div>						
						<div class="row">
                            {{-- Start :: Store --}}
							<div class="col-md-4">
								<div class="form-group">
									<label class="text-dark font-bold">Store</label>
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
							{{-- Start :: Name 1 --}}
							<div class="col-md-4">
								<div class="form-group">
									<label class="text-dark font-bold">Name 1</label>
									<select name="name_1_id" id="name_1_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
										<option value="">--@lang('custom_admin.label_select')--</option>
									@if ($stores)
										@foreach ($stores as $itemStore)
										<option value="{{ $itemStore->id }}" @if ($name1Id == $itemStore->id)selected @endif>{!! $itemStore->name_1 !!}</option>
										@endforeach
									@endif
									</select>
								</div>
							</div>
							{{-- End :: Name 1 --}}
							{{-- Start :: Grade --}}
							<div class="col-md-4">
								<div class="form-group">
									<label class="text-dark font-bold">Grade</label>
									<select name="grade_id" id="grade_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
										<option value="">--@lang('custom_admin.label_select')--</option>
									@if ($grades)
										@foreach ($grades as $itemGrade)
										<option value="{{ $itemGrade->id }}" @if ($gradeId == $itemGrade->id)selected @endif>{!! $itemGrade->title !!}</option>
										@endforeach
									@endif
									</select>
								</div>
							</div>
							{{-- End :: Grade --}}
						</div>
						<div class="row">
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