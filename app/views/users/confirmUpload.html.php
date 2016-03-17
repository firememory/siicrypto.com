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
			<h3>Withdrawal Request by <?=$transaction['username']?> <br>Amount: <?=$transaction['Amount']?> <?=$transaction['Currency']?> - Net: <?=$transaction['netAmount']?> <?=$transaction['Currency']?></h3>
		</div>
		<div>
				<div class="row divBox" >
					<div class="col-md-6 shade divSingle"><h4><strong>Reference:</strong></h4></div>
					<div class="col-md-6 divDouble" id="Reference"><?=$transaction['Reference']?></div>
				</div>
				<div class="row divBox" >
					<div class="col-md-6 shade divSingle"><h4><strong>Uploaded PDF:</strong></h4></div>
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
				<?php if($Approved<2){?>
				<?php if($Rejected<1){?>
				<div class="row divBox" >
						<div class="col-md-6 shade divSingle"><h4><strong>Select Admin:</strong></h4></div>
						<div class="col-md-6 divDouble">
							<select class="form-control" name="AdminUser" id="AdminUser">	
								<option value="">-- Select Admin --</option>
								<?php if(!in_array(str_replace(" ","%20",NAME_ADMIN1),$Admins)){?>
								<option value="<?=NAME_ADMIN1?>,<?=PHONE_ADMIN1?>"><?=NAME_ADMIN1?> <?=PHONE_ADMIN1?> </option>
								<?php }?>
								<?php if(!in_array(str_replace(" ","%20",NAME_ADMIN2),$Admins)){?>
								<option value="<?=NAME_ADMIN2?>,<?=PHONE_ADMIN2?>"><?=NAME_ADMIN2?> <?=PHONE_ADMIN2?></option>
								<?php }?>
								<?php if(!in_array(str_replace(" ","%20",NAME_ADMIN3),$Admins)){?>
								<option value="<?=NAME_ADMIN3?>,<?=PHONE_ADMIN3?>"><?=NAME_ADMIN3?> <?=PHONE_ADMIN3?></option>
								<?php }?>
								<?php if(!in_array(str_replace(" ","%20",NAME_ADMIN4),$Admins)){?>
								<option value="<?=NAME_ADMIN4?>,<?=PHONE_ADMIN4?>"><?=NAME_ADMIN4?> <?=PHONE_ADMIN4?></option>
								<?php }?>
								<?php if(!in_array(str_replace(" ","%20",NAME_ADMIN5),$Admins)){?>
								<option value="<?=NAME_ADMIN5?>,<?=PHONE_ADMIN5?>"><?=NAME_ADMIN5?> <?=PHONE_ADMIN5?></option>
								<?php }?>
								<?php if(!in_array(str_replace(" ","%20",NAME_ADMIN6),$Admins)){?>
								<option value="<?=NAME_ADMIN6?>,<?=PHONE_ADMIN6?>"><?=NAME_ADMIN6?> <?=PHONE_ADMIN6?></option>
								<?php }?>

							</select>
						</div>
				</div>
				<?php }?>
				<?php }?>
				
				<?php if($Approved<2){?>
				<?php if($Rejected<1){?>
				<div class="row " >
						<div class="col-md-6 divDouble"><a href="#" class="btn btn-primary btn-block" onclick="CallAdmin()">Call Admin</a></strong></h4></div>
				</div>						
				<div class="row divBox" >
						<div class="col-md-6 shade divSingle"><h4><strong>Enter TOTP:</strong></h4></div>
						<div class="col-md-6 divDouble"><input type="text" placeholder="000000" min="0" max="999999" name="AdminTOTP" id="AdminTOTP" class="form-control"></div>
				</div>
				<div class="row " >
							<div class="col-md-6 divDouble"><a href="#" class="btn btn-success btn-block" onclick="ConfirmAdmin()">Confirm</a></div>
							<div class="col-md-6 divDouble"><a href="#" class="btn btn-danger btn-block" onclick="RejectAdmin()">Reject</a></div>
				</div>
				<?php }?>
				<?php }?>
				<?php if($transaction['SenttoBank']!="Yes"){?>
				<?php if($Approved==2){?>
				<div class="row " >
				<div class="col-md-12 " id="FinalApprover"><?=str_replace('%20',' ',$Admin['UserName'])?></div>
				<div class="col-md-12 " ><a href="#" class="btn btn-success btn-block" onclick="SendtoILS()">Send to ILS</a></div>
				
				</div>
			<?php }?>
				<?php if($Rejected==1){?>
					<?php if($transaction['Status']=="Rejected"){?>
				<div class="row " >
					<div class="col-md-12 divSingle">Sent to User <?=$transaction['SenttoUser']?> by <?=str_replace('%20', ' ',$transaction['SentByAdmin'])?> Status: <?=$transaction['Status']?>
				</div>
				<?php }else{?>			
				<div class="row " >
					<div class="col-md-12 " id="FinalApprover"><?=str_replace('%20',' ',$Admin['UserName'])?></div>
					<div class="col-md-12 " ><a href="#" class="btn btn-danger btn-block" onclick="SendtoUser()">Inform User: Rejection</a></div>
				</div>
				<?php }?>			
			<?php }?>			
			<?php }else{?>
				<div class="row " >
				<div class="col-md-12 divSingle">Sent to ILS <?=$transaction['SenttoBank']?> by <?=str_replace('%20', ' ',$transaction['SentByAdmin'])?>
				</div>
				</div>
			<?php }?>			
				<div class="row " >
					<div class="col-md-12">
						<p class="alert alert-danger" style="display:none" id="alert-danger">Danger</p>
						<p class="alert alert-success"  style="display:none" id="alert-success">Success</p>
					</div>
				</div>
		</div>
		
</div>
