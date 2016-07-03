<?
namespace checkdigit;

class ISBN
{
	static private function strip($p_isbn)
	{
		return str_replace("-","",$p_isbn);
	}
	static private function calc10($p_isbn)
	{		
		$l_isbn="$p_isbn";				
		$l_chk=0;		
		for($l_cnt=0;$l_cnt<9;$l_cnt++){
			$l_ch=$p_isbn[$l_cnt];
			if(($l_ch>='0') && ($l_ch<='9')){
				$l_chk += (10-$l_cnt)*(ord($l_ch)-48);								
			} else {						
				return NULL;
			}
		}
		
		return $l_chk %11;
	}
	
	static private function calc13($p_isbn)
	{
		$l_isbn="$p_isbn";
		$l_chk=0;
		for($l_cnt=0;$l_cnt<12;$l_cnt++){
			$l_ch=$p_isbn[$l_cnt];
			if(($l_ch>='0') && ($l_ch<='9')){
				$l_chk+= ((($l_cnt & 1) ==1)?3:1)*(ord($l_ch)-48);
			}else {
				
				return NULL;
			}
		}
		
		return $l_chk % 10;
	}
	
	
	static public function check($p_isbn)
	{
		$l_isbn=self::strip($p_isbn);
		if(strlen($l_isbn)==10){
			$l_check=self::calc10($l_isbn);
			if($l_check===NULL) return false;
			$l_chs=$l_isbn[9];
			if($l_chs=="X"){
				$l_chs=10;
			} else if ($l_chs>='0' && $l_chs<='9'){
				$l_chs=ord($l_chs)-48;
			}  else {
				return false;
			}			
			return  ($l_check+$l_chs == 11) ;
		} else if(strlen($l_isbn)==13){
			$l_check=self::calc13($l_isbn);
			if($l_check>0) $l_check=10-$l_check;
			return chr($l_check+48)==$l_isbn[12];
		} else {
			return false;
		}
	}
	
	static public function calculate($p_isbn)
	{
		$l_isbn=self::strip($p_isbn);
		if(strlen($l_isbn)==9){
			$l_chk=self::calc10($l_isbn);
			if($l_chk===false) return NULL;
			$l_num=(11-$l_chk) % 11;			
			return $p_isbn.'-'.(($l_num==10)?"X":$l_num);
		} else if(strlen($l_isbn)==12){
			$l_check=self::calc13($l_isbn);
			if($l_check==false) return NULL;
			if($l_check != 0) $l_check=10-$l_check;
			return $p_isbn."-".$l_check;
		} else {
			return NULL;
		}
	}
	
}