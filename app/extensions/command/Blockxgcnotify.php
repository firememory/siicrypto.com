<?php 
namespace app\extensions\command;

use app\models\Transactions;
use app\models\Details;
use app\models\Users;
use app\models\Parameters;
use app\extensions\action\Functions;

use app\extensions\action\Greencoin;

class Walletxgcnotify extends \lithium\console\Command {
    public function index($s=null) {
			$greencoin = new Greencoin('http://'.GREENCOIN_WALLET_SERVER.':'.GREENCOIN_WALLET_PORT,GREENCOIN_WALLET_USERNAME,GREENCOIN_WALLET_PASSWORD);
			$paytxfee = Parameters::find('first');
			$txfee = $paytxfee['payxgctxfee'];
// print_r($s);
		$getblock = $greencoin->getblock($s);
		foreach($getblock['tx']as $t){
		
			$getrawtransaction = $greencoin->getrawtransaction($t);
			//	print_r($getrawtransaction);
			$decoderawtransaction = $greencoin->decoderawtransaction($getrawtransaction);		

			foreach($decoderawtransaction['vout'] as $out){
				foreach($out['scriptPubKey']['addresses'] as $address){
		
					//	print_r($address);
					$Amount = (float)$out['value'];
					if($greencoin->getaccount($address)!=""){
						$username = $greencoin->getaccount($address);
						$userName = str_replace("SiiCrypto-","",$username);
						$details = Details::find('first',
							array('conditions'=>array('username'=> (string) $userName))
						);
						$NewBalance = $details['balance']['XGC'] + $details['incoming']['XGC']['Amount'];
						$data = array(
							'balance.XGC' => $NewBalance,
							'incoming.XGC.Amount' => 0,
							'incoming.XGC.tx'=> "",
							'incoming.XGC.Address'=>"",
							'XGCnewaddress'=>'Yes'						
						);
						$conditions = array('username'=> (string) $userName);
						$Details::update($data,$conditions);
					}
				}
			}
		}
	}
} 
?>