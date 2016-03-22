<?php
use app\models\Countries;

	$response = file_get_contents("http://ipinfo.io/".$_SERVER['REMOTE_ADDR']);
	
	$IPResponse = json_decode($response);
	
	define('CANNOTREGISTER', 'false');
	$banned = Countries::find('first',array(
		'conditions'=>array(
				'ISO'=>$IPResponse->country,
		)
	));
	if(count($banned)>0){
		define('CANNOTREGISTER', 'true');
		if($banned['ISO']=='US'){
			$bannedRegion = Countries::find('first',array(
				'conditions'=>array(
						'ISO'=>$IPResponse->country,
						'State'=>$IPResponse->region
				)
			));
			if(count($bannedRegion)>0){
					define('CANNOTREGISTER', 'true');
			}else{
					define('CANNOTREGISTER', 'false');
			}
		}
		
	}


?>