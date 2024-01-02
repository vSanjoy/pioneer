<script type="text/javascript">
$(document).ready(function() {
	getList();
});

// Get list page data
function getList() {
	var dateRange			= $('#date_range').val();
	var storeId				= $('#store_id').val();
	
	var getListDataUrl = "{{route($routePrefix.'.payment.ajax-list-report-request')}}";	
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
				url: getListDataUrl + '?date_range=' + dateRange + '&store_id=' + storeId,
				type: 'POST',
				data: function(data) {},
			},
			columns: [		
			
			
				{data: 'id', name: 'id'},
				{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
				{data: 'created_at', name: 'created_at'},
				{data: 'invoice_no', name: 'invoice_no'},
				{data: 'ref_no', name: 'ref_no'},
				{data: 'store_id', name: 'store_id'},
				{data: 'amount', name: 'amount'},
				{data: 'ref_no', name: 'ref_no'},
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
			pageLength: 10,
			lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, '{{trans("custom_admin.label_all")}}']],
			fnDrawCallback: function(settings) {
				// if (settings._iDisplayLength == -1 || settings._iDisplayLength > settings.fnRecordsDisplay()) {
					$('#list-table_paginate').hide();
				// } else {
				// 	$('#list-table_paginate').show();
				// }
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
	var storeId				= $('#store_id').val();
	
	if (dateRange != '' || storeId != '') {
		var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}?date_range=" + dateRange + "&store_id=" + storeId;
		window.history.pushState({href: getListUrlWithFilter}, '', getListUrlWithFilter);
		getList();
	} else {
		var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}";
		window.history.pushState({href: getListUrlWithFilter}, '', getListUrlWithFilter);
		getList();
	}
}

// Filter
$(document).on('click', '#toggleSearchBox', function() {
	if ($('#showFilterStatus').is(':visible')) {
		$('#plus').show();
		$('#minus').hide();	
	} else {
		$('#minus').show();
		$('#plus').hide();
	}
	$('#showFilterStatus').toggle(400);
});

// Distributor and on beat wise store
$(document).on('change', '#beat_id', function() {
	var distributionAreaId 	= $('#distribution_area_id').val();
	var beatId 	= $(this).val();

	$('.preloader').show();
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: adminPanelUrl + '/payment/ajax-distribution-area-beat-wise-store',
		method: 'POST',
		data: {
			distribution_area_id: distributionAreaId,
			beat_id: beatId
		},
		success: function (response) {
			$('.preloader').hide();
			$("#store_id").html(response.options).selectpicker('refresh');
		}
	});
});
</script>