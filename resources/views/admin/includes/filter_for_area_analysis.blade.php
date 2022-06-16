@php
$seasonId	= $distributionAreaId = $distributorId = $storeId = $categoryId = $productId = '';
$hideStatus = 'style="display: none;"';
$showStatus = 'style="display: block;"';

if (isset($_GET['season_id']) && $_GET['season_id'] != '') { $seasonId = $_GET['season_id']; }
if (isset($_GET['distribution_area_id']) && $_GET['distribution_area_id'] != '') { $distributionAreaId = $_GET['distribution_area_id']; }
if (isset($_GET['distributor_id']) && $_GET['distributor_id'] != '') { $distributorId = $_GET['distributor_id']; }
if (isset($_GET['store_id']) && $_GET['store_id'] != '') { $storeId = $_GET['store_id']; }
if (isset($_GET['category_id']) && $_GET['category_id'] != '') { $categoryId = $_GET['category_id']; }
if (isset($_GET['product_id']) && $_GET['product_id'] != '') { $productId = $_GET['product_id']; }

if ( (isset($_GET['season_id']) && $_GET['season_id'] != '') || (isset($_GET['distribution_area_id']) && $_GET['distribution_area_id'] != '') || (isset($_GET['distributor_id']) && $_GET['distributor_id'] != '') || (isset($_GET['store_id']) && $_GET['store_id'] != '') || (isset($_GET['category_id']) && $_GET['category_id'] != '') || (isset($_GET['product_id']) && $_GET['product_id'] != '') ) {
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
							{{-- Start :: Season --}}
							<div class="col-md-4">
								<div class="form-group">
									<label class="text-dark font-bold">Season</label>
									<select name="season_id" id="season_id" class="form-control">
										<option value="">--@lang('custom_admin.label_select')--</option>
									@if ($seasons)
										@foreach ($seasons as $itemSeason)
										<option value="{{ $itemSeason->id }}" @if ($seasonId == $itemSeason->id)selected @endif>{!! $itemSeason->title !!}</option>
										@endforeach
									@endif
									</select>
								</div>
							</div>
							{{-- End :: Season --}}							
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
										<option value="{{ $itemStore->id }}" @if ($storeId == $itemStore->id)selected @endif>{!! $itemStore->store_name.' ('.$itemStore->email.')' !!}</option>
										@endforeach
									@endif
									</select>
								</div>
							</div>
							{{-- End :: Store --}}
							{{-- Start :: Category --}}
							<div class="col-md-4">
								<div class="form-group">
									<label class="text-dark font-bold">Category</label>
									<select name="category_id" id="category_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
										<option value="">--@lang('custom_admin.label_select')--</option>
									@if ($categories)
										@foreach ($categories as $category)
										<option value="{{ $category->id }}" @if ($categoryId == $category->id)selected @endif>{!! $category->title !!}</option>
										@endforeach
									@endif
									</select>
								</div>
							</div>
							{{-- End :: Category --}}
							{{-- Start :: Product --}}
							<div class="col-md-4">
								<div class="form-group">
									<label class="text-dark font-bold">Product</label>
									<select name="product_id" id="product_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
										<option value="">--@lang('custom_admin.label_select')--</option>
									</select>
								</div>
							</div>
							{{-- End :: Product --}}
						</div>						
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<div class="mb-2"></div>
									<div>
										<button class="btn btn-info btn-circle btn-circle-sm filterList" type="button" title="Filter">
											<i class="fas fa-search"></i>
										</button>
										<button class="btn btn-dark btn-circle btn-circle-sm ml-1 resetFilter" type="button" title="Reset">
											<i class="fas fa-sync-alt" aria-hidden="true"></i>
										</button>
									</div>
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