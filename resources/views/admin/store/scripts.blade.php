<script type="text/javascript">
$(document).ready(function() {
	@if (Route::currentRouteName() == $routePrefix.'.'.$listUrl)
	// Get list page data
	getList();

	// Status section
	$(document).on('click', '.status', function() {
		var id 			= $(this).data('id');
		var actionType 	= $(this).data('action-type');
		listActionsWithFilter('{{ $pageRoute }}', 'status', id, actionType);
	});
	
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

	@include($routePrefix.'.includes.filter_for_store_script')

});

@if (Route::currentRouteName() == $routePrefix.'.'.$listUrl)
// Get list of records
function getList() {
	var distributionAreaId	= $('#distribution_area_id').val();
	var distributorId 		= $('#distributor_id').val();
	var beatId 				= $('#beat_id').val();
	var storeId 			= $('#store_id').val();
	var name1Id 			= $('#name_1_id').val();

	var getListDataUrl = "{{route($routePrefix.'.'.$listRequestUrl)}}";	
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
	        	url: getListDataUrl + '?distribution_area_id=' + distributionAreaId + '&distributor_id=' + distributorId + '&beat_id=' + beatId + '&store_id=' + storeId + '&name_1_id=' + name1Id,
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
				{data: 'name_1', name: 'name_1'},
				{data: 'phone_no_1', name: 'phone_no_1'},
				{data: 'beat_name', name: 'beat_name'},
				{data: 'distribution_area_id', name: 'distribution_area_id'},
				{data: 'email', name: 'email'},
				{data: 'store_name', name: 'store_name'},
				{data: 'sale_size_category', name: 'sale_size_category'},
				{data: 'integrity', name: 'integrity'},
				// {data: 'updated_at', name: 'updated_at', orderable: false, searchable: false},
				{data: 'status', name: 'status'},
			@if ($isAllow || in_array($editUrl, $allowedRoutes))
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

// Filter
function urlBuilder() {
	var distributionAreaId  = $('#distribution_area_id').val();
    var distributorId		= $('#distributor_id').val();
    var beatId              = $('#beat_id').val();
    var storeId             = $('#store_id').val();
    var name1Id             = $('#name_1_id').val();

    if (distributionAreaId != '' || distributorId != '' || beatId != '' || storeId != '' || name1Id != '') {
		var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}?distribution_area_id=" + distributionAreaId + "&distributor_id=" + distributorId + "&beat_id=" + beatId + "&store_id=" + storeId + "&name_1_id=" + name1Id;
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