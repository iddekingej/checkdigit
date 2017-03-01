<?php
/**
* Check digit invented by H. Michael Damm in 2004.
*/
namespace checkdigit;

class Damm
{
	static private $check=[
	 [0,3,1,7,5,9,8,6,4,2]
	,[7,0,9,2,1,5,4,8,6,3]
	,[4,2,0,6,8,7,1,3,5,9]
	,[1,7,5,0,9,8,3,4,2,6]
	,[6,1,2,3,0,4,5,9,7,8]
	,[3,6,7,4,2,0,9,5,8,1]
	,[5,8,6,9,7,2,0,1,3,4]
	,[8,9,4,5,3,6,2,0,1,7]
	,[9,4,3,8,6,1,7,2,0,5]
	,[2,5,8,1,4,3,6,7,9,0]
	];
	
/**
* Calculates and checks Damm number 
* 
*
*@param $p_number  Calculate Damm digit for this number or check if number is correct
*
*@return When checking a number:This routine returns 0 when number is valid
*        When calculating check digit: Return check digit for this number
*/
	static private function _calculate($p_number)
	{
		$l_number="$p_number";
		$l_le=strlen($l_number);
		$l_cnt=0;
		$l_c=0;
		while($l_cnt<$l_le){
			$l_ch=$p_number[$l_cnt];
			if($l_ch<'0' || $l_ch>'9') throw new \InvalidArgumentException("Number is not a integer");		
			$l_c=self::$check[$l_c][ord($l_ch)-48];
			$l_cnt++;
		}
		return $l_c;
	}
/**
* Calculate Damm digit and appends it at the end of the number, the resulted number can be checked
* by the check method
*
* @param $p_number  number to calculate the Damm digit for.
* @return  A string with the damm digit at the end 
*/
	static function calculate($p_number)
	{
		return "$p_number".self::_calculate($p_number);
	}
	
/**
*Checks the number, create by the "calculate" method,  if this number is valid 
*
*@param $p_number number to check
*@return true - number is correct
         false - number is not correct
*/
	static function check($p_number)
	{
		return self::_calculate($p_number)==0;
	}
}
