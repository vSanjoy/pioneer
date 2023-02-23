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

// On change filters
$(function() {
	$('#date_range').on('apply.daterangepicker', function(ev, picker) {
		urlBuilder();

		$('.export-analysis').show();
	});

    $('#distribution_area_id, #beat_id, #store_id').on('change', function() {
		urlBuilder();
    });
});


// Filter according to the options selected
$(document).on('click', '.filterList', function() {
	urlBuilder();
});

// Reset Filter
$(document).on('click', '.resetFilter', function() {
	var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}";
	window.history.pushState({href: getListUrlWithFilter}, '', getListUrlWithFilter);
	$('#showFilterStatus')[0].reset();
	window.location.reload();
});