<?php
namespace checkdigit;
/**
* Check digit by the Verhoeff algorithm (Jacabus Verhoeff 1969)
*/
class verhoeff
{
	static private $d=[
	 [0,1,2,3,4,5,6,7,8,9]
	,[1,2,3,4,0,6,7,8,9,5]
	,[2,3,4,0,1,7,8,9,5,6]
	,[3,4,0,1,2,8,9,5,6,7]
	,[4,0,1,2,3,9,5,6,7,8]
	,[5,9,8,7,6,0,4,3,2,1]
	,[6,5,9,8,7,1,0,4,3,2]
	,[7,6,5,9,8,2,1,0,4,3]
	,[8,7,6,5,9,3,2,1,0,4]
	,[9,8,7,6,5,4,3,2,1,0]
	];
	static private $p=[
	 [0,1,2,3,4,5,6,7,8,9]
	,[1,5,7,6,2,8,3,0,9,4]
	,[5,8,0,3,7,9,6,1,4,2]
	,[8,9,1,6,0,4,3,5,2,7]
	,[9,4,5,3,1,2,6,8,7,0]
	,[4,2,8,6,5,7,3,9,0,1]
	,[2,7,9,3,8,0,6,4,1,5]
	,[7,0,4,6,9,1,3,2,5,8]
	];
	
	static private $inv=
	[0,4,3,2,1,5,6,7,8,9];
	
/**
*Internal function for calculating a checkdigit or checking a number
*
*@param $p_number  
*@return When calculating check digit: returns check digit
*        When checking a number:0 ->number is corrext  !=0 number is not correct
*/
	static private function _calculate($p_number)
	{
		$l_number="${p_number}";
		$l_c=0;
		$l_le=strlen($p_number);
		$l_cnt=0;
		while($l_cnt<$l_le){
			$l_ch=$p_number[$l_le-$l_cnt-1];
			if($l_ch<'0' || $l_ch>'9') throw new  \InvalidArgumentException("Parameter is not a number");
			$l_c=self::$d[$l_c][self::$p[$l_cnt % 8][ord($l_ch)-48]];
			$l_cnt++;
		}
		return self::$inv[$l_c];
	}
	
/**
*Calculates a Verhoeff check digit and appends it to the end
*
*
*@param p_number a number
*@return The resulting number can be check with the check method
*/	
	static function calculate($p_number)
	{
		$l_c=self::_calculate($p_number."0");
		return "$p_number${l_c}";
	}
	
/**
*Checks if number is correct
*
* @param p_number Nmber calculated with the "calculate" method
* @return boolean true- number is correct false number is not correct.
*/
	static function check($p_number)
	{
		return self::_calculate($p_number)==0;
	}
}
