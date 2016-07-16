<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\controllers;
use app\models\Parameters;
use app\models\Details;
use app\models\Trades;
use app\models\Orders;
use MongoDate;
use MongoID;
use lithium\security\Auth;


use app\controllers\ExController;
use lithium\data\Connections;
use app\extensions\action\OrderFunctions;
use lithium\storage\Session;
use app\extensions\action\Bitcoin;
use app\extensions\action\Litecoin;
use app\extensions\action\Greencoin;
use lithium\util\String;

class UpdatesController extends \lithium\action\Controller {

	public function index() {
		return $this->render(array('layout' => false));
	}

	public function to_string() {
		return "Hello World";
	}

	public function to_json() {
		return $this->render(array('json' => 'Hello World'));
	}

	public function CheckServer(){
	$parameters = Parameters::find('first');
		if($parameters['server']==true){
			return $this->render(array('json' => array(
				'Refresh'=> 'Yes',
			)));
		}else{
			return $this->render(array('json' => array(
				'Refresh'=> 'No',
			)));
		}
	}

	public function Rates($FirstCurrency="BTC",$SecondCurrency="USD") {

		$title = $FirstCurrency . "/" . $SecondCurrency;
		$back = strtolower($FirstCurrency . "_" . $SecondCurrency);		

		$Refresh = "No";
		
		$user = Session::read('member');
		$id = $user['_id'];
		$details = Details::find('first',
			array('conditions'=>array('user_id'=>$id))
		);
		if($details['page.refresh']==true || $details['page.refresh']==1){
				$data = array(
				'page.refresh' => false
				);
				Details::find('all',
				array('conditions'=>array('user_id'=>$id))				
				)->save($data);
			$Refresh = "Yes";
		}
		
			$URL = "/".$locale.'ex/x/'.$back;					
			$trades = Trades::find('first',array(
				'conditions' => array('trade'=>$title),
			));
			
			if($trades['refresh']==true || $trades['refresh']==1){
				$data = array(
				'refresh' => false
				);
				Trades::find('all',array(
					'conditions' => array('trade'=>$title)
				))->save($data);
				$Refresh = "Yes";
			}

//		$mongodb = Connections::get('default')->connection;
		$Rates = Orders::connection()->connection->command(array(
			'aggregate' => 'orders',
			'pipeline' => array( 
				array( 
				'$project' => array(
					'_id'=>0,
					'Action' => '$Action',
					'PerPrice'=>'$PerPrice',					
					'Completed'=>'$Completed',					
					'FirstCurrency'=>'$FirstCurrency',
					'SecondCurrency'=>'$SecondCurrency',	
					'TransactDateTime' => '$Transact.DateTime',
				)),
				array('$match'=>array(
					'Completed'=>'Y',					
					'FirstCurrency' => $FirstCurrency,
					'SecondCurrency' => $SecondCurrency,					
					)),
				array('$group' => array( '_id' => array(
							'year'=>array('$year' => '$TransactDateTime'),
							'month'=>array('$month' => '$TransactDateTime'),						
							'day'=>array('$dayOfMonth' => '$TransactDateTime'),												
//							'hour'=>array('$hour' => '$TransactDateTime'),
						),
					'min' => array('$min' => '$PerPrice'), 
					'max' => array('$max' => '$PerPrice'), 
				)),
				array('$sort'=>array(
					'_id.year'=>-1,
					'_id.month'=>-1,
					'_id.day'=>-1,					
//					'_id.hour'=>-1,					
				)),
				array('$limit'=>1)
			)
		));

//		print_r($Rates['result']);
		foreach($Rates['result'] as $r){
			$Low = $r['min'];
			$High = $r['max'];			
		}

		$Last = Orders::find('all',array(
			'conditions'=>array(
				'Completed'=>'Y',					
				'FirstCurrency' => $FirstCurrency,
				'SecondCurrency' => $SecondCurrency,					
				),
			'limit'=>1,
			'order'=>array('Transact.DateTime'=>'DESC')
		));
		foreach($Last as $l){
			$LastPrice = $l['PerPrice'];
		}
		
		$TotalOrders = Orders::connection()->connection->command(array(
			'aggregate' => 'orders',
			'pipeline' => array( 
				array( '$project' => array(
					'_id'=>0,
					'Action'=>'$Action',					
					'Amount'=>'$Amount',
					'Completed'=>'$Completed',					
					'FirstCurrency'=>'$FirstCurrency',
					'SecondCurrency'=>'$SecondCurrency',	
					'TransactDateTime' => '$Transact.DateTime',					
					'TotalAmount' => array('$multiply' => array('$Amount','$PerPrice')),
				)),
				array('$match'=>array(
					'Completed'=>'Y',	
					'Action'=>'Buy',										
					'FirstCurrency' => $FirstCurrency,
					'SecondCurrency' => $SecondCurrency,					
					)),
				array('$group' => array( '_id' => array(
					'year'=>array('$year' => '$TransactDateTime'),
					'month'=>array('$month' => '$TransactDateTime'),						
					),
					'Amount' => array('$sum' => '$Amount'), 
					'TotalAmount' => array('$sum' => '$TotalAmount'), 
				)),
				array('$sort'=>array(
					'_id.year'=>-1,
					'_id.month'=>-1,
				)),
				array('$limit'=>1)
			)
		));
//		print_r($SecondCurrency);
		return $this->render(array('json' => array(
			'Refresh'=> $Refresh,
			'URL'=> $URL,
			'Low'=> number_format($Low,5),
			'High' => number_format($High,5),
			'Last'=> number_format($LastPrice,5),			
			'VolumeFirst'=> number_format($TotalOrders['result'][0]['Amount'],5),
			'VolumeSecond'=> number_format($TotalOrders['result'][0]['TotalAmount'],5),
			'VolumeFirstUnit'=> $FirstCurrency,			
			'VolumeSecondUnit'=> $SecondCurrency,
		)));
	}
	public function Commission(){
		$commission = Parameters::find('first',
			array('conditions'=>array('commission'=>true))
		);
		return $this->render(array('json' => array(
			'Commission' => $commission['value']
		)));
	}
	public function BuyFormSubmit($BuyAmount,$BuyPricePer,$Fees,$GrandTotal){
//	print_r($BuyAmount);
//	print_r($BuyPricePer);
//	print_r($Fees);
//	print_r($GrandTotal);		
	exit;
	}
	
