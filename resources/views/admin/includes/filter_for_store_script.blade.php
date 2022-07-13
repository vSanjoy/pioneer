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
    // Distribution area on change
    $('#distribution_area_id, #distributor_id, #beat_id, #store_id, #name_1_id, #grade_id').on('change', function() {
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