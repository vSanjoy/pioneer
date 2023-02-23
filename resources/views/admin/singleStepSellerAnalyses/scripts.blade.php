<script type="text/javascript">
$(document).ready(function() {
	@if (Route::currentRouteName() == $routePrefix.'.'.$detailsListUrl)
	getDistributionAreaList();
	@endif

	@if (Route::currentRouteName() == $routePrefix.'.singleStepSellerAnalyses.beat-list')
	getBeatList();
	@endif

	@if (Route::currentRouteName() == $routePrefix.'.singleStepSellerAnalyses.store-list')
	getStoreList();
	@endif
	
	@if (Route::currentRouteName() == $routePrefix.'.singleStepSellerAnalyses.season-list')
	getSeasonList();
	@endif

	@if (Route::currentRouteName() == $routePrefix.'.singleStepSellerAnalyses.distributor-list')
	getDistributorList();
	@endif
});


@if (Route::currentRouteName() == $routePrefix.'.'.$detailsListUrl)
function getDistributionAreaList() {
	var getDistributionAreaListDataUrl = "{{route($routePrefix.'.'.$detailsListRequestUrl)}}";
	var dTable = $('#list-table').on('init.dt', function () {$('#dataTableLoading').hide();}).DataTable({
			destroy: true,
			autoWidth: false,
			responsive: false,
			processing: true,
			language: {
				processing: '<img src="{{asset("images/admin/".config("global.TABLE_LIST_LOADER"))}}">',
				search: "_INPUT_",
				searchPlaceholder: '{{ trans("custom_admin.btn_search") }}',
				emptyTable: '{{ trans("custom_admin.message_no_records_found") }}',
				zeroRecords: '{{ trans("custom_admin.message_no_records_found") }}',
				paginate: {
					first: '{{trans("custom_admin.label_first")}}',
					previous: '{{trans("custom_admin.label_previous")}}',
					next: '{{trans("custom_admin.label_next")}}',
					last: '{{trans("custom_admin.label_last")}}',
				}
			},
			serverSide: true,
			ajax: {
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: getDistributionAreaListDataUrl,
				type: 'POST',
				data: function(data) {},
			},
			columns: [
				{data: 'id', name: 'id'},
				{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
				{data: 'title', name: 'title'},
				{data: 'title_link', name: 'title_link'},
				// {data: 'created_at', name: 'created_at', orderable: false, searchable: false},
			@if ($isAllow || in_array('singleStepSellerAnalyses.beat-list', $allowedRoutes))
				// {data: 'action', name: 'action', orderable: false, searchable: false},
			@endif
			],
			columnDefs: [
				{
				targets: [ 0 ],
				visible: false,
				searchable: false,
				},
				{
				targets: [ 2 ],
				visible: false,
				searchable: true,
				},
			],
			order: [
				[0, 'desc']
			],
			pageLength: 25,
			lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, '{{trans("custom_admin.label_all")}}']],
			fnDrawCallback: function(settings) {
				if (settings._iDisplayLength == -1 || settings._iDisplayLength > settings.fnRecordsDisplay()) {
					$('#list-table_paginate').hide();
				} else {
					$('#list-table_paginate').show();
				}
			},
	});
	// Prevent alert box from datatable & console error message
	$.fn.dataTable.ext.errMode = 'none';	
	$('#list-table').on('error.dt', function (e, settings, techNote, message) {
		$('#dataTableLoading').hide();
		toastr.error(message, "@lang('custom_admin.message_error')");
	});
}
@endif

