<script type="text/javascript">
$(document).ready(function() {
	@if (Route::currentRouteName() == $routePrefix.'.'.$detailsListUrl)
	getDistributionAreaList();
	@endif

	@if (Route::currentRouteName() == $routePrefix.'.sellerAnalyses.beat-list')
	getBeatList();
	@endif

	@if (Route::currentRouteName() == $routePrefix.'.sellerAnalyses.store-list')
	getStoreList();
	@endif

	@if (Route::currentRouteName() == $routePrefix.'.sellerAnalyses.category-list')
	getCategoryList();
	@endif
	
	@if (Route::currentRouteName() == $routePrefix.'.sellerAnalyses.product-list')
	getProductList();
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
			@if ($isAllow || in_array('sellerAnalyses.beat-list', $allowedRoutes))
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

@if (Route::currentRouteName() == $routePrefix.'.sellerAnalyses.beat-list')
function getBeatList() {
	var getBeatListDataUrl = "{{route($routePrefix.'.sellerAnalyses.ajax-beat-list-request', [$distributionAreaId])}}";
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
			@if ($isAllow || in_array('sellerAnalyses.store-list', $allowedRoutes))
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

@if (Route::currentRouteName() == $routePrefix.'.sellerAnalyses.store-list')
function getStoreList() {
	var getStoreListDataUrl = "{{route($routePrefix.'.sellerAnalyses.ajax-store-list-request', [$distributionAreaId, $beatId])}}";
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
			@if ($isAllow || in_array('sellerAnalyses.category-list', $allowedRoutes))
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

@if (Route::currentRouteName() == $routePrefix.'.sellerAnalyses.category-list')
function getCategoryList() {
	var getCategoryListDataUrl = "{{route($routePrefix.'.sellerAnalyses.ajax-category-list-request', [$distributionAreaId, $beatId, $storeId])}}";
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
				url: getCategoryListDataUrl,
				type: 'POST',
				data: function(data) {},
			},
			columns: [
				{data: 'id', name: 'id'},
				{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
				{data: 'title', name: 'title'},
				{data: 'title_link', name: 'title_link'},
			@if ($isAllow || in_array('sellerAnalyses.product-list', $allowedRoutes))
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

@if (Route::currentRouteName() == $routePrefix.'.sellerAnalyses.product-list')
function getProductList() {
	var getProductListDataUrl = "{{route($routePrefix.'.sellerAnalyses.ajax-product-list-request', [$distributionAreaId, $beatId, $storeId, $categoryId])}}";
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
				url: getProductListDataUrl,
				type: 'POST',
				data: function(data) {},
			},
			columns: [
				{data: 'id', name: 'id'},
				{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
				{data: 'title', name: 'title'},
				{data: 'title_link', name: 'title_link'},
				{data: 'grade_id', name: 'grade_id', orderable: false, searchable: false},
			@if ($isAllow || in_array('sellerAnalyses.product-list', $allowedRoutes))
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