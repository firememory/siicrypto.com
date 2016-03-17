<style>
.divBox{ 
border-radius: .5rem;
border:1px solid #ccc;
margin-bottom:5px;
}
.divSingle{
	padding:1px;
	padding-left:10px;
	border-bottom:1px solid #ccc;
}
.divDouble{
	padding:10px
}
.shade{
	background-color:#eee;
}
</style><div class="col-md-6 col-md-offset-3">
		<div style="padding:10px">
			<h3>Withdrawal Request by <?=$transaction['username']?> <br>Amount: <?=$transaction['netAmount']?> <?=$transaction['Currency']?></h3>
		</div>
		<div>
				<div class="row divBox" >
					<div class="col-md-6 shade divSingle"><h4><strong>Reference:</strong></h4></div>
					<div class="col-md-6 divDouble" id="Reference"><?=$transaction['Reference']?></div>
				</div>
				<div class="row divBox" >
					<div class="col-md-6 shade divSingle"><h4><strong>Download PDF file:</strong></h4></div>
					<div class="col-md-6 divDouble">View <a href="/vanity/out/SiiCrypto-Withdraw-<?=$transaction['Reference']?>-<?=gmdate('Y-M-d',$transaction['DateTime']->sec)?>-<?=$transaction['Currency']?>-<?=$transaction['netAmount']?>.pdf" target="_blank"><?=$transaction['Reference']?></a></div>
				</div>
				<div class="row divBox" >
				<?php 
				$Admins = array();
				$Approved = 0;
				$Rejected = 0;
				foreach($transaction['Admin'] as $Admin){
					$UsersAdmin = explode(",",$Admin['UserName']);
					array_push($Admins,$UsersAdmin[0]);
					?>
					
					<?php if($Admin['Status']=='Approved'){ $Approved = $Approved + 1;?>
					<div class="col-md-12 divSingle alert-success"><?=str_replace('%20',' ',$Admin['UserName'])?>
						<i class="fa fa-check fa-2x"></i>
					</div>
					<?php }else{ $Rejected = $Rejected + 1;?>
					<div class="col-md-12 divSingle alert-danger"><?=str_replace('%20',' ',$Admin['UserName'])?>
						<i class="fa fa-times fa-2x"></i>
					</div>
					<?php }?>
				<?php }	?>
				</div>
				
			
				<div class="row " >
				<div class="col-md-12 divSingle">Sent to ILS <?=$transaction['SenttoBank']?> by <?=str_replace('%20', ' ',$transaction['SentByAdmin'])?>
				</div>
				</div>
			
			
		</div>
		
</div>
