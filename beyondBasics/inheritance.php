<?php 

class Car{
	var $wheels = 4;
	var $doors = 4;

	function wheels_doors()
	{
		return $this->wheels + $this->doors;
	}
}


class CompactCar extends Car{
	var $doors = 2;
		function wheels_doors()
	{
		return $this->wheels + $this->doors + 100;
	}
}


$car1 = new Car;
$car2 = new CompactCar;

echo $car1->wheels . "<br />";
echo $car1->doors . "<br />";
echo $car1->wheels_doors() . "<br />";

echo "<hr />";

echo $car2->wheels . "<br />";
echo $car2->doors . "<br />";
echo $car2->wheels_doors() . "<br />";

echo "Car parent: " . get_parent_class("Car") . "<br />";
echo "CompactCar parent: " . get_parent_class("CompactCar") . "<br />";

echo is_subclass_of("Car", "Car") ? "true" : "false" ;
echo "<br />";
echo is_subclass_of("CompactCar", "Car") ? "true" : "false" ;
echo "<br />";
echo is_subclass_of("Car", "CompactCar") ? "true" : "false" ;
?>