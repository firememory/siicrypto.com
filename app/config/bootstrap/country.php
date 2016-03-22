<?php
use app\models\Countries;

	$response = file_get_contents("http://ipinfo.io/".$_SERVER['REMOTE_ADDR']);
	
	$IPResponse = json_decode($response);
	print_r($IPResponse);
	global $cannotRegister, $userCountry, $userState;
	
	$cannotRegister = "false";
	$GLOBALS['userCountry'] = $IPResponse->country;
	$GLOBALS['userState'] = $IPResponse->region;
	var_dump($cannotRegister,$userCountry,$userState);
	$banned = Countries::find('first',array(
		'conditions'=>array(
				'ISO'=>$IPResponse->country,
		)
	));
	var_dump($banned['ISO']);
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
			var_dump($bannedRegion['State']);
			if(count($bannedRegion)>0){
					$cannotRegister = "true";
			}else{
					$cannotRegister = "false";
			}
		}
		
	}

?>