<?php
namespace app\extensions\action;
use app\extensions\action\CoinAddress;
use app\models\Details;
use app\models\Orders;
use app\models\Users;
use MongoID;

class MultiSig extends \lithium\action\Controller {

	public function createnew($id=null,$currency=null)
	{
		$coin = new Greencoin('http://'.GREENCOIN_WALLET_SERVER.':'.GREENCOIN_WALLET_PORT,GREENCOIN_WALLET_USERNAME,GREENCOIN_WALLET_PASSWORD);
				$k = 0;
				$details = Details::find('first',
					array('conditions'=>array('user_id'=> (string) $id))
				);

					$coin0 = CoinAddress::bitcoin();  
					$j = 0;
						for($i=count($details['coin'][$currency])-2;$i<count($details['coin'][$currency]);$i++){
							$NewCoin[$j] = $details['coin'][$currency][$i]['public_hex'];
							$j++;
						}
						
					$publickeys = array(
						$NewCoin[0],
						$NewCoin[1],
						$coin0['public_hex'],
					);		
					
					$security = (integer)2;
					$createMultiSig	= $coin->createmultisig($security,$publickeys);						
					
					$address = $createMultiSig['address'];
					$data = array(
						'addresses.'.$currency.'.'.(count($details['addresses'][$currency])).'.msx' => $createMultiSig,
						'addresses.'.$currency.'.'.(count($details['addresses'][$currency])).'.balance'=>0,
						'addresses.'.$currency.'.'.(count($details['addresses'][$currency])).'.transactions'=>'N',
						'addresses.'.$currency.'.'.(count($details['addresses'][$currency])).'.numbers'=>array($i-2,$i-1,$i),
						'addresses.'.$currency.'.'.(count($details['addresses'][$currency])).'.checkbalance' => 'Y',
						'coin.'.$currency.'.'.(count($details["coin"][$currency])).'.public' => $coin0['public'],
						'coin.'.$currency.'.'.(count($details["coin"][$currency])).'.public_hex' => $coin0['public_hex'],
						'coin.'.$currency.'.'.(count($details["coin"][$currency])).'.private' => $coin0['private'],
						'coin.'.$currency.'.'.(count($details["coin"][$currency])).'.private_hex' => $coin0['private_hex']
					);
					$conditions = array('user_id'=> (string) $id);
					Details::update($data,$conditions);
					return $address;
	}

	function UpdateBalance($currency,$id){
		$details = Details::find('first',
			array('conditions'=>array('user_id'=>(string)$id))
		);
			$opts = array(
			  'http'=> array(
					'method'=> "GET",
					'user_agent'=> "MozillaXYZ/1.0"));
			$context = stream_context_create($opts);
			
		if($currency=="BTC"){
			$i = 0;
			foreach($details['addresses'][$currency] as $check){
				if($check['checkbalance']=="Y"){
					$address = $check['msx']['address'];
					break;
				}
				$i++;
			}
			$opts = array(
			  'http'=> array(
					'method'=> "GET",
					'user_agent'=> "MozillaXYZ/1.0"));
			$context = stream_context_create($opts);
			
			$url = 'https://blockchain.info/address/'.$address.'?format=json';
			$json_data = file_get_contents($url, false, $context);
			$json_feed = json_decode($json_data);
			$Balance = $json_feed->final_balance;
			if($Balance>0){
				$data = array(
					'balance.'.$currency => $details['balance'][$currency] + ($Balance / 100000000),
					'addresses.'.$currency.".".$i.'.balance' => $Balance,
					'addresses.'.$currency.".".$i.'.checkbalance' => 'N',
				);
				$conditions = array(
					'user_id'=>(string)$id
				);
				Details::update($data,$conditions);
			}

		}
		
		if($currency=="XGC"){
			$i = 0;
			foreach($details['addresses'][$currency] as $check){
				if($check['checkbalance']=="Y"){
					$address = $check['msx']['address'];
					break;
				}
				$i++;
			}
			
			$url = 'https://xgcwallet.org/ex/txes/'. $address;
			$json_data = file_get_contents($url, false, $context);
			$json_feed = json_decode($json_data);
			$Balance = $json_feed->received;
			if($Balance>0){
				$data = array(
					'balance.'.$currency => $details['balance'][$currency] + ($Balance),
					'addresses.'.$currency.".".$i.'.balance' => $Balance,
					'addresses.'.$currency.".".$i.'.checkbalance' => 'N',
				);
				$conditions = array(
					'user_id'=>(string)$id
				);
				Details::update($data,$conditions);
			}

		}
	}

	public function transferMultiSig($id=null){
		$Order = Orders::find('first',array(
			'conditions' => array('_id' => new MongoID($id))
		));
		$detail = Details::find('first',array(
			'conditions'=>array('user_id'=>$Order['user_id'])
		));
		
		$myfile = fopen("MultiSigX.txt", "a") or die("Unable to open file!");
		$txt = $Order['username'];
		fwrite($myfile, $txt);
		fclose($myfile);
		
	}
	
}
?>