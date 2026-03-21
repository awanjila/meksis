$(function(e){
 
	
	
	
	
	/* Peity charts */
 
	$('.peity-donut').peity('donut');
	
	
	/*LIne-Chart */
	var ctx = document.getElementById("revenuechart").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'line',

		data: {
			labels: ["sun", "mon", "tue", "wed", "thur", "fri", "sat"],
			datasets: [{
				label: 'Order',
				data: [30, 150, 65, 160, 70, 130, 70, 120],
				borderWidth: 3,
				backgroundColor: 'transparent',
				borderColor: '#601ed7',
				pointBackgroundColor: '#601ed7',
				pointRadius: 0,
			},
			{
				label: 'Sale',
				data: [50, 90, 210, 90, 150, 75, 200],
				borderWidth: 3,
				backgroundColor: 'transparent',
				borderColor: '#c4c6ca',
				pointBackgroundColor: '#c4c6ca',
				pointRadius: 0,
				borderDash:[5,9],
			}]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			tooltips: {
				enabled: true,
			},
			tooltips: {
				mode: 'index',
				intersect: false,
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
					ticks: {
						fontColor: "#c8ccdb",
					},
					barPercentage: 0.7,
					display: true,
					gridLines: {
						color:'rgba(119, 119, 142, 0.2)',
						zeroLineColor: 'rgba(119, 119, 142, 0.2)',
					}
				}],
				yAxes: [{
					ticks: {
						fontColor: "#77778e",
					},
					display: true,
					gridLines: {
						color:'rgba(119, 119, 142, 0.2)',
						zeroLineColor: 'rgba(119, 119, 142, 0.2)',
					},
					ticks: {
					  min: 0,
					  max: 250,
					  stepSize: 50
                },
					scaleLabel: {
						display: true,
						labelString: 'Thousands',
						fontColor: 'transparent'
					}
				}]
			},
			legend: {
				display: true,
				width:30,
				height:30,
				borderRadius:50,
				labels: {
					fontColor: "#77778e"
				},
			},
		}
	});

	/* doughnut Chart*/ 
	Chart.defaults.RoundedDoughnut    = Chart.helpers.clone(Chart.defaults.doughnut);
		Chart.controllers.RoundedDoughnut = Chart.controllers.doughnut.extend({
		draw: function(ease) {
			var ctx           = this.chart.ctx;
			var easingDecimal = ease || 1;
			var arcs          = this.getMeta().data;
			Chart.helpers.each(arcs, function(arc, i) {
				arc.transition(easingDecimal).draw();

				var pArc   = arcs[i === 0 ? arcs.length - 1 : i - 1];
				var pColor = pArc._view.backgroundColor;

				var vm         = arc._view;
				var radius     = (vm.outerRadius + vm.innerRadius) / 2;
				var thickness  = (vm.outerRadius - vm.innerRadius) / 2;
				var startAngle = Math.PI - vm.startAngle - Math.PI / 2;
				var angle      = Math.PI - vm.endAngle - Math.PI / 2;

				ctx.save();
				ctx.translate(vm.x, vm.y);

				ctx.fillStyle = i === 0 ? vm.backgroundColor : pColor;
				ctx.beginPath();
				ctx.arc(radius * Math.sin(startAngle), radius * Math.cos(startAngle), thickness, 0, 2 * Math.PI);
				ctx.fill();

				ctx.fillStyle = vm.backgroundColor;
				ctx.beginPath();
				ctx.arc(radius * Math.sin(angle), radius * Math.cos(angle), thickness, 0, 2 * Math.PI);
				ctx.fill();

				ctx.restore();
			});
		}
	});
	if ($('#recentorders').length) {
		var ctx = document.getElementById("recentorders").getContext("2d");
		new Chart(ctx, {
			type: 'RoundedDoughnut',
			data: {
				labels: ['Delivered', 'Ordered', 'Cancelled', 'Hold'],
				datasets: [{
					data           : [20, 25, 15,40],
						backgroundColor: [
							'#ff9e01',
							'#00b220',
							'#f11111',
							'#373be5'
						],
						borderWidth    : 0,
					borderColor:'transparent',
				}]
			},
			options: {
				legend: {
					display: false
				},
				cutoutPercentage: 85,
				responsive: true,
			}
		});
	}	
	/* doughnut Chart*/ 
	
	
	
	
	
});