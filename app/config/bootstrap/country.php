<?php
use app\models\Countries;

	$response = file_get_contents("http://ipinfo.io/".$_SERVER['REMOTE_ADDR']);
	
	$IPResponse = json_decode($response);
	
	global $CANNOTREGISTER = "false";
	global $USERCOUNTRY = "";
	global $USERSTATE = "";
	$banned = Countries::find('first',array(
		'conditions'=>array(
				'ISO'=>$IPResponse->country,
		)
	));
	
	if(count($banned)>0){
		$CANNOTREGISTER = "true";
		$USERCOUNTRY = $banned['ISO'];
		$USERSTATE = $IPResponse->region;
		if($banned['ISO']=='US'){
			$bannedRegion = Countries::find('first',array(
				'conditions'=>array(
						'ISO'=>$IPResponse->country,
						'State'=>$IPResponse->region
				)
			));
			if(count($bannedRegion)>0){
					$CANNOTREGISTER = "true";
			}else{
					$CANNOTREGISTER = "false";
			}
		}
		
	}

?>