<?php
use app\models\Parameters;
use app\models\Pages;
use app\models\Orders;
use app\models\Trades;
use lithium\core\Environment; 
use lithium\data\Connections;
$Comm = Parameters::find('first');
$howmany = 100;

$tradesV = Trades::find('first',array(
	'conditions'=>array('SecondType'=>'Virtual'),
	'limit'=>$howmany,'order'=>array('order'=>1)
));
$first_currency = substr($tradesV['trade'],0,3);		
$second_currency = substr($tradesV['trade'],4,3);		

$tradesVF = Trades::find('all',array(
	'conditions'=>array(
		'SecondType'=>'Fiat',
	),
	'limit'=>$howmany,'order'=>array('order'=>-1)
));

$trades = Trades::find('all',array('limit'=>$howmany,'order'=>array('order'=>1)));

		$mongodb = Connections::get('default')->connection;
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
					)),
				array('$group' => array( '_id' => array(
							'FirstCurrency'=>'$FirstCurrency',
							'SecondCurrency'=>'$SecondCurrency',	
							'year'=>array('$year' => '$TransactDateTime'),
							'month'=>array('$month' => '$TransactDateTime'),						
//							'day'=>array('$dayOfMonth' => '$TransactDateTime'),												
//							'hour'=>array('$hour' => '$TransactDateTime'),
						),
					'min' => array('$min' => '$PerPrice'), 
					'avg' => array('$avg' => '$PerPrice'), 					
					'max' => array('$max' => '$PerPrice'), 
					'last' => array('$last' => '$PerPrice'), 					
				)),
				array('$sort'=>array(
					'_id.year'=>-1,
					'_id.month'=>-1,
					'_id.day'=>-1,					
					'_id.hour'=>-1,					
				)),
				array('$limit'=>count($trades))
			)
		));


?>
<div class="main">
		<div class="row placeholders">
		<?php foreach($tradesVF as $tradeVF){
					if(substr($tradeVF['trade'],0,3)==$second_currency){
			?>
				<div class="col-xs-3 col-sm-3  placeholder">
						<a href="/ex/x/<?=strtolower(str_replace("/","_",$tradeVF['trade']))?>"><img src="/img/<?=strtolower(str_replace("/","_",$tradeVF['trade']))?>.png" class="img-responsive" alt="Generic placeholder thumbnail">
						<h4><?=$tradeVF['trade']?></h4>
						<small><?php
								foreach($Rates['result'] as $rate){
									if($rate['_id']['FirstCurrency']."/".$rate['_id']['SecondCurrency']==$tradeVF['trade']){
						?>Min: <?=number_format($rate['min'],4)?><br> Max: <?=number_format($rate['max'],4)?><br> Last: <?=number_format($rate['last'],4)?><?php
									}
								}
						?>
						</small>
						</a>
				</div>
					<?php }}?>
		</div>
		<div class="row placeholders">
				<div class="col-xs-6 col-sm-12  placeholder">
				</div>
				<div class="col-xs-6 col-sm-12  placeholder">
						<a href="/ex/x/<?=strtolower(str_replace("/","_",$tradesV['trade']))?>"><img src="/img/<?=strtolower(str_replace("/","_",$tradesV['trade']))?>.png" class="img-responsive" alt="Generic placeholder thumbnail">
						<h4><?=$tradesV['trade']?></h4>
						<small>
						<?php
								foreach($Rates['result'] as $rate){
		//							print_r($rate);
									if($rate['_id']['FirstCurrency']."/".$rate['_id']['SecondCurrency']==$tradesV['trade']){
						?>Min: <?=number_format($rate['min'],4)?><br> Max: <?=number_format($rate['max'],4)?><br> Last: <?=number_format($rate['last'],4)?><?php
									}
								}
						?>
						</small>
						</a>
				</div>
				<div class="col-xs-6 col-sm-12  placeholder">
				</div>
		</div>
		<div class="row placeholders">
		<?php foreach($tradesVF as $tradeVF){
					if(substr($tradeVF['trade'],0,3)==$first_currency){
			?>
				<div class="col-xs-4 col-sm-4  placeholder">
						<a href="/ex/x/<?=strtolower(str_replace("/","_",$tradeVF['trade']))?>"><img src="/img/<?=strtolower(str_replace("/","_",$tradeVF['trade']))?>.png" class="img-responsive" alt="Generic placeholder thumbnail">
						<h4><?=$tradeVF['trade']?></h4>
						<small>
						<?php
								foreach($Rates['result'] as $rate){
									if($rate['_id']['FirstCurrency']."/".$rate['_id']['SecondCurrency']==$tradeVF['trade']){
						?>Min: <?=number_format($rate['min'],4)?><br> Max: <?=number_format($rate['max'],4)?><br> Last: <?=number_format($rate['last'],4)?><?php
									}
								}
						?>
						</small>
					</a>
				</div>
					<?php }}?>
		</div>
	</div>
	<div class="main">
		<h2 style="text-align:center;margin-top:-10px"><p> THE SAFE AND SECURE CRYPTO CURRENCY EXCHANGE  WITH</p><p> <span style="color:green"> NO COMMISSION CHARGES</span></p>

<p>BUY/SELL <span style="color:green">GREENCOINX</span> FOR EURO, STERLING, US DOLLAR, CANADIAN DOLLAR OR BITCOIN</p>
		
		</h2>
		
		<p style="text-align:center;font-size:18px"><strong>SiiCrypto facilitates trading in GreenCoinX the world’s first crypto currency that requires user identification</strong></p>
</div>
<div class="col-xs-12 col-sm-4">
		<!-- <a class="twitter-timeline"  href="https://twitter.com/SIICrypto"  data-widget-id="aaaaaaaaaaaaaaaaaaaa">Tweets by @SIICrypto</a> -->
</div>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>