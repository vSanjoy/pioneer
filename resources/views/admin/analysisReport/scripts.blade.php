<script type="text/javascript">
$(document).ready(function() {
	@if (Route::currentRouteName() == $routePrefix.'.'.$listUrl)
	// Get list page data
	getList();

	@endif

	@include($routePrefix.'.'.$pageRoute.'.filter_for_analysis_report_script')

});

@if (Route::currentRouteName() == $routePrefix.'.'.$listUrl)
	// Get list of records
	function getList() {
		var dateRange			= $('#date_range').val();
		var distributorId		= $('#distributor_id').val();
		var distributionAreaId	= $('#distribution_area_id').val();
		var storeId				= $('#store_id').val();

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
					url: getListDataUrl + '?date_range=' + dateRange + '&distributor_id=' + distributorId + '&distribution_area_id=' + distributionAreaId + '&store_id=' + storeId,
					type: 'POST',
					data: function(data) {},
				},
				createdRow: function( row, data, dataIndex ) {
					$(row).addClass('listTable');
				},
				// scrollY: {{ config('global.DATATABLE_SCROLL_HEIGHT') }},
        		// scrollX: true,
				columns: [
					{data: 'id', name: 'id'},
					{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
					{data: 'analysis_date', name: 'analysis_date'},
					{data: 'analysis_season_id', name: 'analysis_season_id'},
					{data: 'distribution_area_id', name: 'distribution_area_id'},
					{data: 'distributor_id', name: 'distributor_id'},
					{data: 'distributor_company', name: 'distributor_company'},
					{data: 'distributor_phone', name: 'distributor_phone'},
					{data: 'store_id', name: 'store_id'},
					{data: 'store_phone', name: 'store_phone'},
					{data: 'beat_id', name: 'beat_id'},
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

	// Filter
	function urlBuilder() {
		var dateRange  			= $('#date_range').val();
		var distributorId		= $('#distributor_id').val();
		var distributionAreaId	= $('#distribution_area_id').val();
		var storeId				= $('#store_id').val();
		
		if (dateRange != '' || distributorId != '' || distributionAreaId != '') {
			var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}?date_range=" + dateRange + "&distributor_id=" + distributorId + "&distribution_area_id=" + distributionAreaId + "&store_id=" + storeId;
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