<?php use lithium\core\Environment; 
if(substr(Environment::get('locale'),0,2)=="en"){$locale = "en";}else{$locale = Environment::get('locale');}
//if(strlen($locale>2)){$locale='en';}
// print_r(Environment::get('locale'));
// print_r($locale);
?>
<?php
use lithium\util\String;
use app\models\Trades;
use app\models\Details;

$virtuals = array('BTC');
$virtualcurrencies = Trades::find('all',array(
	'conditions'=>array('SecondType'=>'Virtual')
));
foreach($virtualcurrencies as $VC){
	array_push($virtuals,substr($VC['trade'],4,3));
}
$GLOBALS['cannotRegister'] = "true";  // temporary to disable going to funding page for all users
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><?=$t('Dashboard')?>: <?=$user['firstname']?> <?=$user['lastname']?></h3>
  </div>
  <div class="panel-body">
<table class="table table-condensed table-bordered table-hover">
			<thead>
				<tr>
				<td colspan=7><div class="alert alert-success">
				<?php 
				$k=0;$i = count($details['incoming']['BTC'])-1;
				for($j=$i;$j>=0;$j--){
					if($details['incoming']['BTC'][$j]['Confirmations'] == null){
						if($details['incoming']['BTC'][$j]['Confirmations'] == 0){
									$url = "http://blockchain.info/tx/".$details['incoming']['BTC'][$j]['tx']."?format=json";
									$json = file_get_contents($url, false, $context);
									$jdec = json_decode($json);
									$confirmations = 0;
									if($jdec->block_height>0){
										$confirmations = $jdec->block_height;
										foreach($jdec->out as $k => $v){
//											print_r($v->addr );
//											print_r($details['incoming']['BTC'][$j]['Address']);
											if($v->addr==$details['incoming']['BTC'][$j]['Address']){
												$data = array(
													'incoming.BTC.'.$j.'.Confirmations' => $confirmations,
													'balance.BTC' => $details['balance']['BTC'] + (float)round($v->value/100000000,8),
													'incoming.BTC.'.$j.'.Confirmed' => 'Yes'
												);
												$conditions = array(
													'username' => $user['username'],
													'user_id' => $user['_id']
												);
//												print_r($conditions);
												$saved = Details::update($data,$conditions);
//												print_r($data);
//												print_r($saved);
											}
										}
									}
							print_r("Incoming BTC transaction to:<br>");
							print_r($details['incoming']['BTC'][$j]['Address']);
						}
					}
				}
				?>
				
				<?php 
				$k=0;$i = count($details['incoming']['XGC'])-1;
				for($j=$i;$j>=0;$j--){
					if($details['incoming']['XGC'][$j]['Confirmations'] == null){
						if($details['incoming']['XGC'][$j]['Confirmations'] == 0){
									$url = "http://blockchain.xgcwallet.org:3001/api/getrawtransaction?txid=".$details['incoming']['XGC'][$j]['tx']."&decrypt=1";
									$json = file_get_contents($url, false, $context);
									$jdec = json_decode($json);
									$confirmations = 0;
									if($jdec->confirmations>0){
										$confirmations = $jdec->confirmations;
										foreach($jdec->vout as $k => $v){
//											print_r($v->scriptPubKey->addresses );
//											print_r($details['incoming']['XGC'][$j]['Address']);
											if($v->scriptPubKey->addresses[0]==$details['incoming']['XGC'][$j]['Address']){
												$data = array(
													'incoming.XGC.'.$j.'.Confirmations' => $confirmations,
													'balance.XGC' => $details['balance']['XGC'] + (float)$v->value,
													'incoming.XGC.'.$j.'.Confirmed' => 'Yes'
												);
												$conditions = array(
													'username' => $user['username'],
													'user_id' => $user['_id']
												);
//												print_r($conditions);
												$saved = Details::update($data,$conditions);
//												print_r($data);
//												print_r($saved);
											}
										}
									}
							print_r("Incoming XGC transaction to:<br>");
							print_r($details['incoming']['XGC'][$j]['Address']);
						}
					}
				}
				?>
				</div>
				</td>
				</tr>
			
				<tr>
					<th  class="headTable"><?=$t('Currency')?> <br><small></small></th>
					<?php 
					$currencies = array();
					$VirtualCurr = array(); $FiatCurr = array();
					$trades = Trades::find('all');					
					foreach($trades as $tr){
						$currency = substr($tr['trade'],0,3);
						array_push($currencies,$currency);
							if($tr['FirstType']=='Virtual'){
								array_push($VirtualCurr,$currency);
								}else{
								array_push($VirtualCurr,$currency);
							}
						$currency = substr($tr['trade'],4,3);
						array_push($currencies,$currency);
							if($tr['SecondType']=='Virtual'){
								array_push($VirtualCurr,$currency);
								}else{
								array_push($FiatCurr,$currency);
							}
					 }	//for
						$currencies = array_unique($currencies);
						$VirtualCurr = array_unique($VirtualCurr);
						$FiatCurr = array_unique($FiatCurr);
					
					foreach($VirtualCurr as $currency){?>
					<th class="headTable" style="text-align:center">
					<?php if($GLOBALS['cannotRegister']=="false"){?>
					<a href="/<?=$locale?>/users/funding/<?=$currency?>" class="btn btn-success btn-block">
					<?php }else{?>				
					<a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal">
					<?php }?>			
<!--					<i class="fa fa-arrow-left"></i> -->
					<?=$currency?>
<!--					<i class="fa fa-arrow-right"></i> -->
					</a>
					</th>
					<?php }
					foreach($FiatCurr as $currency){?>
					<th class="headTable" style="text-align:center">
					<?php if($GLOBALS['cannotRegister']=="false"){?>
					<a href="/<?=$locale?>/users/funding_fiat/<?=$currency?>" class="btn btn-primary btn-block">
					<?php }else{?>				
					<a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal">
					<?php }?>			
<!--					<i class="fa fa-arrow-left"></i> -->
					<?=$currency?>
<!--					<i class="fa fa-arrow-right"></i> -->
					</a>
					</th>
					<?php }?>					
				</tr>
				<tr>
					<th colspan="7" style="text-align:center">(<?=$t('Click on a currency to Deposit or Withdraw')?>)</th>
				</tr>
			</thead>
