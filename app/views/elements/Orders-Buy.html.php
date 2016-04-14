<?php
use lithium\storage\Session;
$user = Session::read('member');
?>
	<div class="col-md-6">
		<div class="panel panel-success">
			<div class="panel panel-heading">
			<h2 class="panel-title"  style="font-weight:bold" href="#"><?=$t('All Orders')?>:
			 <?=$t('Buy')?> <?=$first_curr?> &lt; <?=$second_curr?>  <span class="pull-right" id="BuySpanTotal"><?=$t('Total')?>: <?=count($BuyOrders['result'])?></span></h2>
<?php  foreach($TotalBuyOrders['result'] as $TBO){
	$BuyAmount = $TBO['Amount'];
	$BuyTotalAmount = $TBO['TotalAmount'];
}

?>			
			</div>
		<div id="BuyOrders" style="overflow:auto;margin-top:-20px  ">			
			<table class="table table-condensed table-bordered table-hover"  style="font-size:12px ">
				<thead>
					<tr>
					<th style="text-align:center " rowspan="2">#</th>										
					<th style="text-align:center "><?=$t('Price')?></th>
					<th style="text-align:center "><?=$first_curr?></th>
					<th style="text-align:center "><?=$second_curr?></th>					
					</tr>
					<tr>
					<th style="text-align:center " ><?=$t('Total')?> &raquo;</th>
					<th style="text-align:right " ><?=number_format($BuyAmount,8)?></th>
					<th style="text-align:right " ><?=number_format($BuyTotalAmount,8)?></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$BuyOrderAmount = 0;$FillBuyOrderAmount = 0;
					$ids = '1';
					$i = 0;
					foreach($BuyOrders['result'] as $BO){
						if($i==20){break;}else{$i++;}
						if($user['_id']!=$BO['_id']['user_id']){
							$FillBuyOrderAmount = $FillBuyOrderAmount + round($BO['Amount'],8);
							$BuyOrderAmount = $BuyOrderAmount + round($BO['Amount'],8);													
							$TotalBuyOrderPrice = ($TotalBuyOrderPrice + round($BO['_id']['PerPrice']*$BO['Amount'],8));
							$BuyOrderPrice = round($TotalBuyOrderPrice/$BuyOrderAmount,8);
							//print_r($BO['_id']['_id']->{'$id'});
							$ids = $ids .','.(string)$BO['_id']['_id']->{'$id'}.'';
							
						}
					?>
					<tr onClick="BuyOrderFill(<?=$BuyOrderPrice?>,<?=$BuyOrderAmount?>,'<?=$ids?>');" style="cursor:pointer;<?php if($user['_id']==$BO['_id']['user_id']){?>background-color:#A5FC8F;<?php } ?>" class=" tooltip-x" rel="tooltip-x" data-placement="top" title="Sell <?=$BuyOrderAmount?> <?=$first_curr?> at <?=$BuyOrderPrice?> <?=$second_curr?>">
						<td style="text-align:right"><?=$BO['No']?><?php if($user['_id']==$BO['_id']['user_id']){?><span class="pull-left">*</span><?php }?></td>											
						<td style="text-align:right"><?=number_format(round($BO['_id']['PerPrice'],8),8)?></td>
						<td style="text-align:right"><?=number_format(round($BO['Amount'],8),8)?></td>
						<td style="text-align:right"><?=number_format(round($BO['_id']['PerPrice']*$BO['Amount'],8),8)?></td>																	
					</tr>
					<?php 
					}?>
					<tr><td colspan="4"><small><span><small><?=$t('Displaying only last')?>: <?=$i?></small></span><span class="pull-right">* - [<?=$t('Self')?>] <?=$user['username']?></span></small></td></tr>
				</tbody>
			</table>
		</div>	
	</div>
</div>