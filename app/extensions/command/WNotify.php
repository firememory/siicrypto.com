<?php 
namespace app\extensions\command;

use app\models\Notifies;

use app\extensions\action\Greencoin;

class WNotify extends \lithium\console\Command {
 public function index($s=null) {
		$transaction = Notifies::find("first",array(
			'conditions'=>array(
				'TransactionHash' => $s
			)
		));

		if(count($transaction)==0){
			$t = Notifies::create();
			$data = array(
				'DateTime' => new \MongoDate(),
				'TransactionHash' => $s,
			);							
			$t->save($data);
		}
	}
} 
?>