<?php 
if(count($YourOrders['Buy']['result'])>0){
	foreach($YourOrders['Buy']['result'] as $YO){
		$Buy[$YO['_id']['FirstCurrency']] = $Buy[$YO['_id']['FirstCurrency']] + $YO['Amount'];
		$BuyWith[$YO['_id']['SecondCurrency']] = $BuyWith[$YO['_id']['SecondCurrency']] + $YO['TotalAmount'];					
	}
}
if(count($YourOrders['Sell']['result'])>0){
	foreach($YourOrders['Sell']['result'] as $YO){
		$Sell[$YO['_id']['FirstCurrency']] = $Sell[$YO['_id']['FirstCurrency']] + $YO['Amount'];
		$SellWith[$YO['_id']['SecondCurrency']] = $SellWith[$YO['_id']['SecondCurrency']] + $YO['TotalAmount'];					
	}
}
if(count($YourCompleteOrders['Buy']['result'])>0){
	foreach($YourCompleteOrders['Buy']['result'] as $YCO){
		$ComBuy[$YCO['_id']['FirstCurrency']] = $ComBuy[$YCO['_id']['FirstCurrency']] + $YCO['Amount'];
		$ComBuyWith[$YCO['_id']['SecondCurrency']] = $ComBuyWith[$YCO['_id']['SecondCurrency']] + $YCO['TotalAmount'];					
	}
}
if(count($YourCompleteOrders['Sell']['result'])>0){
	foreach($YourCompleteOrders['Sell']['result'] as $YCO){
		$ComSell[$YCO['_id']['FirstCurrency']] = $ComSell[$YCO['_id']['FirstCurrency']] + $YCO['Amount'];
		$ComSellWith[$YCO['_id']['SecondCurrency']] = $ComSellWith[$YCO['_id']['SecondCurrency']] + $YCO['TotalAmount'];					
	}
}
?>			
<?php
foreach($Commissions['result'] as $C){
	foreach($currencies as $currency){
		if($C['_id']['CommissionCurrency']==$currency){
			$variablename = $currency."Comm";
			$$variablename = $C['Commission'];		
		}
	}
}
foreach($CompletedCommissions['result'] as $C){
	foreach($currencies as $currency){
		if($C['_id']['CommissionCurrency']==$currency){
			$variablename = "Completed".$currency."Comm";
			$$variablename = $C['Commission'];		
		}
	}
}
?>
			<tbody>
				<tr>
					<td class="rightTable"><strong><?=$t('Opening Balance')?></strong></td>
					<?php foreach($currencies as $currency){
							if(in_array($currency,$virtuals)){
					?>
					<td style="text-align:right"><?=number_format($details['balance.'.$currency]+$Sell[$currency],8)?></td>					
					<?php }else{?>
					<td style="text-align:right"><?=number_format($details['balance.'.$currency]+$Sell[$currency],4)?></td>										
					<?php }}?>					
				</tr>
				<tr>
					<td class="rightTable"><strong><?=$t('Current Balance')?></strong><br>
					(<?=$t('including pending orders')?>)</td>
					<?php foreach($currencies as $currency){
						if(in_array($currency,$virtuals)){
					?>
						<td style="text-align:right "><?=number_format($details['balance.'.$currency],8)?></td>
					<?php }else{?>
						<td style="text-align:right "><?=number_format($details['balance.'.$currency],4)?></td>					
					<?php }}?>					
				</tr>
				<tr>
					<td class="rightTable"><strong><?=$t('Pending Buy Orders')?></strong></td>
					<?php foreach($currencies as $currency){
						if(in_array($currency,$virtuals)){
						?>
					<td style="text-align:right ">+<?=number_format($Buy[$currency],8)?></td>
					<?php }else{?>
					<td style="text-align:right ">-<?=number_format($BuyWith[$currency],4)?></td>										
					<?php }
					}?>					
				</tr>
				<tr>
					<td class="rightTable"> <strong><?=$t('Pending Sell Orders')?></strong></td>
					<?php foreach($currencies as $currency){
						if(in_array($currency,$virtuals)){
						?>
					<td style="text-align:right ">-<?=number_format($Sell[$currency],8)?></td>
					<?php }else{?>
					<td style="text-align:right ">+<?=number_format($SellWith[$currency],4)?></td>										
					<?php }
					}?>					
				</tr>
				<tr>
					<td class="rightTable"><strong><?=$t('After Execution')?></strong></td>
					<?php foreach($currencies as $currency){
						$variablename = $currency."Comm";
						if(in_array($currency,$virtuals)){
						?>
					<td style="text-align:right "><?=number_format($details['balance.'.$currency]+$Buy[$currency]-$$variablename,8)?></td>
					<?php }else{?>
					<td style="text-align:right "><?=number_format($details['balance.'.$currency]+$SellWith[$currency]-$$variablename,4)?></td>					
					<?php }
					}?>					
				</tr>
				<tr >
					<td class="rightTable"><strong><?=$t('Commissions')?></strong></td>
					<?php foreach($currencies as $currency){
						$variablename = $currency."Comm";
						if(in_array($currency,$virtuals)){
						?>
					<td style="text-align:right "><?=number_format($$variablename,8)?></td>
					<?php }else{?>
					<td style="text-align:right "><?=number_format($$variablename,4)?></td>					
					<?php }}?>					
				</tr>
				<tr>
					<td class="rightTable"><strong><?=$t('Complete Buy Orders')?></strong></td>
					<?php foreach($currencies as $currency){
						if(in_array($currency,$virtuals)){
						?>
					<td style="text-align:right "><?=number_format($ComBuy[$currency],8)?></td>
					<?php }else{?>
					<td style="text-align:right "><?=number_format($ComBuyWith[$currency],4)?></td>										
					<?php }
					}?>					
				</tr>
				<tr>
					<td class="rightTable"><strong><?=$t('Complete Sell Orders')?></strong></td>
					<?php foreach($currencies as $currency){
						if(in_array($currency,$virtuals)){
						?>
					<td style="text-align:right "><?=number_format($ComSell[$currency],8)?></td>
					<?php }else{?>
					<td style="text-align:right "><?=number_format($ComSellWith[$currency],4)?></td>										
					<?php }
					}?>					
				</tr>
				<tr>
					<td class="rightTable"><strong><?=$t('Completed Order Commissions')?></strong></td>
					<?php foreach($currencies as $currency){
							$variablename = "Completed".$currency."Comm";
							if(in_array($currency,$virtuals)){
						?>
					<td style="text-align:right "><?=number_format($$variablename,8)?></td>
					<?php }else{?>					
					<td style="text-align:right "><?=number_format($$variablename,4)?></td>					
					<?php }}?>										
				</tr>
			</tbody>
		</table>
