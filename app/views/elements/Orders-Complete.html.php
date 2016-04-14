		<div class="col-md-6">
			<div class="panel panel-success">
				<div class="panel-heading">
				<h2 class="panel-title"  style="font-weight:bold" ><?=$t('My completed orders')?> <span class="pull-right"><?=$t('Total')?>: <?=count($YourCompleteOrders)?></span></h2>
				</div>
				<div id="YourCompleteOrders" style="overflow:auto;">	
			<table class="table table-condensed table-bordered table-hover" style="font-size:12px">
				<thead>
					<tr>
						<th style="text-align:center "><?=$t('Exchange')?></th>
						<th style="text-align:center "><?=$t('Price')?></th>
						<th style="text-align:center "><?=$t('Amount')?></th>
					</tr>
				</thead>
				<tbody>
				<?php $i = 0;foreach($YourCompleteOrders as $YO){ 
				if($i==20){break;}else{$i++;}?>
					<tr style="cursor:pointer;background-color:<?php if($YO['Action']=="Sell"){echo '#FF99FF';}else{echo '#99FF99';}?>"
					class=" tooltip-x" rel="tooltip-x" data-placement="top" title="<?=$YO['Action']?> <?=number_format($YO['Amount'],3)?> at 
					<?=number_format($YO['PerPrice'],8)?> on <?=gmdate('Y-m-d H:i:s',$YO['DateTime']->sec)?>">
						<td style="text-align:left">
						<?=$YO['Action']?> <?=$YO['FirstCurrency']?>/<?=$YO['SecondCurrency']?></td>
						<td style="text-align:right "><?=number_format($YO['PerPrice'],8)?></td>
						<td style="text-align:right "><?=number_format($YO['Amount'],8)?></td>
					</tr>
				<?php }?>					
				<tr><td colspan="3"><small><?=$t('Displaying only last')?>: <?=$i?></small></td></tr>
				</tbody>
				
			</table>
				</div>
			</div>
		</div>		
