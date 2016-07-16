<?php use lithium\core\Environment; 
if(substr(Environment::get('locale'),0,2)=="en"){$locale = "en";}else{$locale = Environment::get('locale');}
//if(strlen($locale>2)){$locale='en';}
// print_r(Environment::get('locale'));
// print_r($locale);
?><div class="col-md-6">
	<div class="panel panel-info">
		<div class="panel-heading">
		<h2 class="panel-title" style="cursor:pointer;font-weight:bold" onclick="document.getElementById('Graph').style.display='block';"><?=$t('Sell')?> <?=$first_curr?> <?=$t('get')?> <?=$second_curr?> <span class="pull-right"><?=$t('Graph')?> <i class="glyphicon glyphicon-indent-left"></i></span></h2>
		</div>
<?=$this->form->create(null,array('id'=>'SellForm')); ?>		
<input type="hidden" id="SellFirstCurrency" name="SellFirstCurrency" value="<?=$first_curr?>">
<input type="hidden" id="SellSecondCurrency" name="SellSecondCurrency" value="<?=$second_curr?>">		
<input type="hidden" id="SellCommission" name="SellCommission" value="0">				
<input type="hidden" id="UserName" name="UserName" value="<?=$details['username']?>">
<input type="hidden" id="SellCommissionAmount" name="SellCommissionAmount" value="0">						
<input type="hidden" id="SellCommissionCurrency" name="SellCommissionCurrency" value="0">								
<input type="hidden" id="SellMultiple" name="SellMultiple" value="N">								
<input type="hidden" id="SellIDs" name="SellIDs" value="">								
<input type="hidden" id="Action" name="Action" value="Sell">								
<table class="table table-condensed">
	<tr>
		<td width="50%"><?=$t('Your balance')?>:<br>
		<span id="BalanceFirst" style="display:none"><?=$BalanceFirst?></span>
		<span id="BalanceFirstDisplay">
		<strong><?=substr(number_format($BalanceFirst,8),0,-6)?></strong><small style="color:gray"><?=substr(number_format($BalanceFirst,8),-6)?></small>
		</span> <strong><?=$first_curr?></strong>
		</td>
		<td><?=$t('Highest Bid Price')?><br>
		<strong><span id="HighestBidPrice">0</span> <?=$second_curr?></strong>
		</td>
	</tr>
	<tr>
		<td>
		<?=$this->form->field('SellAmount', array('label'=>$t('Amount').' '.$first_curr,'class'=>'form-control col-md-1 numbers', 'value'=>0, 'onBlur'=>'this.value=(this.value).replace(/,/g, "");$("#SellSubmitButton").attr("disabled", "disabled");','min'=>'.25','max'=>'999999','maxlength'=>'10','type'=>'number','step'=>'0.00000001','onChange'=>"$('#SellMultiple').val('N');" )); ?>				
		</td>
		<td>
			<label for="SellPriceper"><?=$t('Price per')?> <?=$first_curr?></label>
		<div class="input-group">					
			<input class="col-md-1 form-control numbers" id="SellPriceper" name="SellPriceper" type="number"  onBlur='this.value=(this.value).replace(/,/g, "");$("#SellSubmitButton").attr("disabled", "disabled");' min="0.00000001" max="999999" maxlength="10" step="0.00000001" onChange="$('#SellMultiple').val('N');">
			<span class="input-group-addon"> <strong><?=$second_curr?></strong></span>
		</div>				
		</td>				
	</tr>
	<tr>
		<td><?=$t('Total')?>: </td>
		<td> <span class="label label-warning"><span id="SellTotal">0</span> <?=$second_curr?></span></td>
	</tr>
	<tr>
		<td><?=$t('Fiduciary Fees')?>: </td>
		<td> <span class="label label-success"><span id="SellFee">0</span> <?=$second_curr?></span></td>
	</tr>
	<tr>
		<td colspan="2" style="height:50px "><span id="SellSummary" style="color:maroon;font-weight:bold"><?=$t('Summary of your order')?></span></td>
	</tr>
	<tr>
		<td><input type="button" onClick="SellFormCalculate()" class="btn btn-coool  btn-block" value="<?=$t('Estimate')?>"></td>
		<td><input type="submit" id="SellSubmitButton" class="btn btn-primary btn-block" disabled="disabled" value="<?=$t('Submit')?>" onClick='$("#SellSubmitButton").attr("disabled", "disabled");$("#SellForm").submit();'></td>
	</tr>
</table>
<?=$this->form->end(); ?>
		</div>
</div>