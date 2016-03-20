<?php 
namespace app\extensions\command;

use app\models\Notifies;

use app\extensions\action\Greencoin;

class WNotify extends \lithium\console\Command {
 public function index($s=null) {

				
							$t = Notifies::create();
							$data = array(
								'DateTime' => new \MongoDate(),
								'TransactionHash' => $s,
							);							
							$t->save($data);

				
				}
			}
		}
} 
?>