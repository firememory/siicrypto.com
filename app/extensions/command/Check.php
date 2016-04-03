<?php 
namespace app\extensions\command;
use app\models\Details;
use app\models\Users;

use app\extensions\action\Greencoin;

class Check extends \lithium\console\Command {
 public function run($s=null) {

			$greencoin = new Greencoin('http://'.GREENCOIN_SERVER.':'.GREENCOIN_PORT,GREENCOIN_USERNAME,GREENCOIN_PASSWORD);
			$getinfo = $greencoin->getinfo();
//			print_r($getinfo);
			
			$bitcoin = new Greencoin('http://'.BITCOIN_SERVER.':'.BITCOIN_PORT,BITCOIN_USERNAME,BITCOIN_PASSWORD);
			$getinfo = $bitcoin->getinfo();
//			print_r($getinfo);
			
			$address = $greencoin->getnewaddress("SiiCrypto-".$user['username']);			
			if($address['error']){
				print_r($address);
				$address = $greencoin->getnewaddress("SiiCrypto-".$user['username']);
			}
			print_r($address);
			Details::meta('connection', 'SiiCrypto');			
			$detail = Details::count();
			print_r($detail."\n");
			
			Details::meta('connection', 'default');			
			$detail = Details::count();
			print_r($detail."\n");

			Details::meta('connection', 'SiiCrypto');			
			$detail = Details::count();
			print_r($detail."\n");
			
			Details::meta('connection', 'default');			
			$detail = Details::count();
			print_r($detail."\n");

			Details::meta('connection', 'SiiCrypto');			
			$detail = Details::count();
			print_r($detail."\n");

		}
} 
?>