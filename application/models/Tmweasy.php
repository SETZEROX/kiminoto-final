<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tmweasy extends CI_Model {
	
function wallet_connecting($tmuser,$tmpassword,$trueemail,$truepassword,$ip,$session,$transactionid,$action,$ref1){
	$url="http://tmwallet.thaighost.net/apiwallet.php";
	$urlconnect=$url."?username=$tmuser&password=$tmpassword&action=$action&tmemail=$trueemail&truepassword=$truepassword&session=$session&transactionid=$transactionid&clientip=$ip&ref1=$ref1";
	$callback=@file_get_contents($urlconnect);
	return $callback;
}
function bank_connecting($tmuser,$tmpassword,$trueemail,$truepassword,$ip,$session,$transactionid,$action,$ref1,$ac_code){
	$url="http://tmwallet.thaighost.net/apiwallet.php";
	$urlconnect=$url."?username=$tmuser&password=$tmpassword&action=$action&tmemail=$trueemail&truepassword=$truepassword&session=$session&transactionid=$transactionid&clientip=$ip&ref1=$ref1&json=1&ac_code=$ac_code";
	$callback=@file_get_contents($urlconnect);
	return $callback;
}
function capchar($ip,$tmuser){
	return md5($tmuser.$ip);
}

function my_ip(){
		$IP = $_SERVER["REMOTE_ADDR"];
		return $IP;
}

}