<h4>Transactions</h4>
		<table class="table table-condensed table-bordered table-hover" >
		<thead>
			<tr>
				<th>Date</th>
				<th>Username</th>
				<th>Reference</th>				
				<th>Amount</th>
				<th>Currency</th>				
				<th>Type</th>
				<th>Approved</th>		
				<th>Action</th>								
			</tr>
		</thead>
		<tbody>
<?php 

$i = 0;
foreach ($Details	as $tx){?>
		<tr <?php if(($i%2)==0){?>style="background-color:#999"<?php }else{?>style="background-color:#ddd"<?php }?>>
			<td><?=gmdate('Y-M-d H:i:s',$tx['DateTime']->sec)?></td>
			<td><a href="/Admin/detail/<?=$tx['username']?>" target="_blank"><?=$tx['username']?></a><br>


			</td>
			<td><?=$tx['Reference']?></td>
			<td style="text-align:right "><?=number_format($tx['Amount'],2)?><br>
						<div class="alert alert-success" style="padding:5px"><small>Deposits:<br>
<?=number_format($tx['Funds']['USD'],2)?> USD<br>
<?=number_format($tx['Funds']['CAD'],2)?> CAD<br>						
<?=number_format($tx['Funds']['EUR'],2)?> EUR<br>
<?=number_format($tx['Funds']['GBP'],2)?> GBP</small></div>
			</td>
			<td style="text-align:right "><?=$tx['Currency']?><br>
						<div class="alert alert-warning" style="padding:5px"><small>Withdrawals:<br>
						<?=number_format($tx['FundsOut']['USD'],2)?> USD<br>
						<?=number_format($tx['FundsOut']['CAD'],2)?> CAD<br>						
						<?=number_format($tx['FundsOut']['EUR'],2)?> EUR<br>
						<?=number_format($tx['FundsOut']['GBP'],2)?> GBP</small>
						</div>
			</td>			
			<td><?php if($tx['Added']==true){echo "Deposit";}else{echo "Withdraw";}?></td>
			<td style="text-align:center"><?=$tx['Approved']?><br>Sent to Bank: <?=$tx['SenttoBank']?></td>			
			<td>
			
			<a href="/admin/deletetransaction/<?=$tx['_id']?>" class="tooltip-y" rel="tooltip-x" data-placement="top" title="Cannot be recovered">Delete</a>
			<a href="/admin/rejecttransaction/<?=$tx['_id']?>/D1"  class="tooltip-y" rel="tooltip-x" data-placement="top" title="User will be sent an email about rejection, cannot be recovered">Reject ></a><br>
			
			<select id="RejectReason" class="form-control col-md-2" onChange="RejectReason(this.value);">
			<?php foreach($reasons as $reason){	?>
				<option value="<?=$reason['code']?>"><?=$reason['reason']?></option>
			<?php }?>
			</select><br>
			<?php
			$Amount = round($tx['Amount'] - $parameters['deposit'][$tx['Currency']]['min'] - $tx['Amount']*$parameters['deposit'][$tx['Currency']]['percent']/100);
			?>
			<form action="/admin/approvetransaction" method="post" class="form form-horizontal">
				<input type="text" name="Amount" id="Amount" value="<?=$Amount?>" max="<?=$Amount?>" min="1" class="col-md-2 form-control tooltip-y" rel="tooltip-x" data-placement="top" title="Only numbers no comma ">
				<input type="hidden" name="id" id="id" value="<?=$tx['_id']?>">
				<input type="hidden" name="Currency" id="Currency" value="<?=$tx['Currency']?>">				
				<br>
				<input type="submit" value="Deposit to site" class="btn btn-primary tooltip-y" rel="tooltip-x" data-placement="top" title="Approve this transaction">
			</form>
			
			</td>
		</tr>
<?php  foreach($tx['Previous'] as $pt){ ?>
		<tr <?php if(($i%2)==0){?>style="background-color:#aaa"<?php }else{?>style="background-color:#eee"<?php }?>>
			<td><?=gmdate('Y-M-d H:i:s',$pt['DateTime']->sec)?></td>
			<td><?=$tx['username']?></td>
			<td>Previous Transaction </td>
			<td style="text-align:right "><?=number_format($pt['Amount'],2)?></td>
			<td style="text-align:right "><?=$pt['Currency']?></td>			
			<td><?php if($pt['Added']==true){echo "Deposit";}else{echo "Withdraw";}?></td>
			<td style="text-align:center"><?=$pt['Approved']?></td>			
			<td colspan="3"></td>
		</tr>
<?php }?>
<?php $i++;
} ?>
		</tbody>
	</table>