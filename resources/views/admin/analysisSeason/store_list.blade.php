@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $pageTitle }}</h4>
					<h3>{!! $analysisSeason->title.' ('.$analysisSeason->year.')' !!} - {!! $distributionArea->title !!} - {!! $distributor->full_name.' ('.$distributor->company.')' !!}</h3>
					<div class="table-responsive mt-4-5">
						<table id="list-table" class="table table-striped table-bordered no-wrap list-data custom-table custom-table-second-column">
							<thead>
								<tr>
									<th class="zeroColumn table-th-display-none"></th>
									<th class="firstColumn">@lang('custom_admin.label_hash')</th>
									<th class="display-none">@lang('custom_admin.label_hash')</th>
									<th>@lang('custom_admin.label_name') 1</th>
									<th>@lang('custom_admin.label_phone') 1</th>
									<th>@lang('custom_admin.label_beat_name')</th>
									{{-- <th>@lang('custom_admin.label_distribution_area')</th> --}}
									<th>@lang('custom_admin.label_store_email')</th>
									<th>@lang('custom_admin.label_store_name')</th>
									<th>@lang('custom_admin.label_grade_name')</th>
									<th>@lang('custom_admin.label_status')</th>
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
