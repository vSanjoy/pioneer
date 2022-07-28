@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	<style>
	.dataTables_filter{display: none;}
	</style>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">
						{{ $pageTitle }}
						@if (Auth::guard('admin')->user()->type == 'S')
						<a class="btn btn-secondary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3 float-right" href="{{ route($routePrefix.'.sellerAnalyses.distribution-area-list') }}">
							<i class="far fa-arrow-alt-circle-left"></i> @lang('custom_admin.btn_back')
						</a>
						@endif
					</h4>
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
									@if (\Auth::guard('admin')->user()->type != 'S')
									<th>@lang('custom_admin.label_seller')</th>
									@endif
									<th>@lang('custom_admin.label_store')</th>
									<th>@lang('custom_admin.label_product')</th>
									<th>@lang('custom_admin.label_order_qty')</th>
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
