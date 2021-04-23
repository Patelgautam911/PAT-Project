$(document).ready(function() {
	$('select').formSelect();
	var date = new Date();
	date.setDate(date.getDate() - 1);
	$('.datepicker').datepicker({
		setDefaultDate: date,
		maxDate: date,
		yearRange: 100,
		showDaysInNextAndPreviousMonths: true,
		showClearBtn: true,
		format: 'mm/dd/yyyy'
	});
	if ($('.tabs li').length > 0) {
		$('.tabs').tabs();
		$('.tooltipped').tooltip();
	}


	$('#delete-teacher, #add-class, #add-student, #delete-student, #add-teacher').modal();
	$('[id^="delete-teacher"]').modal();
	$('[id^="delete-student"]').modal();
	$('[id^="edit-class"]').modal();
	$('[id^="delete-class"]').modal();
	$('#deleted').modal();
	$('.acc-header, .icon--close').on('click', function(e) {
		e.preventDefault();
		var elem = $(this).next('.acc-body')
		elem.toggle('slideToggle');
	});

	/* Navigation Toggle Starts */
	var $toggleButton = $('.nav--toggle__button'),
		$menuWrap = $('.menu-wrap');
	$toggleButton.on('click', function() {
		$(this).toggleClass('button-open');
		$menuWrap.toggleClass('menu-show');
	});
	/* Navigation Toggle Ends */

	$(".nav--toggle__button").click(function() {
		$("ul.menu").toggleClass("marginR");
		$(".menu-wrap").toggleClass("open");
		$("footer").toggleClass("opac");
	});

});

/* Date Range Picker */

$(function() {
	$('input[name="daterange"]').daterangepicker({
		opens: 'left'
	}, function(start, end, label) {
		console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
	});
});

var totalStepCanvas = document.getElementById("stepsChart");


