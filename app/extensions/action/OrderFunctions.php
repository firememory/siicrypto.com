<?php
namespace app\extensions\action;

use app\models\Users;
use app\models\Details;
use app\models\Orders;
use lithium\data\Connections;
use MongoDB;

class OrderFunctions extends \lithium\action\Controller {
	public function index(){
		$TotalSellOrders = Orders::connection()->command(array());
		return true;
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
				array('$group' => array('_id'=>array('_id'=>'$_id',),
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
		public function FillTotalSellOrders($first_curr="BTC",$second_curr="USD"){
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
				array('$group' => array('_id'=>array('_id'=>'$_id',),
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

	public function TotalBuyOrders($first_curr="BTC",$second_curr="USD"){
		$TotalBuyOrders = Orders::connection()->connection->command(array(
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
					'Action'=>'Buy',
					'Completed'=>'N',										
					'FirstCurrency' => $first_curr,
					'SecondCurrency' => $second_curr,					
					)),
				array('$group' => array('_id'=>array('_id'=>'$_id',),
					'Amount' => array('$sum' => '$Amount'),  
					'TotalAmount' => array('$sum' => '$TotalAmount'), 					
				)),
				array('$sort'=>array(
					'PerPrice'=>1,
				))
			)
		));
		return $TotalBuyOrders;
	}
	
	public function SellOrders($first_curr="BTC",$second_curr="USD"){
		$SellOrders = Orders::connection()->connection->command(array(
		'aggregate' => 'orders',
			'pipeline' => array( 
				array( '$project' => array(
					'_id'=>0,
					'Action' => '$Action',
					'Amount'=>'$Amount',
					'user_id' => '$user_id',
					'username' => '$username',
					'_id' => '$_id',
					'PerPrice'=>'$PerPrice',
					'Completed'=>'$Completed',
					'FirstCurrency'=>'$FirstCurrency',
					'SecondCurrency'=>'$SecondCurrency',					
				)),
				array('$match'=>array(
					'Action'=>'Sell',
					'Completed'=>'N',										
					'FirstCurrency' => $first_curr,
					'SecondCurrency' => $second_curr,					
					)),
				array('$group' => array( '_id' => array(
						'PerPrice'=>'$PerPrice',
						'username'=>'$username',												
						'user_id' => '$user_id',
						'_id'=>'$_id',
						),
					'Amount' => array('$sum' => '$Amount'),  
					'No' => array('$sum'=>1),
				)),
				array('$sort'=>array(
					'_id.PerPrice'=>1,
				)),
			)
		));
		return $SellOrders;
	}
	
	public function BuyOrders($first_curr="BTC",$second_curr="USD"){
		$BuyOrders = Orders::connection()->connection->command(array(
			'aggregate' => 'orders',
			'pipeline' => array( 
				array( '$project' => array(
					'_id'=>0,
					'Action' => '$Action',
					'user_id' => '$user_id',					
					'username' => '$username',
					'_id' => '$_id',
					'Amount'=>'$Amount',
					'PerPrice'=>'$PerPrice',
					'Completed'=>'$Completed',
					'FirstCurrency'=>'$FirstCurrency',
					'SecondCurrency'=>'$SecondCurrency',					
				)),
				array('$match'=>array(
					'Action'=>'Buy',
					'Completed'=>'N',
					'FirstCurrency' => $first_curr,
					'SecondCurrency' => $second_curr,					
					)),
				array('$group' => array( '_id' => array(
						'PerPrice'=>'$PerPrice',
						'username'=>'$username',												
						'user_id' => '$user_id',
						'_id'=>'$_id',
						),
					'Amount' => array('$sum' => '$Amount'),  
					'No' => array('$sum'=>1),

				)),
				array('$sort'=>array(
					'_id.PerPrice'=>-1,
				))
			)
		));
//print_r($BuyOrders)	;
		return $BuyOrders;
		
	}
		public function ExYourOrders($first_curr="BTC",$second_curr="USD",$id){
			$YourOrders = Orders::find('all',array(
			'conditions'=>array(
				'user_id'=>$id,
				'Completed'=>'N',
				'FirstCurrency' => $first_curr,
				'SecondCurrency' => $second_curr,					

				),
			'order' => array('DateTime'=>-1)
		));
		return $YourOrders;
		}
		public function ExYourCompleteOrders($first_curr="BTC",$second_curr="USD",$id){
		$YourCompleteOrders = Orders::find('all',array(
			'conditions'=>array(
				'user_id'=>$id,
				'Completed'=>'Y',
				'FirstCurrency' => $first_curr,
				'SecondCurrency' => $second_curr,					
				),
			'order' => array('DateTime'=>-1)
		));
		return $YourCompleteOrders;
		}
}
?>