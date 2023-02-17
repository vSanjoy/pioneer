<script type="text/javascript">
$(document).ready(function() {
	@if (Route::currentRouteName() == $routePrefix.'.'.$listUrl)
	// Get list page data
	getList();

	@endif

	@include($routePrefix.'.'.$pageRoute.'.filter_for_area_report_script')

});

@if (Route::currentRouteName() == $routePrefix.'.'.$listUrl)
	// Get list of records
	function getList() {
		var distributionAreaId	= $('#distribution_area_id').val();

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
					url: getListDataUrl + '?distribution_area_id=' + distributionAreaId,
					type: 'POST',
					data: function(data) {},
				},
				createdRow: function( row, data, dataIndex ) {
					$(row).addClass('listTable');
				},
				// scrollY: {{ config('global.DATATABLE_SCROLL_HEIGHT') }},
        		scrollX: true,
				columns: [
					{data: 'id', name: 'id'},
					{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
					{data: 'distribution_area_id', name: 'distribution_area_id'},
					{data: 'beat_id', name: 'beat_id'},
					{data: 'store_name', name: 'store_name'},
					{data: 'phone_no_1', name: 'phone_no_1'},
					{data: 'name_1', name: 'name_1'},
				],
				columnDefs: [
					{
					targets: [ 0 ],
					visible: false,
					searchable: false,
					},
				],
				order: [
					[2, 'ASC']
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
		var distributionAreaId	= $('#distribution_area_id').val();
		
		if (distributionAreaId != '') {
			var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}?distribution_area_id=" + distributionAreaId;
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