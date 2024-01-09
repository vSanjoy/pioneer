<script type="text/javascript">
$(document).ready(function() {
	@if (Route::currentRouteName() == $routePrefix.'.payment.history')
	getList();

	@include($routePrefix.'.'.$pageRoute.'.filter_for_payment_script')

	@endif
});


@if (Route::currentRouteName() == $routePrefix.'.payment.history')
// Get list page data
function getList() {
	var dateRange	= $('#date_range').val();
	var beatId		= $('#beat_id').val();
	var storeId		= $('#store_id').val();
	
	var getListDataUrl = "{{route($routePrefix.'.payment.ajax-list-history-request')}}";	
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
				url: getListDataUrl + '?date_range=' + dateRange + '&beat_id=' + beatId + '&store_id=' + storeId,
				type: 'POST',
				data: function(data) {},
			},
			columns: [
				// {data: 'id', name: 'id'},
				{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
				{data: 'date', name: 'date'},
				{data: 'beat_id', name: 'beat_id'},
				{data: 'store_id', name: 'store_id'},
				{data: 'store_owner', name: 'store_owner'},
				{data: 'store_phone', name: 'store_phone'},
				{data: 'total_amount', name: 'total_amount'},
				{data: 'payment_mode', name: 'payment_mode'},
				{data: 'action', name: 'action'},
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
	var dateRange	= $('#date_range').val();
	var beatId		= $('#beat_id').val();
	var storeId		= $('#store_id').val();
	
	if (dateRange != '' || beatId != '' || storeId != '') {
		var getListUrlWithFilter = "{{route($routePrefix.'.payment.history')}}?date_range=" + dateRange + "&beat_id=" + beatId + "&store_id=" + storeId;
		window.history.pushState({href: getListUrlWithFilter}, '', getListUrlWithFilter);
		getList();

		$('#payment-history-list').css({'display':'block'});
	} else {
		var getListUrlWithFilter = "{{route($routePrefix.'.payment.history')}}";
		window.history.pushState({href: getListUrlWithFilter}, '', getListUrlWithFilter);
		getList();

		$('#payment-history-list').css({'display':'none'});
	}
}

// Beat wise store ==> History Page
$(document).on('change', '#beat_id', function() {
	var beatId 	= $(this).val();

	$('.preloader').show();
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: adminPanelUrl + '/payment/ajax-beat-wise-store',
		method: 'POST',
		data: {
			beat_id: beatId
		},
		success: function (response) {
			$('.preloader').hide();
			$("#store_id").html(response.options).selectpicker('refresh');
		}
	});
});

// View payment details ==> History Page
$(document).on('click', '.viewPaymentModal', function() {
	var paymentId 	= $(this).data('paymentid');
	$('#no-records-found, #records-found').css({'display':'none'});

	if (paymentId != '') {
		$('.preloader').show();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: adminPanelUrl + '/payment/ajax-payment-view-details',
			method: 'POST',
			data: {
				payment_id: paymentId
			},
			success: function (response) {
				$('.preloader').hide();

				if (response.type = 'success') {
					$("#view-distribution-area").html(response.distributionArea);
					$("#view-beat").html(response.beat);
					$("#view-store").html(response.store);
					$("#view-store-owner").html(response.storeOwner);
					$("#view-store-phone").html(response.storePhone);
					$("#view-date").html(response.date);
					$("#view-total-amount").html(response.totalAmount);
					$("#view-payment-mode").html(response.paymentMode);
					$("#view-payment-detail").html(response.paymentDetail);
					$("#view-note").html(response.note);

					$('#records-found').css({'display':'block'});
				} else {
					$('#no-records-found').css({'display':'block'});
				}
			}
		});
	}
});

// Edit payment details ==> History Page
$(document).on('click', '.editPaymentModal', function() {
	var paymentId 	= $(this).data('paymentid');
	if (paymentId != '') {
		$('.preloader').show();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: adminPanelUrl + '/payment/ajax-payment-view-details',
			method: 'POST',
			data: {
				payment_id: paymentId
			},
			success: function (response) {
				$('.preloader').hide();

				if (response.type = 'success') {
					$('#payment-edit-id').val(response.paymentEditId);
					$('#edit-store-details-area').html(' - ' + response.store +' (' + response.storeOwner +' - ' + response.storePhone + ')');
					$('#date').val(response.nonFormattedDate);
					$("#total-amount").val(response.totalAmount);
					$("#payment-mode").val(response.paymentMode);
					$("#payment-details").val(response.paymentDetail);
					$("#note").val(response.note);
				} else {
					// $('#no-records-found').css({'display':'block'});
				}
			}
		});
	}
});

// Update payment details ==> History Page
$(document).on('click', '.updatePayment', function() {
	var paymentEditId	= $('#payment-edit-id').val();
	var date 			= $('#date').val();
	var totalAmount		= $('#total-amount').val();
	var password		= $('#password').val();
	var paymentMode		= $('#payment-mode').val();
	var paymentDetails	= $('#payment-details').val();
	var note			= $('#note').val();

	if (paymentEditId != '' && date != '' && totalAmount != '' && password != '') {
		updatePayment(paymentEditId, date, totalAmount, password, paymentMode, paymentDetails, note);
	}
});

@endif

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

@if (Route::currentRouteName() == $routePrefix.'.payment.collect')
// Distributor and on beat wise store ==> Collect Page
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
@endif
</script>