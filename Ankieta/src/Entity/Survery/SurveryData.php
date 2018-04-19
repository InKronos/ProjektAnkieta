<?php

namespace App\Entity\Survery;

/**
* 
*/
class SurveryData
{
	protected $question;
	protected $typ;
	
	function getQuestion()
	{
		return $this->question;
	}

	function getTyp()
	{
		return $this->typ;
	}
}