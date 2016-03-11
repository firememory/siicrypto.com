<?php
use lithium\util\String;
use app\models\Trades;
$virtuals = array('BTC');
$virtualcurrencies = Trades::find('all',array(
	'conditions'=>array('SecondType'=>'Virtual')
));
foreach($virtualcurrencies as $VC){
	array_push($virtuals,substr($VC['trade'],4,3));
}

?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Dashboard: <?=$user['firstname']?> <?=$user['lastname']?></h3>
  </div>
  <div class="panel-body">
<table class="table table-condensed table-bordered table-hover">
			<thead>
				<tr>
					<th  class="headTable">Currency <br><small>Click to Fund account</small></th>
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
					<a href="/users/funding/<?=$currency?>" class="btn btn-success">
					<?=$currency?>
					</a>
					</th>
					<?php }
					foreach($FiatCurr as $currency){?>
					<th class="headTable" style="text-align:center">
					<a href="/users/funding_fiat/<?=$currency?>" class="btn btn-primary">
					<?=$currency?>
					</a>
					</th>
					<?php }?>					
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
					<td class="rightTable"><strong>Opening Balance</strong></td>
					<?php foreach($currencies as $currency){
							if(in_array($currency,$virtuals)){
					?>
					<td style="text-align:right"><?=number_format($details['balance.'.$currency]+$Sell[$currency],8)?></td>					
					<?php }else{?>
					<td style="text-align:right"><?=number_format($details['balance.'.$currency]+$Sell[$currency],4)?></td>										
					<?php }}?>					
				</tr>
				<tr>
					<td class="rightTable"><strong>Current Balance</strong><br>
					(including pending orders)</td>
					<?php foreach($currencies as $currency){
						if(in_array($currency,$virtuals)){
					?>
						<td style="text-align:right "><?=number_format($details['balance.'.$currency],8)?></td>
					<?php }else{?>
						<td style="text-align:right "><?=number_format($details['balance.'.$currency],4)?></td>					
					<?php }}?>					
				</tr>
				<tr>
					<td class="rightTable"><strong>Pending Buy Orders</strong></td>
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
					<td class="rightTable"> <strong>Pending Sell Orders</strong></td>
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
					<td class="rightTable"><strong>After Execution</strong></td>
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
					<td class="rightTable"><strong>Commissions</strong></td>
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
					<td class="rightTable"><strong>Complete Buy Orders</strong></td>
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
					<td class="rightTable"><strong>Complete Sell Orders</strong></td>
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
					<td class="rightTable"><strong>Completed Order Commissions</strong></td>
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
					<th>Status</th>
					<th></th>
					<th>Amount</th>					
					<th>Avg Price</th>										
				</tr>
				<tr>
					<th colspan="4">Pending orders</th>
				</tr>
				<?php 
				if(count($TotalOrders['Buy']['result'])>0){
					foreach ($TotalOrders['Buy']['result'] as $r){ ?>
					<tr>
						<th><a href="/ex/x/<?=$r['_id']['FirstCurrency']?>_<?=$r['_id']['SecondCurrency']?>"><?=$r['_id']['Action']?> <?=$r['_id']['FirstCurrency']?> with <?=$r['_id']['SecondCurrency']?></a></th>
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
						<th><a href="/ex/x/<?=$r['_id']['FirstCurrency']?>_<?=$r['_id']['SecondCurrency']?>"><?=$r['_id']['Action']?> <?=$r['_id']['FirstCurrency']?> with <?=$r['_id']['SecondCurrency']?></a></th>
						<td style="text-align:right "><?=number_format($r['Amount'],8)?></td>
						<td style="text-align:right "><?=number_format($r['TotalAmount'],8)?></td>						
						<td style="text-align:right "><?=number_format($r['TotalAmount']/$r['Amount'],8)?></td>																		
					</tr>
				<?php }
				}?>
				<tr>
					<th colspan="4">Completed orders</th>
				</tr>
				<?php 
				if(count($TotalCompleteOrders['Buy']['result'])>0){
					foreach ($TotalCompleteOrders['Buy']['result'] as $r){ ?>
					<tr>
						<th><a href="/ex/x/<?=$r['_id']['FirstCurrency']?>_<?=$r['_id']['SecondCurrency']?>"><?=$r['_id']['Action']?> <?=$r['_id']['FirstCurrency']?> with <?=$r['_id']['SecondCurrency']?></a></th>
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
						<th><a href="/ex/x/<?=$r['_id']['FirstCurrency']?>_<?=$r['_id']['SecondCurrency']?>"><?=$r['_id']['Action']?> <?=$r['_id']['FirstCurrency']?> with <?=$r['_id']['SecondCurrency']?></a></th>
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
