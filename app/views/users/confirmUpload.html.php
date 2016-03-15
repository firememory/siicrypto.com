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
			<h3>Withdrawal Request by <?=$transaction['username']?></h3>
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
						<div class="col-md-6 shade divSingle"><h4><strong>Select Admin:</strong></h4></div>
						<div class="col-md-6 divDouble">
							<select class="form-control" name="AdminUser" id="AdminUser">	
								<option value="">-- Select Admin --</option>
								<option value="<?=NAME_ADMIN1?>,<?=PHONE_ADMIN1?>"><?=NAME_ADMIN1?> <?=PHONE_ADMIN1?> </option>
								<option value="<?=NAME_ADMIN2?>,<?=PHONE_ADMIN2?>"><?=NAME_ADMIN2?> <?=PHONE_ADMIN2?></option>
								<option value="<?=NAME_ADMIN3?>,<?=PHONE_ADMIN3?>"><?=NAME_ADMIN3?> <?=PHONE_ADMIN3?></option>
								<option value="<?=NAME_ADMIN4?>,<?=PHONE_ADMIN4?>"><?=NAME_ADMIN4?> <?=PHONE_ADMIN4?></option>
								<option value="<?=NAME_ADMIN5?>,<?=PHONE_ADMIN5?>"><?=NAME_ADMIN5?> <?=PHONE_ADMIN5?></option>
								<option value="<?=NAME_ADMIN6?>,<?=PHONE_ADMIN6?>"><?=NAME_ADMIN6?> <?=PHONE_ADMIN6?></option>
							</select>
						</div>
				</div>
				<div class="row " >
						<div class="col-md-6 divDouble"><a href="#" class="btn btn-primary btn-block" onclick="CallAdmin()">Call Admin</a></strong></h4></div>
				</div>						
				<div class="row divBox" >
						<div class="col-md-6 shade divSingle"><h4><strong>Enter TOTP:</strong></h4></div>
						<div class="col-md-6 divDouble"><input type="text" placeholder="000000" min="0" max="999999" name="AdminTOTP" id="AdminTOTP" class="form-control"></div>
				</div>
				<div class="row " >
							<div class="col-md-6 divDouble"><a href="#" class="btn btn-success btn-block" onclick="ConfirmAdmin()">Confirm & Send to ILS</a></div>
							<div class="col-md-6 divDouble"><a href="#" class="btn btn-danger btn-block" onclick="RejectAdmin()">Reject</a></div>
				</div>
				<div class="row " >
					<div class="col-md-12">
						<p class="alert alert-danger" style="display:none" id="alert-danger">Danger</p>
						<p class="alert alert-success"  style="display:none" id="alert-success">Success</p>
					</div>
				</div>
		</div>
		
</div>