@if (Route::currentRouteName() == $routePrefix.'.singleStepSellerAnalyses.beat-list')
function getBeatList() {
	var getBeatListDataUrl = "{{route($routePrefix.'.singleStepSellerAnalyses.ajax-beat-list-request', [$distributionAreaId])}}";
	console.log(getBeatListDataUrl);
	var dTable = $('#list-table').on('init.dt', function () {$('#dataTableLoading').hide();}).DataTable({
			destroy: true,
			autoWidth: false,
			responsive: false,
			processing: true,
			language: {
				processing: '<img src="{{asset("images/admin/".config("global.TABLE_LIST_LOADER"))}}">',
				search: "_INPUT_",
				searchPlaceholder: '{{ trans("custom_admin.btn_search") }}',
				emptyTable: '{{ trans("custom_admin.message_no_records_found") }}',
				zeroRecords: '{{ trans("custom_admin.message_no_records_found") }}',
				paginate: {
					first: '{{trans("custom_admin.label_first")}}',
					previous: '{{trans("custom_admin.label_previous")}}',
					next: '{{trans("custom_admin.label_next")}}',
					last: '{{trans("custom_admin.label_last")}}',
				}
			},
			serverSide: true,
			ajax: {
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: getBeatListDataUrl,
				type: 'POST',
				data: function(data) {},
			},
			columns: [
				{data: 'id', name: 'id'},
				{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
				{data: 'title', name: 'title'},
				{data: 'title_link', name: 'title_link'},
			@if ($isAllow || in_array('singleStepSellerAnalyses.store-list', $allowedRoutes))
				// {data: 'action', name: 'action', orderable: false, searchable: false},
			@endif
			],
			columnDefs: [
				{
				targets: [ 0 ],
				visible: false,
				searchable: false,
				},
				{
				targets: [ 2 ],
				visible: false,
				searchable: true,
				},
			],
			order: [
				[0, 'desc']
			],
			pageLength: 25,
			lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, '{{trans("custom_admin.label_all")}}']],
			fnDrawCallback: function(settings) {
				if (settings._iDisplayLength == -1 || settings._iDisplayLength > settings.fnRecordsDisplay()) {
					$('#list-table_paginate').hide();
				} else {
					$('#list-table_paginate').show();
				}
			},
	});
	// Prevent alert box from datatable & console error message
	$.fn.dataTable.ext.errMode = 'none';	
	$('#list-table').on('error.dt', function (e, settings, techNote, message) {
		$('#dataTableLoading').hide();
		toastr.error(message, "@lang('custom_admin.message_error')");
	});
}
@endif

@if (Route::currentRouteName() == $routePrefix.'.singleStepSellerAnalyses.store-list')
function getStoreList() {
	var getStoreListDataUrl = "{{route($routePrefix.'.singleStepSellerAnalyses.ajax-store-list-request', [$distributionAreaId, $beatId])}}";
	var dTable = $('#list-table').on('init.dt', function () {$('#dataTableLoading').hide();}).DataTable({
			destroy: true,
			autoWidth: false,
			responsive: false,
			processing: true,
			language: {
				processing: '<img src="{{asset("images/admin/".config("global.TABLE_LIST_LOADER"))}}">',
				search: "_INPUT_",
				searchPlaceholder: '{{ trans("custom_admin.btn_search") }}',
				emptyTable: '{{ trans("custom_admin.message_no_records_found") }}',
				zeroRecords: '{{ trans("custom_admin.message_no_records_found") }}',
				paginate: {
					first: '{{trans("custom_admin.label_first")}}',
					previous: '{{trans("custom_admin.label_previous")}}',
					next: '{{trans("custom_admin.label_next")}}',
					last: '{{trans("custom_admin.label_last")}}',
				}
			},
			serverSide: true,
			ajax: {
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: getStoreListDataUrl,
				type: 'POST',
				data: function(data) {},
			},
			columns: [
				{data: 'id', name: 'id'},
				{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
				{data: 'store_name', name: 'store_name'},
				{data: 'store_name_link', name: 'store_name_link'},
				{data: 'name_1', name: 'name_1'},
				{data: 'sale_size_category', name: 'sale_size_category'},
			@if ($isAllow || in_array('singleStepSellerAnalyses.category-list', $allowedRoutes))
				// {data: 'action', name: 'action', orderable: false, searchable: false},
			@endif
			],
			columnDefs: [
				{
				targets: [ 0 ],
				visible: false,
				searchable: false,
				},
				{
				targets: [ 2 ],
				visible: false,
				searchable: true,
				},
			],
			order: [
				[0, 'desc']
			],
			pageLength: 50,
			lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, '{{trans("custom_admin.label_all")}}']],
			fnDrawCallback: function(settings) {
				if (settings._iDisplayLength == -1 || settings._iDisplayLength > settings.fnRecordsDisplay()) {
					$('#list-table_paginate').hide();
				} else {
					$('#list-table_paginate').show();
				}
			},
	});
	// Prevent alert box from datatable & console error message
	$.fn.dataTable.ext.errMode = 'none';	
	$('#list-table').on('error.dt', function (e, settings, techNote, message) {
		$('#dataTableLoading').hide();
		toastr.error(message, "@lang('custom_admin.message_error')");
	});
}
@endif

