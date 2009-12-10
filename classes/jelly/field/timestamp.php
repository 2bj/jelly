<?php defined('SYSPATH') or die('No direct script access.');

class Jelly_Field_Timestamp extends Jelly_Field
{
	protected $auto_now_create = FALSE;
	protected $auto_now_update = FALSE;
	protected $format = NULL;
	
	public function set($value)
	{
		$this->value = strtotime($value);
	}
	
	public function save($loaded)
	{
		if ((!$loaded && $this->auto_now_create) || ($loaded && $this->auto_now_update))
		{
			$this->value = time();
			
			// Convert if necessary
			if ($this->format)
			{
				$this->value = date($this->format, $this->value);
			}
		}
		
		return $this->value;
	}
}