<?php
require "verhoeff.inc.php";
require "damm.inc.php";
require "luhn.inc.php";
require "isbn.inc.php";
$l_res=checkdigit\verhoeff::calculate("236");
echo "Verhoeff :",$l_res,'#',checkdigit\verhoeff::check($l_res),"<=This should return 1\n";
echo "Verhoeff :",$l_res,'#',checkdigit\verhoeff::check($l_res."1"),"<=This should empty after the #\n";
try{
	$l_res=checkdigit\verhoeff::calculate("236x");
	echo "Verhoeff: Invalid digit not detected \n";
}catch(InvalidArgumentException $l_e){
	echo "Verhoeff: Detected invalid digit \n";
}
$l_res=checkdigit\damm::calculate("572");
echo "DAMM:",$l_res,'#',checkdigit\damm::check($l_res),"<==returns 1 \n";
try{
	$l_res=checkdigit\damm::calculate("1a");
	echo "DAMM: Invalid digit not detected \n";
} catch(InvalidArgumentException $l_e){
	echo "DAMM: Detected invalid digit \n";
}
$l_res=checkdigit\luhn::calculate('7992739871');
echo "LUHN ",$l_res,"-",checkdigit\luhn::check($l_res),"\n";
try{
$l_res=checkdigit\luhn::calculate('79927398X1');
echo "LUHN: Invalid digit not detected";
}catch(InvalidArgumentException $l_e){
	echo "Luhn: Detected invalid digit \n";
}
$l_res=checkdigit\isbn::calculate("90-5831-030");
echo "ISBN ",$l_res,"#",checkdigit\isbn::check($l_res),"<= This should return 1\n";
echo "ISBN ",$l_res,"#",checkdigit\isbn::check('978-1-4472-0536-5'),"<=This should return an empty value after #\n";
$l_res=checkdigit\isbn::calculate("978905294455");
echo "ISBN ",$l_res,"#",checkdigit\isbn::check($l_res),"<= This should return 1 \n";
