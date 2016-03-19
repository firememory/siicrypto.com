<?php 
namespace app\extensions\command;

use app\models\Notifies;

use app\extensions\action\Greencoin;

class WNotify extends \lithium\console\Command {
 public function index($s=null) {
			$greencoin = new Greencoin('http://'.GREENCOIN_WALLET_SERVER.':'.GREENCOIN_WALLET_PORT,GREENCOIN_WALLET_USERNAME,GREENCOIN_WALLET_PASSWORD);
			$getrawtransaction = $greencoin->getrawtransaction($s);
//		print_r($getrawtransaction);
			$decoderawtransaction = $greencoin->decoderawtransaction($getrawtransaction);		

			foreach($decoderawtransaction['vout'] as $out){
				foreach($out['scriptPubKey']['addresses'] as $address){
				
					$username = $greencoin->getaccount($address);
				print_r($address);
				print_r($username);
					$Amount = (float)$out['value'];
						$walletNotify = Notifies::find('first',array(
							'conditions'=>array(
								'TransactionHash' => $s,
								'address'=>$address
								)
						));
						if($walletNotify['_id']==""){
							$t = Notifies::create();
							$data = array(
								'DateTime' => new \MongoDate(),
								'TransactionHash' => $s,
								'username' => $username,
								'address'=>$address,							
								'Currency'=>'XGC',							
								'Amount'=> $Amount,
								'Added'=>true,
							);							
							$t->save($data);

					}
				}
			}
		}
} 
?>