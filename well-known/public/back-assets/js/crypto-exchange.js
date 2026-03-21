$(function(e){
  'use strict'
  
	/* Chartjs (#bitcoin-chart) */
	var ctx = $('#bitcoin-chart');
	ctx.height(110);
	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ['Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5', 'Date 6', 'Date 7', 'Date 8', 'Date 9', 'Date 10', 'Date 11', 'Date 12', 'Date 13', 'Date 14', 'Date 15', 'Date 16', 'Date 17', 'Date 18', 'Date 19', 'Date 20', 'Date 21', 'Date 22', 'Date 23', 'Date 24',],
			type: 'line',
			datasets: [{
				data: [45, 25, 32, 67, 49, 72, 52, 55, 46, 54, 32, 74, 88, 96, 36, 32, 48, 54, 87, 88, 96, 53, 21, 24, 14, 58, 78, 55, 41, 21, 45, 54, 51, 52, 48],
				label: 'Bitcoin Price',
				backgroundColor: 'rgba(33 ,79 ,190 ,0.05)',
				borderColor: '#214fbe',
				borderWidth: '2',
				pointBorderColor: 'transparent',
				pointBackgroundColor: 'transparent',
				lineTension:0.2,
				borderDash: [10,5]
			}]
		},
		options: {
			maintainAspectRatio: false,
			legend: {
				display: false
			},
			responsive: true,
			tooltips: {
				mode: 'index',
				titleFontSize: 12,
				titleFontColor: '#7886a0',
				bodyFontColor: '#7886a0',
				backgroundColor: '#fff',
				titleFontFamily: 'Montserrat',
				bodyFontFamily: 'Montserrat',
				cornerRadius: 3,
				intersect: false,
			},
			scales: {
				xAxes: [{
					gridLines: {
						color: 'transparent',
						zeroLineColor: 'transparent'
					},
					ticks: {
						fontSize: 2,
						fontColor: 'transparent'
					}
				}],
				yAxes: [{
					display: false,
					ticks: {
						display: false,
					}
				}]
			},
			title: {
				display: false,
			},
			elements: {
				line: {
					borderWidth: 1
				},
				point: {
					radius: 4,
					hitRadius: 10,
					hoverRadius: 4
				}
			}
		}
	});
	/* Chartjs (#bitcoin-chart) */
	
	
	/* Chartjs (#ethereum-chart) */
	var ctx = $('#ethereum-chart');
	ctx.height(110);
	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ['Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5', 'Date 6', 'Date 7', 'Date 8', 'Date 9', 'Date 10', 'Date 11', 'Date 12', 'Date 13', 'Date 14', 'Date 15', 'Date 16', 'Date 17', 'Date 18', 'Date 19', 'Date 20', 'Date 21', 'Date 22', 'Date 23', 'Date 24',],
			type: 'line',
			datasets: [{
				data: [88, 96, 36, 32, 48, 54, 87, 88, 96, 53, 21, 24, 14, 45, 25, 32, 67, 49, 72, 52, 55, 46, 54, 32, 74, 58, 78, 55, 41, 21, 45, 54, 51, 52, 48],
				label: 'Ethereum Price',
				backgroundColor: 'rgba(299 ,77 ,38 ,0.1)',
				borderColor: '#e54d26',
				borderWidth: '2',
				pointBorderColor: 'transparent',
				pointBackgroundColor: 'transparent',
				lineTension:0.2,
				borderDash: [10,5]
			}]
		},
		options: {
			maintainAspectRatio: false,
			legend: {
				display: false
			},
			responsive: true,
			tooltips: {
				mode: 'index',
				titleFontSize: 12,
				titleFontColor: '#7886a0',
				bodyFontColor: '#7886a0',
				backgroundColor: '#fff',
				titleFontFamily: 'Montserrat',
				bodyFontFamily: 'Montserrat',
				cornerRadius: 3,
				intersect: false,
			},
			scales: {
				xAxes: [{
					gridLines: {
						color: 'transparent',
						zeroLineColor: 'transparent'
					},
					ticks: {
						fontSize: 2,
						fontColor: 'transparent'
					}
				}],
				yAxes: [{
					display: false,
					ticks: {
						display: false,
					}
				}]
			},
			title: {
				display: false,
			},
			elements: {
				line: {
					borderWidth: 1
				},
				point: {
					radius: 4,
					hitRadius: 10,
					hoverRadius: 4
				}
			}
		}
	});
	/* Chartjs (#ethereum-chart) */
	
	/* Chartjs (#ripple-chart) */
	var ctx = $('#ripple-chart');
	ctx.height(110);
	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ['Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5', 'Date 6', 'Date 7', 'Date 8', 'Date 9', 'Date 10', 'Date 11', 'Date 12', 'Date 13', 'Date 14', 'Date 15', 'Date 16', 'Date 17', 'Date 18', 'Date 19', 'Date 20', 'Date 21', 'Date 22', 'Date 23', 'Date 24',],
			type: 'line',
			datasets: [{
				data: [58, 78, 55, 41, 21, 45, 54, 51, 52, 48, 88, 96, 36, 32, 48, 24, 14, 45, 25, 32, 67, 49, 54, 87, 88, 96, 53, 21, 72, 52, 55, 46, 54, 32, 74],
				label: 'Ripple Price',
				backgroundColor: 'rgba(255 ,158 ,1 ,0.1)',
				borderColor: '#ff9e01',
				borderWidth: '2',
				pointBorderColor: 'transparent',
				pointBackgroundColor: 'transparent',
				lineTension:0.2,
				borderDash: [10,5]
			}]
		},
		options: {
			maintainAspectRatio: false,
			legend: {
				display: false
			},
			responsive: true,
			tooltips: {
				mode: 'index',
				titleFontSize: 12,
				titleFontColor: '#7886a0',
				bodyFontColor: '#7886a0',
				backgroundColor: '#fff',
				titleFontFamily: 'Montserrat',
				bodyFontFamily: 'Montserrat',
				cornerRadius: 3,
				intersect: false,
			},
			scales: {
				xAxes: [{
					gridLines: {
						color: 'transparent',
						zeroLineColor: 'transparent'
					},
					ticks: {
						fontSize: 2,
						fontColor: 'transparent'
					}
				}],
				yAxes: [{
					display: false,
					ticks: {
						display: false,
					}
				}]
			},
			title: {
				display: false,
			},
			elements: {
				line: {
					borderWidth: 1
				},
				point: {
					radius: 4,
					hitRadius: 10,
					hoverRadius: 4
				}
			}
		}
	});
	/* Chartjs (#ripple-chart) */
	
	/* Chartjs (#dash-chart) */
	var ctx = $('#dash-chart');
	ctx.height(110);
	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ['Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5', 'Date 6', 'Date 7', 'Date 8', 'Date 9', 'Date 10', 'Date 11', 'Date 12', 'Date 13', 'Date 14', 'Date 15', 'Date 16', 'Date 17', 'Date 18', 'Date 19', 'Date 20', 'Date 21', 'Date 22', 'Date 23', 'Date 24',],
			type: 'line',
			datasets: [{
				data: [88, 96, 36, 32, 48, 24, 14, 45, 25, 32, 45, 54, 51, 52, 48, 54, 67, 49, 58, 78, 55, 41, 21, 87, 88, 96, 53, 21, 72, 52, 55, 46, 54, 32, 74],
				label: 'Dash-price',
				backgroundColor: 'rgba(0 ,174 ,255 ,0.1)',
				borderColor: '#00aeff',
				borderWidth: '2',
				pointBorderColor: 'transparent',
				pointBackgroundColor: 'transparent',
				lineTension:0.2,
				borderDash: [10,5]
			}]
		},
		options: {
			maintainAspectRatio: false,
			legend: {
				display: false
			},
			responsive: true,
			tooltips: {
				mode: 'index',
				titleFontSize: 12,
				titleFontColor: '#7886a0',
				bodyFontColor: '#7886a0',
				backgroundColor: '#fff',
				titleFontFamily: 'Montserrat',
				bodyFontFamily: 'Montserrat',
				cornerRadius: 3,
				intersect: false,
			},
			scales: {
				xAxes: [{
					gridLines: {
						color: 'transparent',
						zeroLineColor: 'transparent'
					},
					ticks: {
						fontSize: 2,
						fontColor: 'transparent'
					}
				}],
				yAxes: [{
					display: false,
					ticks: {
						display: false,
					}
				}]
			},
			title: {
				display: false,
			},
			elements: {
				line: {
					borderWidth: 1
				},
				point: {
					radius: 4,
					hitRadius: 10,
					hoverRadius: 4
				}
			}
		}
	});
	/* Chartjs (#dash-chart) */
	
	/* Chartjs (#neo-chart) */
	var ctx = $('#neo-chart');
	ctx.height(110);
	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ['Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5', 'Date 6', 'Date 7', 'Date 8', 'Date 9', 'Date 10', 'Date 11', 'Date 12', 'Date 13', 'Date 14', 'Date 15', 'Date 16', 'Date 17', 'Date 18', 'Date 19', 'Date 20', 'Date 21', 'Date 22', 'Date 23', 'Date 24', ],
			type: 'line',
			datasets: [{
				data: [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46],
				label: 'Neo-price',
				backgroundColor: 'rgba(38 ,156 ,142 ,0.1)',
				borderColor: '#269c8e',
				borderWidth: '2',
				pointBorderColor: 'transparent',
				pointBackgroundColor: 'transparent',
				lineTension:0.2,
				borderDash: [10,5]
			}]
		},
		options: {
			maintainAspectRatio: false,
			legend: {
				display: false
			},
			responsive: true,
			tooltips: {
				mode: 'index',
				titleFontSize: 12,
				titleFontColor: '#7886a0',
				bodyFontColor: '#7886a0',
				backgroundColor: '#fff',
				titleFontFamily: 'Montserrat',
				bodyFontFamily: 'Montserrat',
				cornerRadius: 3,
				intersect: false,
			},
			scales: {
				xAxes: [{
					gridLines: {
						color: 'transparent',
						zeroLineColor: 'transparent'
					},
					ticks: {
						fontSize: 2,
						fontColor: 'transparent'
					}
				}],
				yAxes: [{
					display: false,
					ticks: {
						display: false,
					}
				}]
			},
			title: {
				display: false,
			},
			elements: {
				line: {
					borderWidth: 1
				},
				point: {
					radius: 4,
					hitRadius: 10,
					hoverRadius: 4
				}
			}
		}
	});
	/* Chartjs (#neo-chart) */
	
	
	/* Chartjs (#litecoin-chart) */
	var ctx = $('#litecoin-chart');
	ctx.height(110);
	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ['Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5', 'Date 6', 'Date 7', 'Date 8', 'Date 9', 'Date 10', 'Date 11', 'Date 12', 'Date 13', 'Date 14', 'Date 15', 'Date 16', 'Date 17', 'Date 18', 'Date 19', 'Date 20', 'Date 21', 'Date 22', 'Date 23', 'Date 24',],
			type: 'line',
			datasets: [{
				data: [54, 35, 24, 64, 43, 55, 39,60, 61, 54, 62, 63, 44, 55, 64, 34, 46, 34,  64, 50,  34, 53, 4,  43, 45, 60, 54, 41, 45, 26, 45, 21, 45, 64],
				label: 'Litecoin-price',
				backgroundColor: 'rgba(95 ,29 ,215 ,0.1)',
				borderColor: '#5f1dd7',
				borderWidth: '2',
				pointBorderColor: 'transparent',
				pointBackgroundColor: 'transparent',
				lineTension:0.2,
				borderDash: [10,5]
			}]
		},
		options: {
			maintainAspectRatio: false,
			legend: {
				display: false
			},
			responsive: true,
			tooltips: {
				mode: 'index',
				titleFontSize: 12,
				titleFontColor: '#7886a0',
				bodyFontColor: '#7886a0',
				backgroundColor: '#fff',
				titleFontFamily: 'Montserrat',
				bodyFontFamily: 'Montserrat',
				cornerRadius: 3,
				intersect: false,
			},
			scales: {
				xAxes: [{
					gridLines: {
						color: 'transparent',
						zeroLineColor: 'transparent'
					},
					ticks: {
						fontSize: 2,
						fontColor: 'transparent'
					}
				}],
				yAxes: [{
					display: false,
					ticks: {
						display: false,
					}
				}]
			},
			title: {
				display: false,
			},
			elements: {
				line: {
					borderWidth: 1
				},
				point: {
					radius: 4,
					hitRadius: 10,
					hoverRadius: 4
				}
			}
		}
	});
	/* Chartjs (#dash-chart) */
	
	
	
});