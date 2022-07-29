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
// Filter according to the options selected
$(document).on('click', '.filterList', function() {
	var distributionAreaId = $('#distributionareaid').val();
	if (distributionAreaId != '') {
		var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}?distribution_area_id="+distributionAreaId;
		window.history.pushState({href: getListUrlWithFilter}, '', getListUrlWithFilter);
		getList();
	} else {
		var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}";
		window.history.pushState({href: getListUrlWithFilter}, '', getListUrlWithFilter);
		getList();
	}
});
// Filter on change
$('#distributionareaid').on('change', function() {
	var distributionAreaId = $(this).val();
	if (distributionAreaId != '') {
		var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}?distribution_area_id="+distributionAreaId;
		window.history.pushState({href: getListUrlWithFilter}, '', getListUrlWithFilter);
		getList();
	} else {
		var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}";
		window.history.pushState({href: getListUrlWithFilter}, '', getListUrlWithFilter);
		getList();
	}
});
// Reset Filter
$(document).on('click', '.resetFilter', function() {
	var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}";
	window.history.pushState({href: getListUrlWithFilter}, '', getListUrlWithFilter);
	$('#showFilterStatus')[0].reset();
	$("#distributionareaid").selectpicker("refresh");
	getList();
});