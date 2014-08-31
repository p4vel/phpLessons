<?php 

	class Table 
	{
		public $lega;

		static public $total_tables = 0;

		function __construct($leg_count = 4)
		{
			$this->legs = $leg_count;
			Table::$total_tables++;
		}
		function __destruct()
		{
			Table::$total_tables--;
		}
	}

	// $table = new Table();
	// echo $table->legs."<br />";

	echo Table::$total_tables."<br />"; // 0
	$t1 = new Table();
	echo $t1->legs;
	echo Table::$total_tables."<br />"; // 1
	$t2 = new Table(6);
	echo $t2->legs;
	echo Table::$total_tables."<br />"; // 2
?>