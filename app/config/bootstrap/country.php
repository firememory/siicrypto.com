<?php
use app\models\Countries;
use app\models\Details;
use lithium\storage\Session;

$user = Session::read('default');
$detail = Details::find('first',array(
	'conditions'=>array('username'=>$user['username'])
));

//	print_r($detail['lastconnected']['ISO']);
	
	global $cannotRegister, $userCountry, $userState;
	
	$GLOBALS['cannotRegister'] = "false";
	$GLOBALS['userCountry'] = $detail['lastconnected']['ISO'];
	$GLOBALS['userState'] = $detail['lastconnected']['region'];
//	var_dump($cannotRegister,$userCountry,$userState);
	$banned = Countries::find('first',array(
		'conditions'=>array(
				'ISO'=>$GLOBALS['userCountry'],
		)
	));
//	print_r($GLOBALS['userCountry']);
//	print_r($banned['Country']);
//	var_dump($banned['ISO']);
	if(count($banned)>0){
		$GLOBALS['cannotRegister'] = "true";
		$userCountry = $banned['ISO'];
		$userState = $GLOBALS['userState'];
		if($banned['ISO']=='US'){
			$bannedRegion = Countries::find('first',array(
				'conditions'=>array(
						'ISO'=>$GLOBALS['userCountry'],
						'State'=>$GLOBALS['userState']
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