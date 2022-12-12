<!DOCTYPE html>
<html>
<head>
<title>Creating Dynamic Data Graph using PHP and Chart.js</title>
<style type="text/css">
.chart-container {
	display: inline-block;
	width: 40%;
}

.pie-chart {
	margin: 40px 20px;
}
</style>
<script type="text/javascript" src="vendor/jquery.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
</head>
<body>
	<div class="chart-container">
		<canvas id="bar-chart"></canvas>
	</div>
	<div class="chart-container pie-chart">
		<canvas id="pie-chart"></canvas>
	</div>
	<div class="chart-container pie-chart">
		<canvas id="doughnut-chart"></canvas>
	</div>
	<div class="chart-container">
		<canvas id="stacked-vertical-chart"></canvas>
	</div>
	<script src="./assets/js/graph.js"></script>

	<script>            
    $(document).ready(function () {
       showBarChart();
       showPieChart();
        showDoughnutChart();
       showStackedVerticalChart();
    });
	</script>

</body>
</html>