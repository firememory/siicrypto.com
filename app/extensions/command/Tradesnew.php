<?php
namespace app\extensions\command;

use app\models\Trades;
use app\models\Details;
use app\models\Parameters;

class Tradesnew extends \lithium\console\Command {
	public function index() {

		$details = Details::find('all',array(
			'conditions'=>array(
				'username'=>array('$regex'=>'SiiUser'),
			)
		));
		$trades = Trades::find('all');
		
		foreach ($trades as $trade){
		
					$pair = substr($trade['trade'],0,3) ."_" . substr($trade['trade'],4,3);	
					$amount = $trade['amount']+($this->float_rand(0,1,3)) ;;
					$price = $trade['Base']+($this->float_rand(0,0.5,4)) ;
					
					if(round($this->float_rand(0,1,0),0)!=0){
						$ActionX = "Buy";
						$usernameX = "SiiUserA";
						$ActionY = "Sell";
						$usernameY = "SiiUserB";
						$nounce = time();
					}else{
						$ActionX = "Sell";
						$usernameX = "SiiUserB";
						$ActionY = "Buy";
						$usernameY = "SiiUserA";
						$nounce = time();
						}

					foreach ($details as $detail){
						if($usernameX==$detail['username']){
							$keyX = $detail['key'];
						}
						if($usernameY==$detail['username']){
							$keyY = $detail['key'];
						}						
					}

		$url = "https://siicrypto.com/API/Trade/".$keyX;
		$fields = array();
		$fields_string = "";
		$fields = array(
				'username' => $usernameX,
				'type'=> $ActionX,
				'pair'=>$pair,
				'amount'=>$amount,
				'price'=>$price,
				'nounce'=>$nounce
		);
print_r($pair)		;

		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');

print_r("\n");
print_r($fields_string);
print_r("\n");


		$useragent="Fake Mozilla 5.0 ";
		$ch = curl_init();

			//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_VERBOSE, false);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER ,false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

			//execute post
			$result = curl_exec($ch);

			curl_close($ch);

		///////////////////////////////////////////////////////////////////////////////////		
		$fields = array();
		$fields_string = "";
	
		$url = "https://siicrypto/API/Trade/".$keyY;
		$fields = array(
				'username' => $usernameY,
				'type'=> $ActionY,
				'pair'=>$pair,
				'amount'=>$amount,
				'price'=>$price,
				'nounce'=>$nounce
		);
		print_r($pair)		;

		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
print_r("\n");
print_r($fields_string);
print_r("\n");
		
		$useragent="Fake Mozilla 5.0 ";
		$ch = curl_init();

			//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_VERBOSE, false);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER ,false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

			//execute post
			$result = curl_exec($ch);

			curl_close($ch);
				
		}
		
	}
	
	function float_rand($Min, $Max, $round=0){
    //validate input
    if ($min>$Max) { $min=$Max; $max=$Min; }
        else { $min=$Min; $max=$Max; }
    $randomfloat = $min + mt_rand() / mt_getrandmax() * ($max - $min);
    if($round>0)
        $randomfloat = round($randomfloat,$round);

    return $randomfloat;
	}
}

?>