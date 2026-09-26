
'use strict';
$(document).ready(function() {
	buildchart()
	$(window).on('resize', function() {
		buildchart();
	});
	$('#mobile-collapse').on('click', function() {
		setTimeout(function() {
			buildchart();
		}, 700);
	});
});

function buildchart() {
	$(function() {
		//Flot Base Build Option for bottom join
		var options_bt = {
			legend: {
				show: false
			},
			series: {
				label: "",
				shadowSize: 0,
				curvedLines: {
					active: true,
					nrSplinePoints: 20
				},
			},
			tooltip: {
				show: true,
				content: "x : %x | y : %y"
			},
			grid: {
				hoverable: true,
				borderWidth: 0,
				labelMargin: 0,
				axisMargin: 0,
				minBorderMargin: 0,
				margin: {
					top: 5,
					left: 0,
					bottom: 0,
					right: 0,
				}
			},
			yaxis: {
				min: 0,
				max: 30,
				color: 'transparent',
				font: {
					size: 0,
				}
			},
			xaxis: {
				color: 'transparent',
				font: {
					size: 0,
				}
			}
		};

		//Flot Base Build Option for Center card
		var options_ct = {
			legend: {
				show: false
			},
			series: {
				label: "",
				shadowSize: 0,
				curvedLines: {
					active: true,
					nrSplinePoints: 20
				},
			},
			tooltip: {
				show: true,
				content: "x : %x | y : %y"
			},
			grid: {
				hoverable: true,
				borderWidth: 0,
				labelMargin: 0,
				axisMargin: 0,
				minBorderMargin: 5,
				margin: {
					top: 8,
					left: 8,
					bottom: 8,
					right: 8,
				}
			},
			yaxis: {
				min: 0,
				max: 30,
				color: 'transparent',
				font: {
					size: 0,
				}
			},
			xaxis: {
				color: 'transparent',
				font: {
					size: 0,
				}
			}
		};
		//Flot Earnings Chart Start
		$.plot($("#earninga-chart-1"), [{
			data: [
				[0, 30],
				[1, 5],
				[2, 26],
				[3, 10],
				[4, 22],
			],
			color: "#fff",
			lines: {
				show: true,
				fill: true,
				fillColor: "#fff",
				lineWidth: 0
			},
			points: {
				show: false,
				radius: 3,
				fill: false,
			},
			curvedLines: {
				apply: true,
			}
		}], options_bt);
		$.plot($("#earninga-chart-2"), [{
			data: [
				[0, 1],
				[1, 26],
				[2, 8],
				[3, 22],
				[4, 1],
			],
			color: "#fff",
			lines: {
				show: true,
				fill: true,
				fillColor: "#fff",
				lineWidth: 0
			},
			points: {
				show: false,
				radius: 3,
				fill: false,
			},
			curvedLines: {
				apply: true,
			}
		}], options_bt);
		$.plot($("#earninga-chart-3"), [{
			data: [
				[0, 30],
				[1, 5],
				[2, 26],
				[3, 10],
				[4, 22],
			],
			color: "#fff",
			lines: {
				show: true,
				fill: true,
				fillColor: "#fff",
				lineWidth: 0
			},
			points: {
				show: false,
				radius: 3,
				fill: false,
			},
			curvedLines: {
				apply: true,
			}
		}], options_bt);
		$.plot($("#earninga-chart-4"), [{
			data: [
				[0, 1],
				[1, 26],
				[2, 8],
				[3, 22],
				[4, 1],
			],
			color: "#fff",
			lines: {
				show: true,
				fill: true,
				fillColor: "#fff",
				lineWidth: 0
			},
			points: {
				show: false,
				radius: 3,
				fill: false,
			},
			curvedLines: {
				apply: true,
			}
		}], options_bt);

		//Flot Crypto Chart Start
		$.plot($("#crypto-chart-1"), [{
			data: [
				[0, 1],
				[1, 26],
				[2, 8],
				[3, 22],
				[4, 1],
			],
			color: "#716aca",
			lines: {
				show: true,
				fill: false,
				lineWidth: 3
			},
			points: {
				show: false,
				radius: 3,
				fill: true,
			},
			curvedLines: {
				apply: true,
			}
		}], options_ct);
		$.plot($("#crypto-chart-2"), [{
			data: [
				[0, 30],
				[1, 5],
				[2, 26],
				[3, 10],
				[4, 22],
			],
			color: "#28D094",
			lines: {
				show: true,
				fill: false,
				lineWidth: 3
			},
			points: {
				show: false,
				radius: 3,
				fill: true,
			},
			curvedLines: {
				apply: true,
			}
		}], options_ct);
		$.plot($("#crypto-chart-3"), [{
			data: [
				[0, 1],
				[1, 26],
				[2, 8],
				[3, 22],
				[4, 1],
			],
			color: "#ff4961",
			lines: {
				show: true,
				fill: false,
				lineWidth: 3
			},
			points: {
				show: false,
				radius: 3,
				fill: true,
			},
			curvedLines: {
				apply: true,
			}
		}], options_ct);
		$.plot($("#crypto-chart-4"), [{
			data: [
				[0, 30],
				[1, 5],
				[2, 26],
				[3, 10],
				[4, 22],
			],
			color: "#ff9149",
			lines: {
				show: true,
				fill: false,
				lineWidth: 3
			},
			points: {
				show: false,
				radius: 3,
				fill: true,
			},
			curvedLines: {
				apply: true,
			}
		}], options_ct);

		//Flot Ecommerce Chart Start
		$.plot($("#ecom-chart-1"), [{
			data: [
				[0, 30],
				[1, 5],
				[2, 26],
				[3, 10],
				[4, 22],
				[5, 30],
				[6, 5],
				[7, 26],
				[8, 10],
			],
			color: "#716aca",
			lines: {
				show: true,
				fill: false,
				lineWidth: 3
			},
			points: {
				show: true,
				radius: 4,
				fillColor: "#fff",
				fill: true,
			},
			curvedLines: {
				apply: false,
			}
		}], options_ct);
		$.plot($("#ecom-chart-2"), [{
			data: [
				[0, 1],
				[1, 26],
				[2, 8],
				[3, 22],
				[4, 1],
				[5, 26],
				[6, 8],
				[7, 22],
				[8, 1],
			],
			color: "#28d094",
			lines: {
				show: true,
				fill: false,
				lineWidth: 3
			},
			points: {
				show: true,
				radius: 4,
				fillColor: "#fff",
				fill: true,
			},
			curvedLines: {
				apply: false,
			}
		}], options_ct);
		$.plot($("#ecom-chart-3"), [{
			data: [
				[0, 30],
				[1, 5],
				[2, 26],
				[3, 10],
				[4, 22],
				[5, 30],
				[6, 5],
				[7, 26],
				[8, 10],
			],
			color: "#ff4961",
			lines: {
				show: true,
				fill: false,
				lineWidth: 3
			},
			points: {
				show: true,
				radius: 4,
				fillColor: "#fff",
				fill: true,
			},
			curvedLines: {
				apply: false,
			}
		}], options_ct);
		$.plot($("#ecom-chart-4"), [{
			data: [
				[0, 1],
				[1, 26],
				[2, 8],
				[3, 22],
				[4, 5],
				[5, 26],
				[6, 8],
				[7, 22],
				[8, 1],
			],
			color: "#ff9149",
			lines: {
				show: true,
				fill: false,
				lineWidth: 3
			},
			points: {
				show: true,
				radius: 4,
				fillColor: "#fff",
				fill: true,
			},
			curvedLines: {
				apply: false,
			}
		}], options_ct);

		//Flot Number Chart Start
		$.plot($("#num-chart-1"), [{
			data: [
				[0, 1],
				[1, 26],
				[2, 8],
				[3, 22],
				[4, 5],
				[5, 26],
				[6, 8],
				[7, 22],
				[8, 5],
				[9, 26],
				[10, 8],
				[11, 22],
				[12, 5],
				[13, 26],
				[14, 8],
				[15, 22],
				[16, 1],
			],
			color: "#716aca",
			lines: {
				show: true,
				fill: 0.1,
				lineWidth: 3
			},
			points: {
				show: true,
				radius: 3,
				fill: true,
			},
			curvedLines: {
				apply: false,
			}
		}], options_bt);
		$.plot($("#num-chart-2"), [{
			data: [
				[0, 1],
				[1, 26],
				[2, 8],
				[3, 22],
				[4, 5],
				[5, 26],
				[6, 8],
				[7, 22],
				[8, 5],
				[9, 26],
				[10, 8],
				[11, 22],
				[12, 5],
				[13, 26],
				[14, 8],
				[15, 22],
				[16, 1],
			],
			color: "#28d094",
			lines: {
				show: true,
				fill: 0.1,
				lineWidth: 3
			},
			points: {
				show: true,
				radius: 3,
				fill: true,
			},
			curvedLines: {
				apply: false,
			}
		}], options_bt);
		$.plot($("#num-chart-3"), [{
			data: [
				[0, 1],
				[1, 26],
				[2, 8],
				[3, 22],
				[4, 5],
				[5, 26],
				[6, 8],
				[7, 22],
				[8, 5],
				[9, 26],
				[10, 8],
				[11, 22],
				[12, 5],
				[13, 26],
				[14, 8],
				[15, 22],
				[16, 1],
			],
			color: "#FF4961",
			lines: {
				show: true,
				fill: 0.1,
				lineWidth: 3
			},
			points: {
				show: true,
				radius: 3,
				fill: true,
			},
			curvedLines: {
				apply: false,
			}
		}], options_bt);
		$.plot($("#num-chart-4"), [{
			data: [
				[0, 1],
				[1, 26],
				[2, 8],
				[3, 22],
				[4, 5],
				[5, 26],
				[6, 8],
				[7, 22],
				[8, 5],
				[9, 26],
				[10, 8],
				[11, 22],
				[12, 5],
				[13, 26],
				[14, 8],
				[15, 22],
				[16, 1],
			],
			color: "#ff9149",
			lines: {
				show: true,
				fill: 0.1,
				lineWidth: 3
			},
			points: {
				show: true,
				radius: 3,
				fill: true,
			},
			curvedLines: {
				apply: false,
			}
		}], options_bt);

		//Flot Week Chart Start
		$.plot($("#week-chart-1"), [{
			data: [
				[0, 1],
				[1, 26],
				[2, 8],
				[3, 22],
				[4, 1],
			],
			color: "#716aca",
			lines: {
				show: true,
				fill: true,
				fillColor: "#716aca",
				lineWidth: 3
			},
			points: {
				show: false,
				radius: 3,
				fill: true,
			},
			curvedLines: {
				apply: true,
			}
		}], options_bt);
		$.plot($("#week-chart-2"), [{
			data: [
				[0, 30],
				[1, 5],
				[2, 26],
				[3, 10],
				[4, 28],
			],
			color: "#28D094",
			lines: {
				show: true,
				fill: true,
				fillColor: "#28D094",
				lineWidth: 3
			},
			points: {
				show: false,
				radius: 3,
				fill: true,
			},
			curvedLines: {
				apply: true,
			}
		}], options_bt);
		$.plot($("#week-chart-3"), [{
			data: [
				[0, 1],
				[1, 26],
				[2, 8],
				[3, 22],
				[4, 1],
			],
			color: "#ff4961",
			lines: {
				show: true,
				fill: true,
				fillColor: "#ff4961",
				lineWidth: 3
			},
			points: {
				show: false,
				radius: 3,
				fill: true,
			},
			curvedLines: {
				apply: true,
			}
		}], options_bt);
		$.plot($("#week-chart-4"), [{
			data: [
				[0, 30],
				[1, 5],
				[2, 26],
				[3, 10],
				[4, 22],
			],
			color: "#ff9149",
			lines: {
				show: true,
				fill: true,
				fillColor: "#ff9149",
				lineWidth: 3
			},
			points: {
				show: false,
				radius: 3,
				fill: true,
			},
			curvedLines: {
				apply: true,
			}
		}], options_bt);

		//Flot Order Chart Start
		$.plot($("#order-chart-1"), [{
			data: [
				[0, 30],
				[1, 5],
				[2, 26],
				[3, 10],
				[4, 22],
				[5, 30],
				[6, 5],
				[7, 26],
				[8, 10],
			],
			color: "#fff",
			lines: {
				show: true,
				fill: false,
				lineWidth: 3
			},
			points: {
				show: true,
				radius: 4,
				fillColor: "#fff",
				fill: true,
			},
			curvedLines: {
				apply: false,
			}
		}], options_ct);
		$.plot($("#order-chart-2"), [{
			data: [
				[0, 1],
				[1, 26],
				[2, 8],
				[3, 22],
				[4, 1],
				[5, 26],
				[6, 8],
				[7, 22],
				[8, 1],
			],
			color: "#fff",
			lines: {
				show: true,
				fill: false,
				lineWidth: 3
			},
			points: {
				show: true,
				radius: 4,
				fillColor: "#fff",
				fill: true,
			},
			curvedLines: {
				apply: false,
			}
		}], options_ct);
		$.plot($("#order-chart-3"), [{
			data: [
				[0, 30],
				[1, 5],
				[2, 26],
				[3, 10],
				[4, 22],
				[5, 30],
				[6, 5],
				[7, 26],
				[8, 10],
			],
			color: "#fff",
			lines: {
				show: true,
				fill: false,
				lineWidth: 3
			},
			points: {
				show: true,
				radius: 4,
				fillColor: "#fff",
				fill: true,
			},
			curvedLines: {
				apply: false,
			}
		}], options_ct);
		$.plot($("#order-chart-4"), [{
			data: [
				[0, 1],
				[1, 26],
				[2, 8],
				[3, 22],
				[4, 5],
				[5, 26],
				[6, 8],
				[7, 22],
				[8, 1],
			],
			color: "#fff",
			lines: {
				show: true,
				fill: false,
				lineWidth: 3
			},
			points: {
				show: true,
				radius: 4,
				fillColor: "#fff",
				fill: true,
			},
			curvedLines: {
				apply: false,
			}
		}], options_ct);

		//Flot bar Chart Start
		$.plot($("#bar-chart-1"), [{
			data: [
				[0, 27],
				[1, 10],
				[2, 20],
				[3, 10],
				[4, 27],
				[5, 15],
				[6, 20],
				[7, 24],
				[8, 16],
				[9, 18],
				[10, 10],
				[11, 20],
				[12, 16],
				[13, 18],
				[14, 10],
				[15, 20],
				[16, 27],
				[17, 15],
				[18, 20],
				[19, 24],
				[20, 20],
				[21, 10],
				[22, 20],
				[23, 27],
			],
			color: "#716aca",
			bars: {
				show: true,
				lineWidth: 0,
				fill: true,
				fillColor: "#716aca",
				barWidth: 0.7,
				align: 'center',
				horizontal: false
			},
			points: {
				show: false
			},
		}], options_bt);
		$.plot($("#bar-chart-2"), [{
			data: [
				[0, 2],
				[1, 10],
				[2, 20],
				[3, 10],
				[4, 27],
				[5, 15],
				[6, 20],
				[7, 24],
				[8, 20],
				[9, 16],
				[10, 18],
				[11, 10],
				[12, 20],
				[13, 27],
				[14, 15],
				[15, 20],
				[16, 24],
				[17, 20],
				[18, 16],
				[19, 18],
				[20, 10],
				[21, 20],
				[22, 10],
				[23, 5],
			],
			color: "#28d094",
			bars: {
				show: true,
				lineWidth: 0,
				fill: true,
				fillColor: "#28d094",
				barWidth: 0.7,
				align: 'center',
				horizontal: false
			},
			points: {
				show: false
			},
		}], options_bt);
		$.plot($("#bar-chart-3"), [{
			data: [
				[0, 27],
				[1, 10],
				[2, 20],
				[3, 10],
				[4, 27],
				[5, 15],
				[6, 20],
				[7, 24],
				[8, 16],
				[9, 18],
				[10, 10],
				[11, 20],
				[12, 16],
				[13, 18],
				[14, 10],
				[15, 20],
				[16, 27],
				[17, 15],
				[18, 20],
				[19, 24],
				[20, 20],
				[21, 10],
				[22, 20],
				[23, 27],
			],
			color: "#ff4961",
			bars: {
				show: true,
				lineWidth: 0,
				fill: true,
				fillColor: "#ff4961",
				barWidth: 0.7,
				align: 'center',
				horizontal: false
			},
			points: {
				show: false
			},
		}], options_bt);
		$.plot($("#bar-chart-4"), [{
			data: [
				[0, 2],
				[1, 10],
				[2, 20],
				[3, 10],
				[4, 27],
				[5, 15],
				[6, 20],
				[7, 24],
				[8, 20],
				[9, 16],
				[10, 18],
				[11, 10],
				[12, 20],
				[13, 27],
				[14, 15],
				[15, 20],
				[16, 24],
				[17, 20],
				[18, 16],
				[19, 18],
				[20, 10],
				[21, 20],
				[22, 10],
				[23, 5],
			],
			color: "#ff9149",
			bars: {
				show: true,
				lineWidth: 0,
				fill: true,
				fillColor: "#ff9149",
				barWidth: 0.7,
				align: 'center',
				horizontal: false
			},
			points: {
				show: false
			},
		}], options_bt);
	});
	$(function() {
		var doughnutChart = new Chart(document.getElementById('pie-chart-1').getContext("2d"), {
			type: 'doughnut',
			data: {
				labels: ['Data', 'All'],
				datasets: [{
					data: [837, 296],
					borderWidth: 0,
					backgroundColor: ['#fff', 'rgba(256,256,256,0.3)'],
					hoverBackgroundColor: ['#fff', 'rgba(256,256,256,0.3)'],
				}]
			},
			options: {
				responsive: true,
				legend: false,
				cutoutPercentage: 85,
				animation: {
					animateScale: false,
					duration: 5000
				}
			}
		});
		var doughnutChart = new Chart(document.getElementById('pie-chart-2').getContext("2d"), {
			type: 'doughnut',
			data: {
				labels: ['Data', 'All'],
				datasets: [{
					data: [837, 296],
					borderWidth: 0,
					backgroundColor: ['#fff', 'rgba(256,256,256,0.3)'],
					hoverBackgroundColor: ['#fff', 'rgba(256,256,256,0.3)'],
				}]
			},
			options: {
				responsive: true,
				legend: false,
				cutoutPercentage: 85,
				animation: {
					animateScale: false,
					duration: 5000
				}
			}
		});
		var doughnutChart = new Chart(document.getElementById('pie-chart-3').getContext("2d"), {
			type: 'doughnut',
			data: {
				labels: ['Data', 'All'],
				datasets: [{
					data: [837, 296],
					borderWidth: 0,
					backgroundColor: ['#fff', 'rgba(256,256,256,0.3)'],
					hoverBackgroundColor: ['#fff', 'rgba(256,256,256,0.3)'],
				}]
			},
			options: {
				responsive: true,
				legend: false,
				cutoutPercentage: 85,
				animation: {
					animateScale: false,
					duration: 5000
				}
			}
		});
		var doughnutChart = new Chart(document.getElementById('pie-chart-4').getContext("2d"), {
			type: 'doughnut',
			data: {
				labels: ['Data', 'All'],
				datasets: [{
					data: [837, 296],
					borderWidth: 0,
					backgroundColor: ['#fff', 'rgba(256,256,256,0.3)'],
					hoverBackgroundColor: ['#fff', 'rgba(256,256,256,0.3)'],
				}]
			},
			options: {
				responsive: true,
				legend: false,
				cutoutPercentage: 85,
				animation: {
					animateScale: false,
					duration: 5000
				}
			}
		});
	});
	$(function() {
		// Bar Chart
		$(function() {
			am4core.useTheme(am4themes_animated);
			var chart = am4core.create("statistics-chart-1", am4charts.XYChart);
			chart.data = [{
					category: "1",
					value1: 6,
					value2: 3
				},
				{
					category: "2",
					value1: 8,
					value2: 3
				},
				{
					category: "3",
					value1: 10,
					value2: 2
				},
				{
					category: "4",
					value1: 10,
					value2: 3
				},
				{
					category: "5",
					value1: 9,
					value2: 4
				},
				{
					category: "6",
					value1: 7,
					value2: 5
				},
				{
					category: "7",
					value1: 6,
					value2: 3
				},
				{
					category: "8",
					value1: 5,
					value2: 2
				}, {
					category: "9",
					value1: 9,
					value2: 3
				},
				{
					category: "10",
					value1: 10,
					value2: 2
				},
				{
					category: "11",
					value1: 9,
					value2: 3
				},
				{
					category: "12",
					value1: 8,
					value2: 4
				},
				{
					category: "13",
					value1: 7,
					value2: 5
				},
				{
					category: "14",
					value1: 8,
					value2: 4
				},
				{
					category: "15",
					value1: 9,
					value2: 3
				},
				{
					category: "16",
					value1: 10,
					value2: 2
				}, {
					category: "17",
					value1: 6,
					value2: 3
				},
				{
					category: "18",
					value1: 8,
					value2: 3
				},
				{
					category: "19",
					value1: 10,
					value2: 2
				},
				{
					category: "20",
					value1: 10,
					value2: 3
				},
				{
					category: "21",
					value1: 9,
					value2: 4
				},
				{
					category: "22",
					value1: 7,
					value2: 5
				},
				{
					category: "23",
					value1: 6,
					value2: 3
				},
				{
					category: "24",
					value1: 5,
					value2: 2
				}, {
					category: "25",
					value1: 9,
					value2: 3
				},
				{
					category: "26",
					value1: 10,
					value2: 2
				},
				{
					category: "27",
					value1: 9,
					value2: 3
				},
				{
					category: "28",
					value1: 8,
					value2: 4
				},
				{
					category: "29",
					value1: 7,
					value2: 5
				},
				{
					category: "30",
					value1: 8,
					value2: 4
				},
				{
					category: "31",
					value1: 9,
					value2: 3
				},
				{
					category: "32",
					value1: 10,
					value2: 2
				}
			];
			chart.colors.step = 0;
			chart.padding(0, 0, 0, 0);

			var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
			categoryAxis.dataFields.category = "category";
			categoryAxis.renderer.grid.template.location = 0;

			var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
			valueAxis.min = 0;
			valueAxis.max = 80;
			valueAxis.calculateTotals = true;

			var series1 = chart.series.push(new am4charts.ColumnSeries());
			series1.columns.template.width = am4core.percent(80);
			series1.columns.template.tooltipText =
				"{name}: {valueY.totalPercent.formatNumber('#.00')}%";
			series1.name = "Series 1";
			series1.dataFields.categoryX = "category";
			series1.dataFields.valueY = "value1";
			series1.dataFields.valueYShow = "totalPercent";
			series1.dataItems.template.locations.categoryX = 0.5;
			series1.tooltip.pointerOrientation = "vertical";

			var bullet1 = series1.bullets.push(new am4charts.LabelBullet());
			bullet1.label.text = "{valueY.totalPercent.formatNumber('#.00')}%";
			bullet1.label.fill = am4core.color("rgba(0,0,0,0)");
			bullet1.locationY = 0;

			var series2 = chart.series.push(new am4charts.ColumnSeries());
			series2.columns.template.width = am4core.percent(80);
			series2.columns.template.tooltipText =
				"{name}: {valueY.totalPercent.formatNumber('#.00')}%";
			series2.name = "Series 2";
			series2.dataFields.categoryX = "category";
			series2.dataFields.valueY = "value2";
			series2.dataFields.valueYShow = "totalPercent";
			series2.dataItems.template.locations.categoryX = 0.5;
			series2.tooltip.pointerOrientation = "vertical";

			var bullet2 = series2.bullets.push(new am4charts.LabelBullet());
			bullet2.label.text = "{valueY.totalPercent.formatNumber('#.00')}%";
			bullet2.locationY = 0;
			bullet2.label.fill = am4core.color("rgba(0,0,0,0)");

			series1.columns.template.column.cornerRadiusTopLeft = 5;
			series1.columns.template.column.cornerRadiusTopRight = 5;
			series1.columns.template.column.cornerRadiusBottomLeft = 5;
			series1.columns.template.column.cornerRadiusBottomRight = 5;

			series2.columns.template.column.cornerRadiusTopLeft = 5;
			series2.columns.template.column.cornerRadiusTopRight = 5;
			series2.columns.template.column.cornerRadiusBottomLeft = 5;
			series2.columns.template.column.cornerRadiusBottomRight = 5;

			series1.clustered = false;
			series2.clustered = false;
			series2.columns.template.fill = am4core.color("#716aca");
			series2.columns.template.stroke = am4core.color("#716aca");
			series1.columns.template.fill = am4core.color("#F2F3F8");
			series1.columns.template.stroke = am4core.color("#F2F3F8");

			categoryAxis.renderer.grid.template.strokeOpacity = 0;
			categoryAxis.renderer.minGridDistance = 0;
			categoryAxis.renderer.inside = true;
			categoryAxis.renderer.labels.template.fillOpacity = 0

			valueAxis.renderer.grid.template.strokeOpacity = 0;
			valueAxis.renderer.baseGrid.strokeOpacity = 0;
			valueAxis.renderer.inside = true;
			valueAxis.renderer.labels.template.fillOpacity = 0;
		});
	});
	$(function() {
		Morris.Area({
			element: 'tab-moris-1',
			data: [{
				period: '2010',
				iphone: 0,
				ipad: 0,
				itouch: 0
			}, {
				period: '2011',
				iphone: 50,
				ipad: 15,
				itouch: 5
			}, {
				period: '2012',
				iphone: 20,
				ipad: 50,
				itouch: 65
			}, {
				period: '2013',
				iphone: 60,
				ipad: 12,
				itouch: 7
			}, {
				period: '2014',
				iphone: 30,
				ipad: 20,
				itouch: 120
			}, {
				period: '2015',
				iphone: 25,
				ipad: 80,
				itouch: 40
			}, {
				period: '2016',
				iphone: 10,
				ipad: 10,
				itouch: 10
			}],
			lineColors: ['#ff4961', '#28d094', '#716aca'],
			xkey: 'period',
			ykeys: ['iphone', 'ipad', 'itouch'],
			labels: ['Site A', 'Site B', 'Site C'],
			ymax: 140,
			pointSize: 0,
			lineWidth: 0,
			resize: true,
			fillOpacity: 0.8,
			behaveLikeLine: true,
			gridLineColor: '#d2d2d2',
			hideHover: 'auto'
		});
		Morris.Bar({
			element: 'chart-bar-moris',
			data: [{
					y: '2008',
					a: 50,
					b: 40,
					c: 35,
					d: 40,
				},
				{
					y: '2009',
					a: 75,
					b: 65,
					c: 60,
					d: 75,

				},
				{
					y: '2010',
					a: 50,
					b: 40,
					c: 55,
					d: 45,
				},
				{
					y: '2011',
					a: 75,
					b: 65,
					c: 85,
					b: 60,
				},
				{
					y: '2012',
					a: 100,
					b: 90,
					c: 40,
					b: 80,
				}
			],
			xkey: 'y',
			barSizeRatio: 0.70,
			barGap: 5,
			resize: true,
			responsive: true,
			ykeys: ['a', 'b', 'c', 'b'],
			labels: ['Bar 1', 'Bar 2', 'Bar 3', 'Bar 4'],
			barColors: ['#716aca', '#ff4961', '#28d094', '#ff9149']
		});
		var graph = Morris.Donut({
			element: 'chart-pie-moris',
			data: [{
					value: 60,
					label: 'Order'
				},
				{
					value: 20,
					label: 'Stock'
				},
				{
					value: 10,
					label: 'Profit'
				},
				{
					value: 5,
					label: 'Sale'
				}
			],
			colors: ['#716aca', '#ff4961', '#28d094', '#ff9149'],
			resize: true,
			formatter: function(x) {
				return x + " %"
			}
		});
		var chartd = new Chart(document.getElementById('doughnut-chart-1').getContext("2d"), {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [54, 46],
					backgroundColor: ['#716aca', '#f9f9f9'],
					hoverBackgroundColor: ['#716aca', '#f9f9f9'],
					borderWidth: 0
				}]
			},
			options: {
				scales: {
					xAxes: [{
						display: false,
					}],
					yAxes: [{
						display: false
					}]
				},
				legend: {
					display: false
				},
				tooltips: {
					enabled: false
				},
				cutoutPercentage: 94,
				responsive: true,
				maintainAspectRatio: false
			}
		});
		var chartd = new Chart(document.getElementById('doughnut-chart-2').getContext("2d"), {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [15, 18],
					backgroundColor: ['#28d094', '#f9f9f9'],
					hoverBackgroundColor: ['#28d094', '#f9f9f9'],
					borderWidth: 0
				}]
			},
			options: {
				scales: {
					xAxes: [{
						display: false,
					}],
					yAxes: [{
						display: false
					}]
				},
				legend: {
					display: false
				},
				tooltips: {
					enabled: false
				},
				cutoutPercentage: 94,
				responsive: true,
				maintainAspectRatio: false
			}
		});
		var chartd = new Chart(document.getElementById('doughnut-chart-3').getContext("2d"), {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [8, 40],
					backgroundColor: ['#ff4961', '#f9f9f9'],
					hoverBackgroundColor: ['#ff4961', '#f9f9f9'],
					borderWidth: 0
				}]
			},
			options: {
				scales: {
					xAxes: [{
						display: false,
					}],
					yAxes: [{
						display: false
					}]
				},
				legend: {
					display: false
				},
				tooltips: {
					enabled: false
				},
				cutoutPercentage: 94,
				responsive: true,
				maintainAspectRatio: false
			}
		});
		var chartd = new Chart(document.getElementById('doughnut-chart-4').getContext("2d"), {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [17, 40],
					backgroundColor: ['#ff9149', '#f9f9f9'],
					hoverBackgroundColor: ['#ff9149', '#f9f9f9'],
					borderWidth: 0
				}]
			},
			options: {
				scales: {
					xAxes: [{
						display: false,
					}],
					yAxes: [{
						display: false
					}]
				},
				legend: {
					display: false
				},
				tooltips: {
					enabled: false
				},
				cutoutPercentage: 94,
				responsive: true,
				maintainAspectRatio: false
			}
		});
	});
	// tab am chart
	$(function() {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("tab-am-1", am4charts.XYChart);
		var data = [];
		var price1 = 1000,
			price2 = 1200;
		var quantity = 500;
		for (var i = 0; i < 360; i++) {
			price1 += Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 100);
			data.push({
				date1: new Date(2018, 0, i),
				price1: price1
			});
		}
		chart.data = data;
		var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
		dateAxis.renderer.minGridDistance = 50;
		dateAxis.renderer.grid.template.location = 0.5;
		dateAxis.startLocation = 0.5;
		dateAxis.endLocation = 0.5;

		var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
		valueAxis.tooltip.disabled = true;
		valueAxis.renderer.minWidth = 60;

		var series = chart.series.push(new am4charts.LineSeries());
		series.name = "2016";
		series.dataFields.dateX = "date1";
		series.dataFields.valueY = "price1";
		series.tooltipText = "{valueY.value}";
		series.fill = am4core.color("#716aca");
		series.stroke = am4core.color("#716aca");
		series.strokeWidth = 3;
		series.tensionY = 1;
		series.tensionX = 0.8;

		var dropShadow = new am4core.DropShadowFilter();
		dropShadow.dy = 15;
		dropShadow.dx = 1;
		dropShadow.blur = 8;
		dropShadow.opacity = 0.5;
		dropShadow.color = '#716aca';
		series.filters.push(dropShadow);

		chart.cursor = new am4charts.XYCursor();
		chart.cursor.xAxis = dateAxis;

		var scrollbarX = new am4charts.XYChartScrollbar();
		scrollbarX.series.push(series);
		chart.scrollbarX = scrollbarX;
		chart.scrollbarX.scrollbarChart.series.getIndex(0).xAxis.startLocation = 0.5;
		chart.scrollbarX.scrollbarChart.series.getIndex(0).xAxis.endLocation = 0.5;

		chart.legend = new am4charts.Legend();
		chart.legend.parent = chart.plotContainer;
		chart.legend.zIndex = 100;

		dateAxis.renderer.grid.template.strokeOpacity = 0.07;
		valueAxis.renderer.grid.template.strokeOpacity = 0.07;

		chart.events.on("datavalidated", function() {
			dateAxis.zoomToDates(
				new Date(2018, 1, 10),
				new Date(2018, 1, 27)
			);
		});
	});
	$(function() {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("tab-am-2", am4charts.XYChart);
		var data = [];
		var price1 = 1000,
			price2 = 1200;
		var quantity = 500;
		for (var i = 0; i < 360; i++) {
			price1 += Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 100);
			data.push({
				date1: new Date(2018, 0, i),
				price1: price1
			});
		}
		chart.data = data;
		var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
		dateAxis.renderer.minGridDistance = 50;
		dateAxis.renderer.grid.template.location = 0.5;
		dateAxis.startLocation = 0.5;
		dateAxis.endLocation = 0.5;

		var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
		valueAxis.tooltip.disabled = true;
		valueAxis.renderer.minWidth = 60;

		var series = chart.series.push(new am4charts.LineSeries());
		series.name = "2016";
		series.dataFields.dateX = "date1";
		series.dataFields.valueY = "price1";
		series.tooltipText = "{valueY.value}";
		series.fill = am4core.color("#ff4961");
		series.stroke = am4core.color("#ff4961");
		series.strokeWidth = 3;
		series.tensionY = 1;
		series.tensionX = 0.8;

		var dropShadow = new am4core.DropShadowFilter();
		dropShadow.dy = 15;
		dropShadow.dx = 1;
		dropShadow.blur = 8;
		dropShadow.opacity = 0.5;
		dropShadow.color = '#ff4961';
		series.filters.push(dropShadow);

		chart.cursor = new am4charts.XYCursor();
		chart.cursor.xAxis = dateAxis;

		var scrollbarX = new am4charts.XYChartScrollbar();
		scrollbarX.series.push(series);
		chart.scrollbarX = scrollbarX;
		chart.scrollbarX.scrollbarChart.series.getIndex(0).xAxis.startLocation = 0.5;
		chart.scrollbarX.scrollbarChart.series.getIndex(0).xAxis.endLocation = 0.5;

		chart.legend = new am4charts.Legend();
		chart.legend.parent = chart.plotContainer;
		chart.legend.zIndex = 100;

		dateAxis.renderer.grid.template.strokeOpacity = 0.07;
		valueAxis.renderer.grid.template.strokeOpacity = 0.07;

		chart.events.on("datavalidated", function() {
			dateAxis.zoomToDates(
				new Date(2018, 1, 10),
				new Date(2018, 1, 27)
			);
		});
	});
	$(function() {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("tab-am-3", am4charts.XYChart);
		var data = [];
		var price1 = 1000,
			price2 = 1200;
		var quantity = 500;
		for (var i = 0; i < 360; i++) {
			price1 += Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 100);
			data.push({
				date1: new Date(2018, 0, i),
				price1: price1
			});
		}
		chart.data = data;
		var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
		dateAxis.renderer.minGridDistance = 50;
		dateAxis.renderer.grid.template.location = 0.5;
		dateAxis.startLocation = 0.5;
		dateAxis.endLocation = 0.5;

		var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
		valueAxis.tooltip.disabled = true;
		valueAxis.renderer.minWidth = 60;

		var series = chart.series.push(new am4charts.LineSeries());
		series.name = "2016";
		series.dataFields.dateX = "date1";
		series.dataFields.valueY = "price1";
		series.tooltipText = "{valueY.value}";
		series.fill = am4core.color("#ff9149");
		series.stroke = am4core.color("#ff9149");
		series.strokeWidth = 3;
		series.tensionY = 1;
		series.tensionX = 0.8;

		var dropShadow = new am4core.DropShadowFilter();
		dropShadow.dy = 15;
		dropShadow.dx = 1;
		dropShadow.blur = 8;
		dropShadow.opacity = 0.5;
		dropShadow.color = '#ff9149';
		series.filters.push(dropShadow);

		chart.cursor = new am4charts.XYCursor();
		chart.cursor.xAxis = dateAxis;

		var scrollbarX = new am4charts.XYChartScrollbar();
		scrollbarX.series.push(series);
		chart.scrollbarX = scrollbarX;
		chart.scrollbarX.scrollbarChart.series.getIndex(0).xAxis.startLocation = 0.5;
		chart.scrollbarX.scrollbarChart.series.getIndex(0).xAxis.endLocation = 0.5;

		chart.legend = new am4charts.Legend();
		chart.legend.parent = chart.plotContainer;
		chart.legend.zIndex = 100;

		dateAxis.renderer.grid.template.strokeOpacity = 0.07;
		valueAxis.renderer.grid.template.strokeOpacity = 0.07;

		chart.events.on("datavalidated", function() {
			dateAxis.zoomToDates(
				new Date(2018, 1, 10),
				new Date(2018, 1, 27)
			);
		});
	});
	$(function() {
		// Create chart instance
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("am-lines", am4charts.XYChart);

		// Add data
		chart.data = [{
			period: '2010',
			iphone: 0,
			ipad: 0,
			itouch: 0
		}, {
			period: '2011',
			iphone: 50,
			ipad: 15,
			itouch: 5
		}, {
			period: '2012',
			iphone: 20,
			ipad: 50,
			itouch: 65
		}, {
			period: '2013',
			iphone: 60,
			ipad: 45,
			itouch: 7
		}, {
			period: '2014',
			iphone: 20,
			ipad: 30,
			itouch: 120
		}, {
			period: '2015',
			iphone: 25,
			ipad: 80,
			itouch: 40
		}, {
			period: '2016',
			iphone: 10,
			ipad: 10,
			itouch: 10
		}];

		// Create axes
		var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "period";
		categoryAxis.title.text = "Year";

		// First value axis
		var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
		valueAxis.title.text = "Value";


		// First series
		var series = chart.series.push(new am4charts.LineSeries());
		series.dataFields.valueY = "iphone";
		series.dataFields.categoryX = "period";
		series.name = "iphone";
		series.tooltipText = "{name}: [bold]{valueY}[/]";
		series.strokeWidth = 3;
		series.tensionY = 1;
		series.tensionX = 0.8;
		series.fill = am4core.color("#28d094");
		series.stroke = am4core.color("#28d094");
		var dropShadow = new am4core.DropShadowFilter();
		dropShadow.dy = 15;
		dropShadow.dx = 1;
		dropShadow.blur = 8;
		dropShadow.opacity = 0.5;
		dropShadow.color = '#28d094';
		series.filters.push(dropShadow);


		// Second series
		var series2 = chart.series.push(new am4charts.LineSeries());
		series2.dataFields.valueY = "ipad";
		series2.dataFields.categoryX = "period";
		series2.name = "ipad";
		series2.tooltipText = "{name}: [bold]{valueY}[/]";
		series2.strokeWidth = 3;
		series2.tensionY = 1;
		series2.tensionX = 0.8;
		series2.fill = am4core.color("#ff4961");
		series2.stroke = am4core.color("#ff4961");
		var dropShadow = new am4core.DropShadowFilter();
		dropShadow.dy = 15;
		dropShadow.dx = 1;
		dropShadow.blur = 8;
		dropShadow.opacity = 0.5;
		dropShadow.color = '#ff4961';
		series2.filters.push(dropShadow);

		// Second series
		var series3 = chart.series.push(new am4charts.LineSeries());
		series3.dataFields.valueY = "itouch";
		series3.dataFields.categoryX = "period";
		series3.name = "itouch";
		series3.tooltipText = "{name}: [bold]{valueY}[/]";
		series3.strokeWidth = 3;
		series3.tensionY = 1;
		series3.tensionX = 0.8;
		series3.fill = am4core.color("#716aca");
		series3.stroke = am4core.color("#716aca");
		var dropShadow = new am4core.DropShadowFilter();
		dropShadow.dy = 15;
		dropShadow.dx = 1;
		dropShadow.blur = 8;
		dropShadow.opacity = 0.5;
		dropShadow.color = '#716aca';
		series3.filters.push(dropShadow);

		// Add legend
		chart.legend = new am4charts.Legend();
		chart.legend.position = 'top';

		// Add cursor
		chart.cursor = new am4charts.XYCursor();

		valueAxis.renderer.grid.template.strokeOpacity = 0;
	});
	$(function() {
		// Create chart instance
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("am-lines-1", am4charts.XYChart);

		// Add data
		chart.data = [{
			period: '2010',
			iphone: 0,
			itouch: 60
		}, {
			period: '2011',
			iphone: 50,
			itouch: 5
		}, {
			period: '2012',
			iphone: 20,
			itouch: 65
		}, {
			period: '2013',
			iphone: 60,
			itouch: 7
		}, {
			period: '2014',
			iphone: 20,
			itouch: 120
		}, {
			period: '2015',
			iphone: 60,
			itouch: 25
		}, {
			period: '2016',
			iphone: 10,
			itouch: 60
		}];

		// Create axes
		var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "period";
		categoryAxis.title.text = "Year";

		// First value axis
		var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
		valueAxis.title.text = "Value";


		// First series
		var series = chart.series.push(new am4charts.LineSeries());
		series.dataFields.valueY = "iphone";
		series.dataFields.categoryX = "period";
		series.name = "iphone";
		series.tooltipText = "{name}: [bold]{valueY}[/]";
		series.strokeWidth = 4;
		series.strokeDasharray = 10;
		series.tensionY = 1;
		series.tensionX = 0.8;
		series.fill = am4core.color("#C4C2C3");
		series.stroke = am4core.color("#C4C2C3");

		// Second series
		var series2 = chart.series.push(new am4charts.LineSeries());
		series2.dataFields.valueY = "itouch";
		series2.dataFields.categoryX = "period";
		series2.name = "itouch";
		series2.tooltipText = "{name}: [bold]{valueY}[/]";
		series2.strokeWidth = 4;
		series2.tensionY = 1;
		series2.tensionX = 0.8;
		series2.fill = am4core.color("#716aca");
		series2.stroke = am4core.color("#716aca");
		var dropShadow = new am4core.DropShadowFilter();
		dropShadow.dy = 15;
		dropShadow.dx = 1;
		dropShadow.blur = 8;
		dropShadow.opacity = 0.5;
		dropShadow.color = '#716aca';
		series2.filters.push(dropShadow);

		// Add legend
		chart.legend = new am4charts.Legend();
		chart.legend.position = 'top';

		// Add cursor
		chart.cursor = new am4charts.XYCursor();
		categoryAxis.renderer.grid.template.strokeOpacity = 0;

	});
}
