<?php
namespace checkdigit;

class Luhn
{
/**
*Calculates the Luhn check digits or checks is a number (Number + luhn digit) is correct
*@param $p_number number used for calculating the luhn number or number that needs to be checked
*@return  when calculating : Luhn digit
*/
	static private function _calculate($p_number)
	{				
		$l_le=strlen($p_number);
		$l_c=0;
		for($l_cnt=0;$l_cnt<$l_le;$l_cnt++){
			$l_ch=$p_number[$l_le-$l_cnt-1];
			if($l_ch<'0' || $l_ch>'9') throw new  \InvalidArgumentException("Parameter is not a number");
			$l_num=ord($l_ch)-48;
			if(($l_cnt & 1)==1) $l_num=$l_num*2-(($l_num>=5)?9:0);
			$l_c += $l_num;
		}
		return $l_c % 10;
	}

/**
*Calculate Luhn digit and add this to the end of the number.
*Thus resulting number can be checked by the check method
*
*@param $p_number integer
*@return  number in $p_number+check digit
*/
	static function calculate($p_number)
	{		
		$l_c=self::_calculate($p_number."0");
		return $p_number.(10-$l_c);
	}
	
/**
* Check if number (original number+Luhn check digit) is correct
*
*@param $p_number number to be checked (original number +checkdigit),calculated with the calculate methodx
*@return boolean true - number is correct, false - number is not correct
*/
	static function check($p_number)
	{
		return self::_calculate($p_number)==0;
	}
	
}

?>
