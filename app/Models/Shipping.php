<?php
namespace App\Models;

class Shipping extends Order
{
	private $shiping = 0;
	
	public function setShiping($shiping)
	{
		$this->shiping = $shiping;
	}
		
	public function getTotal() 
	{
		return parent::getTotal() + $this->shiping;
	} 
}