	public function Address($address = null){
		$bitcoin = new Bitcoin('http://'.BITCOIN_WALLET_SERVER.':'.BITCOIN_WALLET_PORT,BITCOIN_WALLET_USERNAME,BITCOIN_WALLET_PASSWORD);
			$verify = $bitcoin->validateaddress($address);
			return $this->render(array('json' => array(
			'verify'=> $verify,
		)));
	}

	public function CurrencyAddress($currency=null,$address = null){
		///////////////////// Change of code required when Virtual Currency added			
		switch($currency){
			case "BTC":
			$coin = new Bitcoin('http://'.BITCOIN_WALLET_SERVER.':'.BITCOIN_WALLET_PORT,BITCOIN_WALLET_USERNAME,BITCOIN_WALLET_PASSWORD);
			break;

			case "XGC":
			$coin = new Greencoin('http://'.GREENCOIN_WALLET_SERVER.':'.GREENCOIN_WALLET_PORT,GREENCOIN_WALLET_USERNAME,GREENCOIN_WALLET_PASSWORD);
			break;
			
			case "LTC":
			$coin = new Litecoin('http://'.LITECOIN_WALLET_SERVER.':'.LITECOIN_WALLET_PORT,LITECOIN_WALLET_USERNAME,LITECOIN_WALLET_PASSWORD);
			break;
		}
		// End of /////////////////// Change of code required when Virtual Currency added			
			$verify = $coin->validateaddress($address);
			return $this->render(array('json' => array(
			'verify'=> $verify,
			'currency'=>$currency,
		)));
	}

	public function OHLC($FirstCurrency="BTC",$SecondCurrency="GBP"){
			$StartDate = new MongoDate(strtotime(gmdate('Y-m-d H:i:s',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-60*60*24*2)));
			$EndDate = new MongoDate(strtotime(gmdate('Y-m-d H:i:s',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))+60*60*24*1)));
