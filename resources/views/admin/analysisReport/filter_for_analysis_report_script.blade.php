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

    $('#distributor_id, #distribution_area_id, #store_id').on('change', function() {
		urlBuilder();
    });
});


// Filter according to the options selected
$(document).on('click', '.filterList', function() {
	urlBuilder();
	$('.export-analysis').show();
});

// Export
$(document).on('click', '.export-analysis', function() {
	var dateRange  			= $('#date_range').val();
	var distributorId		= $('#distributor_id').val();
	var distributionAreaId	= $('#distribution_area_id').val();
	var storeId				= $('#store_id').val();
		
	var exportWithFilter = "{{route($routePrefix.'.'.$pageRoute.'.export')}}?date_range=" + dateRange + "&distributor_id=" + distributorId + "&distribution_area_id=" + distributionAreaId + "&store_id=" + storeId;
	
	var win = window.open(exportWithFilter, '_blank');
	if (win) {
		win.focus();
	} else {
		alert('Please allow popups for this website');
	}
});

// Reset Filter
$(document).on('click', '.resetFilter', function() {
	var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}";
	window.history.pushState({href: getListUrlWithFilter}, '', getListUrlWithFilter);
	$('#showFilterStatus')[0].reset();
	window.location.reload();
});