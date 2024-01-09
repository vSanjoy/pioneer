// On change filters
$(function() {
	$('#date_range').on('apply.daterangepicker', function(ev, picker) {
		urlBuilder();

		$('.export-analysis').show();
	});

    $('#beat_id, #store_id').on('change', function() {
    	urlBuilder();
    });
});


// Filter according to the options selected
$(document).on('click', '.filterList', function() {
	urlBuilder();
});

// Reset Filter
$(document).on('click', '.resetFilter', function() {
	var getListUrlWithFilter = "{{route($routePrefix.'.payment.history')}}";
	window.history.pushState({href: getListUrlWithFilter}, '', getListUrlWithFilter);
	$('#showFilterStatus')[0].reset();
	window.location.reload();
});