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

	// Store Status section
	$(document).on('click', '.store-status', function() {
		var id 			= $(this).data('id');
		var actionType 	= $(this).data('action-type');
		listStoreStatusActionsWithFilter('{{ $pageRoute }}', 'status', id, actionType);
	});
	@endif
	
	@if (Route::currentRouteName() == $routePrefix.'.sellerAnalyses.analysis')
	// Filter
	$(document).on('click', '.toggleCategoryhBox', function() {
		var catId = $(this).data('catid');
		if ($('#showFilterStatus_'+catId).is(':visible')) {
			$('#plus_'+catId).show();
			$('#minus_'+catId).hide();	
		} else {
			$('#minus_'+catId).show();
			$('#plus_'+catId).hide();
		}
		$('#showFilterStatus_'+catId).toggle(400);
	});
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
				// {data: 'created_at', name: 'created_at', orderable: false, searchable: false},
			@if ($isAllow || in_array('sellerAnalyses.beat-list', $allowedRoutes))
				{data: 'action', name: 'action', orderable: false, searchable: false},
			@endif
			],
			columnDefs: [
				{
				targets: [ 0 ],
				visible: false,
				searchable: false,
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
				// {data: 'created_at', name: 'created_at', orderable: false, searchable: false},
			@if ($isAllow || in_array('sellerAnalyses.store-list', $allowedRoutes))
				{data: 'action', name: 'action', orderable: false, searchable: false},
			@endif
			],
			columnDefs: [
				{
				targets: [ 0 ],
				visible: false,
				searchable: false,
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
				{data: 'name_1', name: 'name_1'},
				{data: 'phone_no_1', name: 'phone_no_1'},
				{data: 'beat_id', name: 'beat_id'},
				// {data: 'distribution_area_id', name: 'distribution_area_id'},
				{data: 'email', name: 'email'},
				{data: 'store_name', name: 'store_name'},
				{data: 'grade_id', name: 'grade_id'},
			@if ($isAllow || in_array('sellerAnalyses.category-list', $allowedRoutes))
				{data: 'action', name: 'action', orderable: false, searchable: false},
			@endif
			],
			columnDefs: [
				{
				targets: [ 0 ],
				visible: false,
				searchable: false,
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
</script>