@if (Route::currentRouteName() == $routePrefix.'.singleStepSellerAnalyses.season-list')
function getSeasonList() {
	var getSeasonListDataUrl = "{{route($routePrefix.'.singleStepSellerAnalyses.ajax-season-list-request', [$distributionAreaId, $beatId, $storeId])}}";
	var dTable = $('#list-table').on('init.dt', function () {$('#dataTableLoading').hide();}).DataTable({
			destroy: true,
			autoWidth: false,
			responsive: false,
			processing: true,
			language: {
				processing: '<img src="{{asset("images/admin/".config("global.TABLE_LIST_LOADER"))}}">',
				search: "_INPUT_",
				searchPlaceholder: '{{ trans("custom_admin.btn_search") }}',
				emptyTable: '{{ trans("custom_admin.message_no_records_found") }}',
				zeroRecords: '{{ trans("custom_admin.message_no_records_found") }}',
				paginate: {
					first: '{{trans("custom_admin.label_first")}}',
					previous: '{{trans("custom_admin.label_previous")}}',
					next: '{{trans("custom_admin.label_next")}}',
					last: '{{trans("custom_admin.label_last")}}',
				}
			},
			serverSide: true,
			ajax: {
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: getSeasonListDataUrl,
				type: 'POST',
				data: function(data) {},
			},
			columns: [
				{data: 'id', name: 'id'},
				{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
				{data: 'title', name: 'title'},
				{data: 'distributor_link', name: 'distributor_link'},
				{data: 'year', name: 'year'},
			@if ($isAllow || in_array('singleStepSellerAnalyses.category-list', $allowedRoutes))
				// {data: 'action', name: 'action', orderable: false, searchable: false},
			@endif
			],
			columnDefs: [
				{
				targets: [ 0 ],
				visible: false,
				searchable: false,
				},
				{
				targets: [ 2 ],
				visible: false,
				searchable: true,
				},
			],
			order: [
				[0, 'desc']
			],
			pageLength: 50,
			lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, '{{trans("custom_admin.label_all")}}']],
			fnDrawCallback: function(settings) {
				if (settings._iDisplayLength == -1 || settings._iDisplayLength > settings.fnRecordsDisplay()) {
					$('#list-table_paginate').hide();
				} else {
					$('#list-table_paginate').show();
				}
			},
	});
	// Prevent alert box from datatable & console error message
	$.fn.dataTable.ext.errMode = 'none';	
	$('#list-table').on('error.dt', function (e, settings, techNote, message) {
		$('#dataTableLoading').hide();
		toastr.error(message, "@lang('custom_admin.message_error')");
	});
}
@endif

@if (Route::currentRouteName() == $routePrefix.'.singleStepSellerAnalyses.distributor-list')
function getDistributorList() {
	var getDistributorListDataUrl = "{{route($routePrefix.'.singleStepSellerAnalyses.ajax-distributor-list-request', [$distributionAreaId, $beatId, $storeId, $analysisSeasonId])}}";
	var dTable = $('#list-table').on('init.dt', function () {$('#dataTableLoading').hide();}).DataTable({
			destroy: true,
			autoWidth: false,
			responsive: false,
			processing: true,
			language: {
				processing: '<img src="{{asset("images/admin/".config("global.TABLE_LIST_LOADER"))}}">',
				search: "_INPUT_",
				searchPlaceholder: '{{ trans("custom_admin.btn_search") }}',
				emptyTable: '{{ trans("custom_admin.message_no_records_found") }}',
				zeroRecords: '{{ trans("custom_admin.message_no_records_found") }}',
				paginate: {
					first: '{{trans("custom_admin.label_first")}}',
					previous: '{{trans("custom_admin.label_previous")}}',
					next: '{{trans("custom_admin.label_next")}}',
					last: '{{trans("custom_admin.label_last")}}',
				}
			},
			serverSide: true,
			ajax: {
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: getDistributorListDataUrl,
				type: 'POST',
				data: function(data) {},
			},
			columns: [
				{data: 'id', name: 'id'},
				{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
				{data: 'full_name', name: 'full_name'},
				{data: 'analysis_link', name: 'analysis_link'},
				{data: 'company', name: 'company'},
				{data: 'email', name: 'email'},
			@if ($isAllow || in_array('singleStepSellerAnalyses.category-list', $allowedRoutes))
				// {data: 'action', name: 'action', orderable: false, searchable: false},
			@endif
			],
			columnDefs: [
				{
				targets: [ 0 ],
				visible: false,
				searchable: false,
				},
				{
				targets: [ 2 ],
				visible: false,
				searchable: true,
				},
			],
			order: [
				[0, 'desc']
			],
			pageLength: 50,
			lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, '{{trans("custom_admin.label_all")}}']],
			fnDrawCallback: function(settings) {
				if (settings._iDisplayLength == -1 || settings._iDisplayLength > settings.fnRecordsDisplay()) {
					$('#list-table_paginate').hide();
				} else {
					$('#list-table_paginate').show();
				}
			},
	});
	// Prevent alert box from datatable & console error message
	$.fn.dataTable.ext.errMode = 'none';	
	$('#list-table').on('error.dt', function (e, settings, techNote, message) {
		$('#dataTableLoading').hide();
		toastr.error(message, "@lang('custom_admin.message_error')");
	});
}
@endif
</script>