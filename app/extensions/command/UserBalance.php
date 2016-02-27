<?php
namespace app\extensions\command;

use app\models\Trades;
use app\models\Details;
use app\models\Orders;
use app\models\Balances;
use app\models\Parameters;
use MongoDate;

class Userbalance extends \lithium\console\Command {
	public function index() {
		$StartDate = new MongoDate(strtotime(gmdate('Y-m-d H:i:s',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-60*60*24)));
		$EndDate = new MongoDate(strtotime(gmdate('Y-m-d H:i:s',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))+60*60*24)));
		
		print_r(gmdate('Y-m-d H:i:s',$StartDate->sec));
		print_r('------');
		print_r(gmdate('Y-m-d H:i:s',$EndDate->sec));
		$orders = Orders::find('all',array(
			'conditions'=>array( 
			'DateTime'=> array( '$gte' => $StartDate, '$lte' => $EndDate ) ,
			'Completed'=>'Y'
			)
		));
		$users = array();
		foreach($orders as $order){
			array_push($users,$order['username']);
		}
		print_r($users);
		$users = array_unique($users);
		print_r($users);
		$details = Details::find('all',array(
			'conditions'=>array('username'=>array('$in'=>array_values($users)))
		));
		
		foreach($details as $detail){
			
			$data = array(
				'DateTime'=>new MongoDate,
				'username'=>$detail['username'],
				'balance'=>$detail['balance'],
			);
				
				$Balances = Balances::create($data);
				$saved = $Balances->save();

		}
		
	}
}

?>