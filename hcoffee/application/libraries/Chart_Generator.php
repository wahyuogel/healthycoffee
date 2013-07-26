<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');
require_once("libchart/classes/libchart.php");
 
class Chart_Generator { 
function create_bar_chart($title,$data,$x=400,$y=200,$type="bar_vertikal",$render_file=FALSE)
{
	if ("bar_horizontal"==$type)
		$chart = new HorizontalBarChart($x,$y);
	else if ("bar_vertikal"==$type)
		$chart = new VerticalBarChart($x,$y);
	else
		$chart = new PieChart($x,$y);
 
	$dataSet = new XYDataSet();
	foreach ($data as $value)
	{
		$dataSet->addPoint(new Point($value['key'], $value['value']));
	}
	$chart->setDataSet($dataSet);
	$chart->setTitle($title);
	if (!$render_file)
		return $chart->render();
	else
		return $chart->render($render_file);	
}
}
?>