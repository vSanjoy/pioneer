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
	var seasonId			= $('#season_id').val();
	var distributionAreaId	= $('#distribution_area_id').val();
	var distributorId		= $('#distributor_id').val();
	var storeId				= $('#store_id').val();
	var categoryId			= $('#category_id').val();
	var productId			= $('#product_id').val();

	if (seasonId != '' || distributionAreaId != '' || distributorId != '' || storeId != '' || categoryId != '' || productId != '') {
		var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}?season_id=" + seasonId + "&distribution_area_id=" + distributionAreaId + "&distributor_id=" + distributorId + "&store_id=" + storeId + "&category_id=" + categoryId + "&product_id=" + productId;
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
	window.location.reload();
});