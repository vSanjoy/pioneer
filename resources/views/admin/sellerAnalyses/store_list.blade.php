@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $pageTitle }}</h4>
					<h3>{!! $distributionArea->title !!} - {!! $beat->title !!}</h3>
					<div class="table-responsive mt-4-5">
						<table id="list-table" class="table table-striped table-bordered no-wrap list-data custom-table custom-table-second-column">
							<thead>
								<tr>
									<th class="zeroColumn table-th-display-none"></th>
									<th class="firstColumn">@lang('custom_admin.label_hash')</th>
									<th>@lang('custom_admin.label_store_name')</th>
									<th>@lang('custom_admin.label_person_name')</th>
									<th>@lang('custom_admin.label_sale_size_category')</th>
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