<!--		<h3 class="panel-title">Users: <?=$UsersRegistered?> / Online: <?=$OnlineUsers?></h3> -->
		<table class="table table-condensed table-bordered table-hover">
				<tr>
					<th><?=$t('Status')?></th>
					<th></th>
					<th><?=$t('Amount')?></th>					
					<th><?=$t('Avg Price')?></th>										
				</tr>
				<tr>
					<th colspan="4"><?=$t('Pending orders')?></th>
				</tr>
				<?php 
				if(count($TotalOrders['Buy']['result'])>0){
					foreach ($TotalOrders['Buy']['result'] as $r){ ?>
					<tr>
						<th><a href="/<?=$locale?>/ex/x/<?=$r['_id']['FirstCurrency']?>_<?=$r['_id']['SecondCurrency']?>"><?=$r['_id']['Action']?> <?=$r['_id']['FirstCurrency']?> <?=$t('with')?> <?=$r['_id']['SecondCurrency']?></a></th>
						<td style="text-align:right "><?=number_format($r['Amount'],8)?></td>
						<td style="text-align:right "><?=number_format($r['TotalAmount'],8)?></td>						
						<td style="text-align:right "><?=number_format($r['TotalAmount']/$r['Amount'],8)?></td>												
					</tr>
				<?php }
				}?>
				<?php 
				if(count($TotalOrders['Sell']['result'])>0){
					foreach ($TotalOrders['Sell']['result'] as $r){ ?>
					<tr>
						<th><a href="/<?=$locale?>/ex/x/<?=$r['_id']['FirstCurrency']?>_<?=$r['_id']['SecondCurrency']?>"><?=$r['_id']['Action']?> <?=$r['_id']['FirstCurrency']?> <?=$t('with')?> <?=$r['_id']['SecondCurrency']?></a></th>
						<td style="text-align:right "><?=number_format($r['Amount'],8)?></td>
						<td style="text-align:right "><?=number_format($r['TotalAmount'],8)?></td>						
						<td style="text-align:right "><?=number_format($r['TotalAmount']/$r['Amount'],8)?></td>																		
					</tr>
				<?php }
				}?>
				<tr>
					<th colspan="4"><?=$t('Completed orders')?></th>
				</tr>
				<?php 
				if(count($TotalCompleteOrders['Buy']['result'])>0){
					foreach ($TotalCompleteOrders['Buy']['result'] as $r){ ?>
					<tr>
						<th><a href="/<?=$locale?>/ex/x/<?=$r['_id']['FirstCurrency']?>_<?=$r['_id']['SecondCurrency']?>"><?=$r['_id']['Action']?> <?=$r['_id']['FirstCurrency']?> <?=$t('with')?> <?=$r['_id']['SecondCurrency']?></a></th>
						<th style="text-align:right "><?=number_format($r['Amount'],8)?></th>
						<th style="text-align:right "><?=number_format($r['TotalAmount'],8)?></th>						
						<td style="text-align:right "><?=number_format($r['TotalAmount']/$r['Amount'],8)?></td>																		
					</tr>
				<?php }
				}?>
				<?php 
				if(count($TotalCompleteOrders['Sell']['result'])>0){
				foreach ($TotalCompleteOrders['Sell']['result'] as $r){ ?>
					<tr>
						<th><a href="/<?=$locale?>/ex/x/<?=$r['_id']['FirstCurrency']?>_<?=$r['_id']['SecondCurrency']?>"><?=$r['_id']['Action']?> <?=$r['_id']['FirstCurrency']?> <?=$t('with')?> <?=$r['_id']['SecondCurrency']?></a></th>
						<th style="text-align:right "><?=number_format($r['Amount'],8)?></th>
						<th style="text-align:right "><?=number_format($r['TotalAmount'],8)?></th>						
						<td style="text-align:right "><?=number_format($r['TotalAmount']/$r['Amount'],8)?></td>																		
					</tr>
				<?php }
				}?>
		</table>
					</div>
				</div>
			</div>		
		<!--Summary-->
		<!-- final summary-->
  </div>
</div>
