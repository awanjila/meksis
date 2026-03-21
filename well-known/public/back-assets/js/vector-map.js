$(function() {
	'use strict';
	$('#vmap').vectorMap({
		map: 'world_en',
		backgroundColor: 'transparent',
		color: '#ffffff',
		hoverOpacity: 0.7,
		selectedColor: '#214fbe',
		enableZoom: true,
		showTooltip: true,
		scaleColors: ['#214fba', '#214fb5'],
		values: sample_data,
		normalizeFunction: 'polynomial'
	});
	$('#vmap2').vectorMap({
		map: 'usa_en',
		color: '#214fbe',
		showTooltip: true,
		backgroundColor: 'transparent',
		hoverColor: '#214fbe'
	});
	 $('#vmap3').vectorMap({
		map: 'canada_en',
		backgroundColor: null,
		color: '#214fbe',
		hoverColor: '#214fbe',
		enableZoom: false,
		showTooltip: false
	});

});