/* Total Steps PIE */
if (typeof Pat_Points == 'undefined') {
	Pat_Points = 0;
}
if (typeof Total_Steps == 'undefined') {
	Total_Steps = 0;
}
if (typeof Total_Jumps == 'undefined') {
	Total_Jumps = 0;
}
if (typeof Total_Meters == 'undefined') {
	Total_Meters = 0;
}
$('.class_tab').on('click', function() {
	$('#stepsChart').remove();
	$('#pieChart').append('<canvas id="stepsChart" width="600" height="400"></canvas>');
	var totalStepCanvas = document.getElementById("stepsChart");

	Chart.defaults.global.defaultFontFamily = "Lato";
	Chart.defaults.global.defaultFontSize = 18;
	if (window.pieChart != undefined) {
		window.pieChart.destroy();
	}
	var Total_Steps = $($(this).attr('href') + 'Total_Steps').text();
	var Total_Jumps = $($(this).attr('href') + 'Total_Jumps').text();
	var Total_Meters = $($(this).attr('href') + 'Total_Meters').text();
	var Pat_Points = $($(this).attr('href') + 'Pat_Points').text();
	var stepData = {
		labels: [
			"Pat Points",
			"Total Steps",
			"Total Meters",
			"Jumps",

		],
		datasets: [{
			data: [Math.round(Pat_Points), Total_Steps, Total_Meters, Total_Jumps],
			backgroundColor: [
				"rgba(252, 191, 6, 0.7)",
				"rgba(113, 185, 90, 0.7)",
				"rgba(121, 204, 240, 0.7)",
				"rgba(235, 90, 140, 0.7)",

			]
		}]
	};
	if (window.pieChart) {
		window.pieChart.destroy();
	}
	var pieChart = new Chart(totalStepCanvas, {
		type: 'pie',
		data: stepData,
		options: {
			legend: {
				display: true,
				labels: {
					fontColor: '#000'
				}
			}
		}
	});
});
$('#all_class').on('click', function() {
	$('#stepsChart').remove();
	$('#pieChart').append('<canvas id="stepsChart" width="600" height="400"></canvas>');
	if (window.pieChart) {
		window.pieChart.destroy();
	}
	var totalStepCanvas = document.getElementById("stepsChart");
	var stepData = null;
	Chart.defaults.global.defaultFontFamily = "Lato";
	Chart.defaults.global.defaultFontSize = 18;
	var Total_Steps = $('#Total_Steps').text();
	var Total_Jumps = $('#Total_Jumps').text();
	var Total_Meters = $('#Total_Meters').text();
	var Pat_Points = $('#Pat_Points').text();
	var stepData = {
		labels: [
			"Pat Points",
			"Total Steps",
			"Total Meters",
			"Jumps",
			//"Highly Active"
		],
		datasets: [{
			data: [Math.round(Pat_Points), Total_Steps, Total_Meters, Total_Jumps],
			backgroundColor: [
				"rgba(252, 191, 6, 0.7)",
				"rgba(113, 185, 90, 0.7)",
				"rgba(121, 204, 240, 0.7)",
				"rgba(235, 90, 140, 0.7)",

			]
		}]
	};
	if (window.pieChart) {
		window.pieChart.destroy();
	}
	var pieChart = new Chart(totalStepCanvas, {
		type: 'pie',
		data: stepData,
		options: {
			legend: {
				display: true,
				labels: {
					fontColor: '#000'
				}
			}
		}
	});
});
$('#stepsChart').remove();
$('#pieChart').append('<canvas id="stepsChart" width="600" height="400"></canvas>');
var totalStepCanvas = document.getElementById("stepsChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;
var stepData = null;
var stepData = {
	labels: [
		"Pat Points",
		"Total Steps",
		"Total Meterss",
		"Jumps",

	],
	datasets: [{
		data: [Math.round(Pat_Points), Total_Steps, Total_Meters, Total_Jumps],
		backgroundColor: [
			"rgba(252, 191, 6, 0.7)",
			"rgba(113, 185, 90, 0.7)",
			"rgba(121, 204, 240, 0.7)",
			"rgba(235, 90, 140, 0.7)",

		]
	}]
};
if (window.pieChart) {
	window.pieChart.destroy();
}
var pieChart = new Chart(totalStepCanvas, {
	type: 'pie',
	data: stepData,
	options: {
		legend: {
			display: true,
			labels: {
				fontColor: '#000'
			}
		}
	}
});
/* Total Steps Bar */

var ctx = document.getElementById("myChart4").getContext('2d');
var myChart = new Chart(ctx, {
	type: 'bar',
	data: {
		labels: ["11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00"],
		datasets: [{
			label: 'Sitting',
			backgroundColor: "rgba(121, 204, 240, 0.7)",
			data: [12, 59, 5, 56, 58, 12, 59, 87, 45],
		}, {
			label: 'Walking Slow',
			backgroundColor: "rgba(75, 71, 152, 0.7)",
			data: [12, 59, 5, 56, 58, 12, 59, 85, 23],
		}, {
			label: 'Walking',
			backgroundColor: "rgba(252, 191, 6, 0.7)",
			data: [12, 59, 5, 56, 58, 12, 59, 65, 51],
		}, {
			label: 'Running',
			backgroundColor: "rgba(113, 185, 90, 0.7)",
			data: [12, 59, 5, 56, 58, 12, 59, 12, 74],
		}, {
			label: 'Running Fast',
			backgroundColor: "rgba(255, 0, 0, 0.7)",
			data: [12, 59, 5, 56, 58, 12, 59, 12, 74],
		}],
	},
	options: {
		tooltips: {
			displayColors: true,
			callbacks: {
				mode: 'x',
			},
		},
		scales: {
			xAxes: [{
				stacked: true,
				gridLines: {
					display: false,
				}
			}],
			yAxes: [{
				stacked: true,
				ticks: {
					beginAtZero: true,
				},
				type: 'linear',
			}]
		},
		responsive: true,
		maintainAspectRatio: true,
		legend: { position: 'bottom' },
	}
});

/* Percentage of Steps  */

var canvas = document.getElementById("barChart");
var ctx = canvas.getContext('2d');

// Global Options:
Chart.defaults.global.defaultFontColor = 'dodgerblue';
Chart.defaults.global.defaultFontSize = 16;


// Data with datasets options
var data = {
	labels: class_array,
	datasets: [{
		fill: true,
		backgroundColor: [
			'rgba(252, 191, 6, 0.7)',
			'rgba(113, 185, 90, 0.7)',
			'rgba(121, 204, 240, 0.7)'
		],
		data: class_steps
	}]
};

// Notice how nested the beginAtZero is
var options = {
	scales: {
		yAxes: [{
			ticks: {
				beginAtZero: true
			}
		}]
	},
	legend: { display: false },
    title: {display: false}
};

// Chart declaration:
var myBarChart = new Chart(ctx, {
	type: 'bar',
	data: data,
	options: options
});

/* Meters Covered  */

var canvas = document.getElementById("barChart-One");
var ctx = canvas.getContext('2d');

// Global Options:
Chart.defaults.global.defaultFontColor = 'dodgerblue';
Chart.defaults.global.defaultFontSize = 16;


// Data with datasets options
var data = {
	labels: class_array2,
	datasets: [{
		fill: true,
		backgroundColor: [
			'rgba(252, 191, 6, 0.7)',
			'rgba(113, 185, 90, 0.7)',
			'rgba(121, 204, 240, 0.7)'
		],
		data: class_meters
	}]
};

// Notice how nested the beginAtZero is
var options = {
	scales: {
		yAxes: [{
			ticks: {
				beginAtZero: true
			}
		}]
	},
	legend: { display: false },
    title: {display: false}
};

// Chart declaration:
var myBarChart = new Chart(ctx, {
	type: 'bar',
	data: data,
	options: options
});