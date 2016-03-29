<?php
namespace app\extensions\command;

use app\models\CountriesDB;

class Countries extends \lithium\console\Command {
	public function run() {
		print_r("a");
		$country = CountriesDB::find('first',array(
			'ISO'=>'US'
		));
		var_dump($country['ISO']);
		print_r("a");
	}
}

?>