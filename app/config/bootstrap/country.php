<?php
use app\models\Countries;
use app\models\Details;
use lithium\storage\Session;

$user = Session::read('default');
$detail = Details::find('first',array(
	'conditions'=>array('username'=>$user['username'])
));

	print_r($user);
	
//	$IPResponse = json_decode($response);
//	print_r($IPResponse);
	global $cannotRegister, $userCountry, $userState;
	
	$GLOBALS['cannotRegister'] = "false";
	$GLOBALS['userCountry'] = $detail['lastconnected']['ISO'];
	$GLOBALS['userState'] = $detail['lastconnected']['region'];
//	var_dump($cannotRegister,$userCountry,$userState);
	$banned = Countries::find('first',array(
		'conditions'=>array(
				'ISO'=>$IPResponse->country,
		)
	));
//	var_dump($banned['ISO']);
	if(count($banned)>0){
		$GLOBALS['cannotRegister'] = "true";
		$userCountry = $banned['ISO'];
		$userState = $IPResponse->region;
		if($banned['ISO']=='US'){
			$bannedRegion = Countries::find('first',array(
				'conditions'=>array(
						'ISO'=>$IPResponse->country,
						'State'=>$IPResponse->region
				)
			));
//			var_dump($bannedRegion['State']);
			if(count($bannedRegion)>0){
					$GLOBALS['cannotRegister'] = "true";
			}else{
					$GLOBALS['cannotRegister'] = "false";
			}
		}
		
	}

?>