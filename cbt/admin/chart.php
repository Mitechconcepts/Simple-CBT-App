<?php

$dataPoints = array( 
	array("label"=>"Mathematics", "symbol" => "Mth","y"=>46.6),
	array("label"=>"English", "symbol" => "Eng","y"=>27.7),
	array("label"=>"Physics", "symbol" => "Phy","y"=>13.9),
	array("label"=>"Chemistry", "symbol" => "Chem","y"=>5),
	array("label"=>"Biology", "symbol" => "Geo","y"=>3.6),
	array("label"=>"Economics", "symbol" => "Eco","y"=>2.6),
	array("label"=>"Government", "symbol" => "Gov","y"=>2.1),
	array("label"=>"CRS", "symbol" => "crs","y"=>1.5),

)

?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2",
	animationEnabled: true,
	title: {
		text: "Average Students Performance"
	},
	data: [{
		type: "doughnut",
		indexLabel: "{symbol} - {y}",
		yValueFormatString: "#,##0.0\"%\"",
		showInLegend: true,
		legendText: "{label} : {y}",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

}
</script>
</head>
<body>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>                              