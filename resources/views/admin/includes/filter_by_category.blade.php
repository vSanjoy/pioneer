@php
$categoryId = '';
$hideStatus = 'style="display: none;"';
$showStatus = 'style="display: block;"';
if ( isset($_GET['category_id']) && $_GET['category_id'] != '' ) {
	$categoryId = $_GET['category_id'];
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
							<div class="col-md-6">
								<div class="form-group">
									<label class="text-dark font-bold">Category</label>
									<select name="category_id" id="categoryid" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
										<option value="">--@lang('custom_admin.label_select')--</option>
									@if ($categories)
										@foreach ($categories as $item)
										<option value="{{ $item->id }}" @if ($categoryId == $item->id)selected @endif>{{ $item->title }}</option>
										@endforeach
									@endif
									</select>
								</div>
							</div>
							<div class="col-md-6">
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