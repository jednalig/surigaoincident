function showBarChart() {
	{
		$.post("ajax-endpoint/get-chart-data.php?chart_type=bar",
			function(data) {
				console.log(data);
				var name = [];
				var marks = [];

				for (var i in data) {
					name.push(data[i].student_name);
					marks.push(data[i].marks);
				}

				var chartdata = {
					labels: name,
					datasets: [
						{
							label: 'Student Marks',
							backgroundColor: '#49e2ff',
							borderColor: '#46d5f1',
							hoverBackgroundColor: '#CCCCCC',
							hoverBorderColor: '#666666',
							data: marks
						}
					]
				};

				var graphTarget = $("#bar-chart");

				var graph = new Chart(graphTarget, {
					type: 'bar',
					data: chartdata
				});
			});
	}
}

function showPieChart() {
	{
		$.post("ajax-endpoint/get-chart-data.php?chart_type=pie",
			function(data) {
				var name = [];
				var marks = [];
				var bgColor = [];

				for (var i in data) {
					name.push(data[i].label);
					marks.push(data[i].data);
					bgColor.push(data[i].backgroundColor);
				}

				var chartdata = {
					labels: name,
					datasets: [
						{
							label: 'Student Marks',
							backgroundColor: bgColor,
							data: marks
						}
					]
				};

				var graphTarget = $("#pie-chart");

				var graph = new Chart(graphTarget, {
					type: 'pie',
					data: chartdata
				});
			});
	}
}

function showDoughnutChart() {
	{
		Chart.pluginService.register({
			beforeDraw: function(chart) {
				var width = chart.chart.width,
					height = chart.chart.height + 35,
					ctx = chart.chart.ctx;

				ctx.save();
				ctx.font = "bold 1.5em sans-serif";
				ctx.textBaseline = "middle";


				var text = "100",
					textX = Math.round((width - ctx.measureText(text).width) / 2),
					textY = height / 2;
				ctx.fillStyle = 'rgba(0, 0, 0, 1)';
				ctx.fillText(text, textX, textY);
				ctx.restore();
			}
		});

		$.post("ajax-endpoint/get-chart-data.php?chart_type=doughnut",
			function(data) {
				var name = [];
				var marks = [];
				var bgColor = [];

				for (var i in data) {
					name.push(data[i].label);
					marks.push(data[i].data);
					bgColor.push(data[i].backgroundColor);
				}

				var chartdata = {
					labels: name,
					datasets: [
						{
							label: 'Student Marks',
							backgroundColor: bgColor,
							data: marks
						}
					]
				};

				var graphTarget = $("#doughnut-chart");

				var graph = new Chart(graphTarget, {
					type: 'doughnut',
					data: chartdata,
					options: {
					}
				});
			});
	}
}


function showStackedVerticalChart() {
	{
		$.post("ajax-endpoint/get-chart-data.php?chart_type=vertical-bar",
			function(data) {
				var chartdata = {
					labels: ['Marks'],
					datasets: data
				};

				var graphTarget = $("#stacked-vertical-chart");

				var graph = new Chart(graphTarget, {
					type: 'bar',
					data: chartdata,
					options: {
						scales: {
					        xAxes: [{
					        	barPercentage: 0.3,
            					stacked: true
					        }],
					        yAxes: [{
					        	stacked: true
					        }]
					    }
					}
				});
			});
	}
}