//	print_r($StartDate);
//	print_r($EndDate);
		$mongodb = Connections::get('default')->connection;
		$Rates = Orders::connection()->connection->command(array(
			'aggregate' => 'orders',
			'pipeline' => array( 
				array( 
				'$project' => array(
					'_id'=>0,
					'Action' => '$Action',
					'PerPrice'=>'$PerPrice',			
					'Amount' => '$Amount',
					'Completed'=>'$Completed',					
					'FirstCurrency'=>'$FirstCurrency',
					'SecondCurrency'=>'$SecondCurrency',	
					'TransactDateTime' => '$Transact.DateTime',
				)),
				array('$match'=>array(
					'Completed'=>'Y',					
					'FirstCurrency'=>$FirstCurrency,
					'SecondCurrency'=>$SecondCurrency,							
					'TransactDateTime'=> array( '$gte' => $StartDate, '$lte' => $EndDate )
					)),
				array('$group' => array( '_id' => array(
							'year'=>array('$year' => '$TransactDateTime'),
							'month'=>array('$month' => '$TransactDateTime'),						
							'day'=>array('$dayOfMonth' => '$TransactDateTime'),												
  						'hour'=>array('$hour' => '$TransactDateTime'),
							'FirstCurrency'=>'$FirstCurrency',
							'SecondCurrency'=>'$SecondCurrency',							
						),
					'Open' => array('$first' => '$PerPrice'), 						
					'High' => array('$max' => '$PerPrice'), 
					'Low' => array('$min' => '$PerPrice'), 
					'Close' => array('$last' => '$PerPrice'), 					
					'Volume'=> array('$sum'=>'$Amount'),
				)),
				array('$sort'=>array(
					'_id.year'=>1,
					'_id.month'=>1,
					'_id.day'=>1,					
					'_id.hour'=>1,					
				)),
//				array('$limit'=>1)
			)
		));

			return $Rates;
	
	}
	public function Orders($FirstCurrency="BTC",$SecondCurrency="USD"){
	$user = Session::read('member');
	$OrderFunctions = new OrderFunctions();
	$aa = $OrderFunctions->index();
	$TotalSellOrders = $OrderFunctions->TotalSellOrders($FirstCurrency,$SecondCurrency);
//	print_r($TotalSellOrders);
	$TotalBuyOrders =  $OrderFunctions->TotalBuyOrders ($FirstCurrency,$SecondCurrency);
//	print_r($TotalBuyOrders);
	$SellOrders =  $OrderFunctions->SellOrders ($FirstCurrency,$SecondCurrency);
	
	$BuyOrders =  $OrderFunctions->BuyOrders ($FirstCurrency,$SecondCurrency);
	
	
	foreach($TotalBuyOrders['result'] as $TBO){
		$BuyAmount = $TBO['Amount'];
		$BuyTotalAmount = $TBO['TotalAmount'];
	}
$BuyOrdersHTML = '<table class="table table-condensed table-bordered table-hover"  style="font-size:12px "><thead><tr><th style="text-align:center " rowspan="2">#</th><th style="text-align:center ">Price</th><th style="text-align:center ">'.$FirstCurrency.'</th><th style="text-align:center ">'.$SecondCurrency.'</th></tr><tr><th style="text-align:center " >Total &raquo;</th><th style="text-align:right " >'.number_format($BuyAmount,8).'</th><th style="text-align:right " >'.number_format($BuyTotalAmount,8).'</th></tr></thead><tbody>';
					$ids = '';$i = 0;
					$BuyOrderAmount = 0;$FillBuyOrderAmount = 0;
					foreach($BuyOrders['result'] as $BO){
						if($i==20){break;}else{$i++;}
							if($user['_id']!=$BO['_id']['user_id']){
								$FillBuyOrderAmount = $FillBuyOrderAmount + round($BO['Amount'],8);
								$BuyOrderAmount = $BuyOrderAmount + round($BO['Amount'],8);													
								$TotalBuyOrderPrice = ($TotalBuyOrderPrice + round($BO['_id']['PerPrice']*$BO['Amount'],8));
								$BuyOrderPrice = round($TotalBuyOrderPrice/$BuyOrderAmount,8);
								$ids = $ids .','.(string)$BO['_id']['_id']->{'$id'}.'';
							}
							$BuyOrdersHTML = $BuyOrdersHTML . '<tr onClick="BuyOrderFill('.$BuyOrderPrice.','.$BuyOrderAmount.',\''.$ids.'\');" style="cursor:pointer;';
							if($user['_id']==$BO['_id']['user_id']){
								$BuyOrdersHTML = $BuyOrdersHTML .'background-color:#A5FC8F;"';
							}else{
								$BuyOrdersHTML = $BuyOrdersHTML .'"';
							}
							$BuyOrdersHTML = $BuyOrdersHTML .	'class=" tooltip-x" rel="tooltip-x" data-placement="top" title="Sell '.$BuyOrderAmount.' '.$FirstCurrency.' at '.$BuyOrderPrice.' '.$SecondCurrency.'">';
							$BuyOrdersHTML = $BuyOrdersHTML .	'<td style="text-align:right">'.$BO['No'].'</td>';
							$BuyOrdersHTML = $BuyOrdersHTML .	'<td style="text-align:right">'.number_format(round($BO['_id']['PerPrice'],8),8).'</td>';
							$BuyOrdersHTML = $BuyOrdersHTML .	'<td style="text-align:right">'.number_format(round($BO['Amount'],8),8).'</td>';
							$BuyOrdersHTML = $BuyOrdersHTML .	'<td style="text-align:right">'.number_format(round($BO['_id']['PerPrice']*$BO['Amount'],8),8).'</td></tr>';
					}
						$BuyOrdersHTML = $BuyOrdersHTML . '<tr><td colspan="4"><small><span><small>Displaying only last: '.$i.'</small></span><span class="pull-right">* - [Self] '.$user['username'].'</span></small></td></tr>';
						$BuyOrdersHTML = $BuyOrdersHTML .	'</tbody></table>';
foreach($TotalSellOrders['result'] as $TSO){
	$SellAmount = $TSO['Amount'];
	$SellTotalAmount = $TSO['TotalAmount'];
}
$SellOrdersHTML = '<table class="table table-condensed table-bordered table-hover" style="font-size:12px "><thead><tr><th style="text-align:center " rowspan="2">#</th><th style="text-align:center " >Price</th><th style="text-align:center " >'.$FirstCurrency.'</th><th style="text-align:center " >'.$SecondCurrency.'</th></tr><tr><th style="text-align:center " >Total &raquo;</th><th style="text-align:right " >'.number_format($SellAmount,8).'</th><th style="text-align:right " >'.number_format($SellTotalAmount,8).'</th></tr></thead><tbody>';
					$ids = '';$i = 0;
					$SellOrderAmount = 0; $FillSellOrderAmount =0;
					foreach($SellOrders['result'] as $SO){
						if($i==20){break;}else{$i++;}
						if($user['_id']!=$BO['_id']['user_id']){
							$FillSellOrderAmount = $FillSellOrderAmount + round($SO['Amount'],8);
							$SellOrderAmount = $SellOrderAmount + round($SO['Amount'],8);							
							$TotalSellOrderPrice = $TotalSellOrderPrice + round($SO['Amount']*$SO['_id']['PerPrice'],8);
							$SellOrderPrice = round($TotalSellOrderPrice/$SellOrderAmount,8);
							$ids = $ids .','.(string)$SO['_id']['_id']->{'$id'}.'';
						}
						$SellOrdersHTML = $SellOrdersHTML .	'<tr onClick="SellOrderFill('.$SellOrderPrice.','.$SellOrderAmount.',\''.$ids.'\');" style="cursor:pointer;';
							if($user['_id']==$SO['_id']['user_id']){
								$SellOrdersHTML = $SellOrdersHTML .'background-color:#A5FC8F;"';
							}else{
								$SellOrdersHTML = $SellOrdersHTML .'"';
							}					
					 	$SellOrdersHTML = $SellOrdersHTML .'class=" tooltip-x" rel="tooltip-x" data-placement="top" title="Buy '.$SellOrderAmount.' '.$FirstCurrency.' at '.$SellOrderPrice.' '.$SecondCurrency.'">';
							$SellOrdersHTML = $SellOrdersHTML .'<td style="text-align:right">'.$SO['No'].'</td>';
							$SellOrdersHTML = $SellOrdersHTML .'<td style="text-align:right">'.number_format(round($SO['_id']['PerPrice'],8),8).'</td>';
							$SellOrdersHTML = $SellOrdersHTML .'<td style="text-align:right">'.number_format(round($SO['Amount'],8),8).'</td>';
							$SellOrdersHTML = $SellOrdersHTML .'<td style="text-align:right">'.number_format(round($SO['Amount']*$SO['_id']['PerPrice'],8),8).'</td>';
						$SellOrdersHTML = $SellOrdersHTML .'</tr>';
					}
					$SellOrdersHTML = $SellOrdersHTML . '<tr><td colspan="4"><small><span><small>Displaying only last: '.$i.'</small></span><span class="pull-right">* - [Self] '.$user['username'].'</span></small></td></tr>';

		$SellOrdersHTML = $SellOrdersHTML .	'			</tbody></table>'			;
		return $this->render(array('json' => array(
			'SellOrdersHTML'=> $SellOrdersHTML,
			'BuyOrdersHTML'=> $BuyOrdersHTML,
			'SellSpanTotal'=>count($SellOrders['result']),
			'BuySpanTotal'=>count($BuyOrders['result']),
		)));
	}

	public function YourOrders($FirstCurrency="BTC",$SecondCurrency="USD",$user_id = null){

		$YourOrders = Orders::find('all',array(
			'conditions'=>array(
				'user_id'=>$user_id,
				'Completed'=>'N',
				'FirstCurrency' => $FirstCurrency,
				'SecondCurrency' => $SecondCurrency,					

				),
			'order' => array('DateTime'=>-1)
		));

			$YourCompleteOrders = Orders::find('all',array(
			'conditions'=>array(
				'user_id'=>$user_id,
				'Completed'=>'Y',
				'FirstCurrency' => $FirstCurrency,
				'SecondCurrency' => $SecondCurrency,					
				),
			'order' => array('DateTime'=>-1)
		));

$YourOrdersHTML = '<table class="table table-condensed table-bordered table-hover" style="font-size:12px">
				<thead>
					<tr>
						<th style="text-align:center ">Exchange</th>
						<th style="text-align:center ">Price</th>
						<th style="text-align:center ">Amount</th>
					</tr>
				</thead>
				<tbody>';
				foreach($YourOrders as $YO){ 
$YourOrdersHTML = $YourOrdersHTML .'<tr style="background-color:';
if($YO['Action']=="Sell"){
	$YourOrdersHTML = $YourOrdersHTML .'#FF99FF';
}else{
	$YourOrdersHTML = $YourOrdersHTML .'#99FF99'; 
}
$YourOrdersHTML = $YourOrdersHTML .'" "class=" tooltip-x" rel="tooltip-x" data-placement="top" title="'.$YO["Action"].' '.number_format($YO["Amount"],3).' at '. number_format($YO["PerPrice"],8).' on '.gmdate('Y-m-d H:i:s',$YO['DateTime']->sec).'">';
$YourOrdersHTML = $YourOrdersHTML .'<td style="text-align:left "><a href="/ex/RemoveOrder/'.String::hash($YO['_id']).'/'.$YO['_id'].'/'.strtolower($FirstCurrency).'_'.strtolower($SecondCurrency).'" title="Remove this order">';
$YourOrdersHTML = $YourOrdersHTML .'<i class="fa fa-times fa-1x"></i></a> &nbsp; '.$YO['Action'].' '.$YO['FirstCurrency'].'/'.$YO['SecondCurrency'].'</td>';
$YourOrdersHTML = $YourOrdersHTML .'<td style="text-align:right ">'.number_format($YO['PerPrice'],8).'</td>';
$YourOrdersHTML = $YourOrdersHTML .'<td style="text-align:right ">'.number_format($YO['Amount'],8).'</td>';
$YourOrdersHTML = $YourOrdersHTML .'</tr>';
				 }					
$YourOrdersHTML = $YourOrdersHTML .'				</tbody>
			</table>';

		$YourCompleteOrdersHTML = '<table class="table table-condensed table-bordered table-hover" style="font-size:12px">
				<thead>
					<tr>
						<th style="text-align:center ">Exchange</th>
						<th style="text-align:center ">Price</th>
						<th style="text-align:center ">Amount</th>
					</tr>
				</thead>
				<tbody>';
				$i = 0;
				foreach($YourCompleteOrders as $YO){ 
				if($i==20){break;}else{$i++;}
		$YourCompleteOrdersHTML = 		$YourCompleteOrdersHTML .'<tr style="cursor:pointer;background-color:';
		if($YO['Action']=="Sell"){
			$YourCompleteOrdersHTML = 		$YourCompleteOrdersHTML .'#FF99FF';
		}else{
			$YourCompleteOrdersHTML = 		$YourCompleteOrdersHTML .'#99FF99';
		}
		$YourCompleteOrdersHTML = 		$YourCompleteOrdersHTML .'" class=" tooltip-x" rel="tooltip-x" data-placement="top" title="'.$YO['Action'].' '.number_format($YO['Amount'],3).' at '.number_format($YO['PerPrice'],8).' on '.gmdate('Y-m-d H:i:s',$YO['DateTime']->sec).'">
						<td style="text-align:left ">
						'.$YO['Action'].' '.$YO['FirstCurrency'].'/'.$YO['SecondCurrency'].'</td>
						<td style="text-align:right ">'.number_format($YO['PerPrice'],8).'</td>
						<td style="text-align:right ">'.number_format($YO['Amount'],8).'</td>
					</tr>';
			 }
			$YourCompleteOrdersHTML = 		$YourCompleteOrdersHTML .'<tr><td colspan="3"><small>Displaying only last: '.$i.'</small></td></tr>';
		$YourCompleteOrdersHTML = 		$YourCompleteOrdersHTML .'				</tbody>
			</table>';


		return $this->render(array('json' => array(
			'YourCompleteOrdersHTML'=> $YourCompleteOrdersHTML,
			'YourOrdersHTML'=> $YourOrdersHTML,			
		)));
	}

		public function TotalSellOrders($first_curr="BTC",$second_curr="USD"){
		$TotalSellOrders = Orders::connection()->connection->command(array(
			'aggregate' => 'orders',
			'pipeline' => array( 
				array( '$project' => array(
					'_id'=>0,
					'Action' => '$Action',
					'Amount'=>'$Amount',
					'Completed'=>'$Completed',					
					'FirstCurrency'=>'$FirstCurrency',
					'SecondCurrency'=>'$SecondCurrency',	
					'TotalAmount' => array('$multiply' => array('$Amount','$PerPrice')),
				)),
				array('$match'=>array(
					'Action'=>'Sell',
					'Completed'=>'N',					
					'FirstCurrency' => $first_curr,
					'SecondCurrency' => $second_curr,					
					)),
				array('$group' => array( '_id' => array(),
					'Amount' => array('$sum' => '$Amount'), 
					'TotalAmount' => array('$sum' => '$TotalAmount'), 
				)),
				array('$sort'=>array(
					'PerPrice'=>1,
				))
			)
		));
		return $TotalSellOrders;
	}
	public function AutoBTC($AutoBTC = null){
		$user = Session::read('member');
		$id = $user['_id'];
		if($id==""){
					return $this->render(array('json' => array(
				'Updated'=> 'No',
			)));
		}
		$data = array(
			"AutoBTC.address" => $AutoBTC,
			"AutoBTC.verified" => 'No'
		);
		$conditions = array(
			'user_id'=>$id
		);
		Details::update($data,$conditions);
			return $this->render(array('json' => array(
				'Updated'=> 'Yes',
				)));
	}
	
	public function AutoXGC($AutoXGC = null){
		$user = Session::read('member');
		$id = $user['_id'];
		if($id==""){
					return $this->render(array('json' => array(
				'Updated'=> 'No',
			)));
		}
		$data = array(
			"AutoXGC.address" => $AutoXGC,
			"AutoXGC.verified" => 'No'
		);
		$conditions = array(
			'user_id'=>$id
		);
		Details::update($data,$conditions);
			return $this->render(array('json' => array(
				'Updated'=> 'Yes',
				)));		
	}
	
		public function VerifyBTC($AutoBTC = null){
		$user = Session::read('member');
		$id = $user['_id'];
		if($id==""){
					return $this->render(array('json' => array(
				'Updated'=> 'No',
			)));
		}
		$bitcoin = new Bitcoin('http://'.BITCOIN_WALLET_SERVER.':'.BITCOIN_WALLET_PORT,BITCOIN_WALLET_USERNAME,BITCOIN_WALLET_PASSWORD);
			$verify = $bitcoin->validateaddress($AutoBTC);

			if($verify['isvalid']==true){
		$data = array(
			"AutoBTC.verified" => 'Yes'
		);
		$conditions = array(
			'user_id'=>$id
		);
		Details::update($data,$conditions);
				
				return $this->render(array('json' => array(
						'Updated'=> 'Yes',
				)));
			}else{
				return $this->render(array('json' => array(
				'Updated'=> 'No',
				)));
			}
	}
	
		public function VerifyXGC($AutoXGC = null){
		$user = Session::read('member');
		$id = $user['_id'];
		if($id==""){
					return $this->render(array('json' => array(
				'Updated'=> 'No',
			)));
		}
		$greencoin = new Greencoin('http://'.GREENCOIN_WALLET_SERVER.':'.GREENCOIN_WALLET_PORT,GREENCOIN_WALLET_USERNAME,GREENCOIN_WALLET_PASSWORD);
			$verify = $greencoin->validateaddress($AutoXGC);
//			print_r($verify);
			if($verify['isvalid']==true){
		$data = array(
			"AutoXGC.verified" => 'Yes'
		);
		$conditions = array(
			'user_id'=>$id
		);
		Details::update($data,$conditions);
				
				return $this->render(array('json' => array(
						'Updated'=> 'Yes',
				)));
			}else{
				return $this->render(array('json' => array(
				'Updated'=> 'No',
				)));
			}
	}
}
?>