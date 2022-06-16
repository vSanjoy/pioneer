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
	var categoryId = $('#categoryid').val();
	if (categoryId != '') {
		var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}?category_id="+categoryId;
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
	{{-- $('#categoryid option:selected').removeAttr('selected'); --}}
	$("#categoryid").selectpicker("refresh");
	getList();
});