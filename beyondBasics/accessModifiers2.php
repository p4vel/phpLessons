<?php 
// Setters and Getters

/**
* 
*/
class SetterGetterExample{
	private $a = 1;

	public function get_a()
	{
		return $this->a;
	}

	public function set_a($value)
	{
		$this->a = $value;
	}
}

$example = new SetterGetterExample();
// restricted: echo $example-> . "<br />";

echo $example->get_a() . "<br />";
$example->set_a(5);
echo $example->get_a() . "<br />";
?>