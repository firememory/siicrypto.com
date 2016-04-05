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
		
		Transactions::meta('connection', 'SiiCrypto');			
		Details::meta('connection', 'SiiCrypto');			
		Users::meta('connection', 'SiiCrypto');
		
		$Transactions = Transactions::find('first',array(
			'conditions'=>array('TransactionHash' => $s)
		));
		if($Transactions['_id']!=""){
				exit;
		}
		
		
			$greencoin = new Greencoin('http://'.GREENCOIN_WALLET_SERVER.':'.GREENCOIN_WALLET_PORT,GREENCOIN_WALLET_USERNAME,GREENCOIN_WALLET_PASSWORD);
			$paytxfee = Parameters::find('first');
			$txfee = $paytxfee['payxgctxfee'];
 //print_r($s);
		$getrawtransaction = $greencoin->getrawtransaction($s);
	//		print_r($getrawtransaction);
		$decoderawtransaction = $greencoin->decoderawtransaction($getrawtransaction);		
		if(count($decoderawtransaction['vout'])>0){
			foreach($decoderawtransaction['vout'] as $out){
				foreach($out['scriptPubKey']['addresses'] as $address){
				
					$username = $greencoin->getaccount($address);
//				print_r($address);
					$Amount = (float)$out['value'];
//					print_r($Amount);
					print_r($username);
					if($username!=""){
						$Transactions = Transactions::find('first',array(
							'conditions'=>array('TransactionHash' => $s)
						));
						if($Transactions['_id']==""){
							$t = Transactions::create();
							$Amount = $Amount;
							$comment = "Move from User: ".$username."; Address: ".GREENCOINX_ADDRESS."; Amount:".$Amount.";";
							$transfer = $greencoin->move($username, "NilamDoctor", (float)$Amount, (int)0,$comment);
							
							if(isset($transfer['error'])){
								$error = $transfer['error']; 
							}else{
								$error = $transfer;
							}
						$data = array(
							'DateTime' => new \MongoDate(),
							'TransactionHash' => $s,
							'username' => $username,
							'address'=>$address,							
							'Currency'=>'XGC',							
							'Amount'=> $Amount,
							'Added'=>true,
							'Transfer'=>$comment,
							'transaction' => $transfer
						);							
						$t->save($data);
						$userName = str_replace("SiiCrypto-","",$username);
						$details = Details::find('first',
							array('conditions'=>array('username'=> (string) $userName))
						);
						$incoming = 0;
						$incoming = count($details['incoming']['XGC']);
						
						$user = Users::find('first',array(
							'conditions'=>array(
								'_id'=>$details['user_id'],
								'username'=>$details['username']
							)
						));
						$email = $user['email'];

// Send email to client for payment receipt, if invoice number is present. or not
//					/////////////////////////////////Email//////////////////////////////////////////////////
//					$emaildata = array(
//						'email'=>$email,
//						'transactions'=>$data
//					);
//						$function = new Functions();
//						$compact = array('data'=>$emaildata);
//						$from = array(NOREPLY => "noreply@siicrypto.com");
//						$email = $email;
//						$function->sendEmailTo($email,$compact,'users','transactionXGCReceived',"SiiCrypto.com - Received coins",$from,'','','',null);
//					/////////////////////////////////Email//////////////////////////////////////////////////				
// email send function	

							$dataDetails = array(
								'incoming.XGC.'.$incoming.'.Amount' => $Amount,
								'incoming.XGC.'.$incoming.'.tx'=> $s,
								'incoming.XGC.'.$incoming.'.Address'=>$address,
								'XGCnewaddress'=>'Yes'						
							);
							
							$data = array(
							'DateTime' => new \MongoDate(),
							'Amount'=> (float)number_format($Amount,8),
							'Currency'=> 'XGC',						
							'username' => $username,
							);
							$function = new Functions();
							$returnvalues = $function->twilio($data);	 // Testing if it works 

						print_r($dataDetails);
							$details = Details::find('all',
								array(
										'conditions'=>array('username'=>(string)$userName)
									))->save($dataDetails);
						}else{
							$Transactions = Transactions::find('first',array(
								'conditions'=>array('TransactionHash' => $s)
							))->save($data);
						}
					}
				}
			}
			}
		}
} 
?>