<script type="text/javascript">
$(document).ready(function() {
	@if (Route::currentRouteName() == $routePrefix.'.'.$listUrl)
	getList();

	@include($routePrefix.'.'.$pageRoute.'.filter_for_order_script')

	// Delete section
	$(document).on('click', '.delete', function() {
		var id = $(this).data('id');
		var actionType 	= $(this).data('action-type');
		listActionsWithFilter('{{ $pageRoute }}', 'delete', id, actionType);
	});

	// Bulk Action
	$('.bulkAction').on('click', function() {
		var selectedIds = [];
		$("input:checkbox[class=delete_checkbox]:checked").each(function () {
			selectedIds.push($(this).val());
		});

		if (selectedIds.length > 0) {
			var actionType = $(this).data('action-type');
			bulkActionsWithFilter('{{ $pageRoute }}', 'bulk-actions', selectedIds, actionType);
		} else {
			toastr.error("@lang('custom_admin.error_no_checkbox_checked')", "@lang('custom_admin.message_error')!");
		}
	});
	@endif

});

@if (Route::currentRouteName() == $routePrefix.'.'.$listUrl)
	// Get list page data
	function getList() {
		var dateRange			= $('#date_range').val();
		var distributionAreaId	= $('#distribution_area_id').val();
		var beatId				= $('#beat_id').val();
		var storeId				= $('#store_id').val();
		var orderStatus			= $('#order_status').val();
		
		var getListDataUrl = "{{route($routePrefix.'.'.$listRequestUrl)}}";	
		var dTable = $('#list-table').on('init.dt', function () {$('#dataTableLoading').hide();}).DataTable({
				fixedColumns: {
					left: 0,
				    right: 2
				},
				destroy: true,
				autoWidth: false,
				responsive: false,
				scrollX: true,
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
					url: getListDataUrl + '?date_range=' + dateRange + '&distribution_area_id=' + distributionAreaId + '&store_id=' + storeId + '&beat_id=' + beatId + '&order_status=' + orderStatus,
					type: 'POST',
					data: function(data) {},
				},
				columns: [		
				@if ($isAllow || in_array($statusUrl, $allowedRoutes) || in_array($deleteUrl, $allowedRoutes))
				{
					data: 'id',
					orderable: false,
					searchable: false,
					render: function ( data, type, row ) {
						if ( type === 'display' ) {
							return '<div class="custom-control custom-checkbox"><input type="checkbox" class="delete_checkbox" id="customCheck2_'+row.id+'" value="'+row.id+'"><label class="" for="customCheck2_'+row.id+'"></label></div>';
						}
						return data;
					},
				},
			@endif	
					{data: 'id', name: 'id'},
					{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
					{data: 'created_at', name: 'created_at'},
					{data: 'unique_order_id', name: 'unique_order_id'},
					@if (\Auth::guard('admin')->user()->type != 'S')
					{data: 'seller_id', name: 'seller_id'},
					@endif
					{data: 'distribution_area_id', name: 'distribution_area_id'},
					{data: 'beat_id', name: 'beat_id'},
					{data: 'store_id', name: 'store_id'},
					{data: 'analysis_season_id', name: 'analysis_season_id'},
					{data: 'order_status', name: 'order_status'},
				@if ($isAllow || in_array($viewUrl, $allowedRoutes))
					{data: 'action', name: 'action', orderable: false, searchable: false},
				@endif
				],
				columnDefs: [
					{
				@if ($isAllow || in_array($statusUrl, $allowedRoutes) || in_array($deleteUrl, $allowedRoutes))
					targets: [ 1 ],
				@else
					targets: [ 0 ],
				@endif
					visible: false,
					searchable: false,
					},
				],
				order: [
				@if ($isAllow || in_array($statusUrl, $allowedRoutes) || in_array($deleteUrl, $allowedRoutes))
					[1, 'desc']
				@else
					[0, 'desc']
				@endif
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

	// Filter
	function urlBuilder() {
		var dateRange  			= $('#date_range').val();
		var distributionAreaId	= $('#distribution_area_id').val();
		var beatId				= $('#beat_id').val();
		var storeId				= $('#store_id').val();
		var orderStatus			= $('#order_status').val();
		
		if (dateRange != '' || distributionAreaId != '' || beatId != '' || storeId != '') {
			var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}?date_range=" + dateRange + "&distribution_area_id=" + distributionAreaId + "&store_id=" + storeId + "&beat_id=" + beatId + "&order_status=" + orderStatus;
			window.history.pushState({href: getListUrlWithFilter}, '', getListUrlWithFilter);
			getList();
		} else {
			var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}";
			window.history.pushState({href: getListUrlWithFilter}, '', getListUrlWithFilter);
			getList();
		}
	}
@endif
</script>