@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">
						{{ $pageTitle }}
						<div class="float-right">
							<a class="btn btn-secondary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3" href="{{ route($routePrefix.'.'.$listUrl) }}">
								<i class="far fa-arrow-alt-circle-left" aria-hidden="true"></i> @lang('custom_admin.btn_back')
							</a>
						</div>
					</h4>	
					<h3>
						{!! $areaAnalysis->seasonDetails->title !!} - {!! $areaAnalysis->distributionAreaDetails->title !!} - {!! $areaAnalysis->storeDetails->store_name !!} - {!! $areaAnalysis->categoryDetails->title !!} - {!! $areaAnalysis->productDetails->title !!}
					</h3>
					<div class="table-responsive mt-4-5">
						<table id="list-table" class="table table-striped table-bordered no-wrap list-data custom-table custom-table-second-column">
							<thead>
								<tr>
									<th class="zeroColumn table-th-display-none"></th>
									<th class="firstColumn">@lang('custom_admin.label_hash')</th>
									<th>@lang('custom_admin.label_result')</th>
									<th>@lang('custom_admin.label_why')</th>
									<th>@lang('custom_admin.label_date')</th>
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
