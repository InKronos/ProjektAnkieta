<?php

namespace App\Entity\Survery;

/**
* 
*/
class SurveryData
{
	protected $question;
	protected $jedzwielu;
	protected $wielezwielu;
	protected $ocena;
	protected $otwarte;
	
	function getQuestion()
	{
		return $this->question;
	}
	function getjedzwielu()
	{
		return $this->jedzwielu;
	}
	function getwielezwielu()
	{
		return $this->wielezwielu;
	}
	function getocena()
	{
		return $this->ocena;
	}
	function getotwarte()
	{
		return $this->otwarte;
	}
}