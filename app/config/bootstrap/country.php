<?php
use app\models\Countries;

	$response = file_get_contents("http://ipinfo.io/".$_SERVER['REMOTE_ADDR']);
	
	$IPResponse = json_decode($response);
	
	global $cannotRegister, $userCountry, $userState;
	$cannotRegister = "false";
	$userCountry = $IPResponse->country;
	$userState = $IPResponse->region;
	$banned = Countries::find('first',array(
		'conditions'=>array(
				'ISO'=>$IPResponse->country,
		)
	));
	
	if(count($banned)>0){
		$cannotRegister = "true";
		$userCountry = $banned['ISO'];
		$userState = $IPResponse->region;
		if($banned['ISO']=='US'){
			$bannedRegion = Countries::find('first',array(
				'conditions'=>array(
						'ISO'=>$IPResponse->country,
						'State'=>$IPResponse->region
				)
			));
			if(count($bannedRegion)>0){
					$cannotRegister = "true";
			}else{
					$cannotRegister = "false";
			}
		}
		
	}

?>