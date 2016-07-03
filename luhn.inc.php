<?
namespace checkdigit;

class Luhn
{
	static private function _calculate($p_number)
	{				
		$l_le=strlen($p_number);
		$l_c=0;
		for($l_cnt=0;$l_cnt<$l_le;$l_cnt++){
			$l_ch=$p_number[$l_le-$l_cnt-1];
			if($l_ch<'0' || $l_ch>'9') throw new \Exception("Is not a number");
			$l_num=ord($l_ch)-48;
			if(($l_cnt & 1)==1) $l_num=$l_num*2-(($l_num>=5)?9:0);
			$l_c += $l_num;
		}
		return $l_c % 10;
	}

	static function calculate($p_number)
	{		
		$l_c=self::_calculate($p_number."0");
		return $p_number.(10-$l_c);
	}
	
	static function check($p_number)
	{
		return self::_calculate($p_number)==0;
	}
	
}

?>