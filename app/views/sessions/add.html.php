<?php

?>

<p class="alert alert-danger" id="LoginAlert">SiiCrypto.com: <strong><a href="/users/signup" >Registration is FREE!</a></strong></p>
<div class="row container-fluid">
	<div class="col-md-6 well" >
		
		<div class="panel-body">
        <h3 style="margin-top:0; margin-bottom:15px;">Login</h3>
								<p>Please make sure you enter your <span style="color:red">username</span>, not your email. Your username & password are <span style="color:red">case sensitive</span>!</p>
			<?=$this->form->create(null,array('class'=>'form-group has-error')); ?>
			<div class="form-group has-error">			
				<div class="input-group">
					<span class="input-group-addon">
						<i class="glyphicon glyphicon-asterisk" id="UserNameIcon"></i>
					</span>
						<?=$this->form->field('username', array('label'=>'', 'onBlur'=>'SendPassword();', 'placeholder'=>'username', 'class'=>'form-control')); ?>
				</div>
			</div>				
			<div class="form-group has-error">			
				<div class="input-group">
					<span class="input-group-addon">
						<i class="glyphicon glyphicon-asterisk"></i>
					</span>
			<?=$this->form->field('password', array('type' => 'password', 'label'=>'', 'placeholder'=>'password','class'=>'form-control')); ?>
				</div>
			</div>				

			<div class="alert alert-danger"  id="LoginEmailPassword" style="display:none">
				<div class="form-group has-error">			
					<div class="input-group">
						<span class="input-group-addon">
							<i class="glyphicon glyphicon-asterisk"></i>
						</span>
					<?=$this->form->field('loginpassword', array('type' => 'password', 'label'=>'','class'=>'span1','maxlength'=>'6', 'placeholder'=>'123456','class'=>'form-control')); ?>
					</div>		
				</div>		
				<small>Please check your registered email in 5 seconds. You will receive "<strong>Login Email Password</strong>" (check your junk folder). Insert code in the box above and then click on Login.</small>
			</div>		

			<div style="display:none" id="TOTPPassword" class="alert alert-danger">
			<div class="form-group has-error">			
				<div class="input-group">
					<span class="input-group-addon">
						<i class="glyphicon glyphicon-asterisk"></i>
					</span>
			<?=$this->form->field('totp', array('type' => 'password', 'label'=>'','class'=>'span1','maxlength'=>'6', 'placeholder'=>'123456','class'=>'form-control')); ?>	
				</div>		
			</div>		
				<small><strong>Time based One Time Password (TOTP) from your smartphone</strong></small>	
			</div>
		
			<?=$this->form->submit('Login' ,array('class'=>'btn btn-primary btn-block','id'=>'LoginButton','disabled'=>'disabled')); ?>
			<?=$this->form->end(); ?>
			<a href="/users/forgotpassword">Forgot password?</a><br>
			<p><br><a href="/users/signup"  class="btn btn-primary btn-block">Register / Open an account</a></p>
		</div>
	</div>
	<div class="col-md-6 well">
	
		<div style="padding-top:0;" class="panel-body">
		<h3 style="margin-top:0;">Sign up</h3>
		To open an account, first open a GreenCoinX wallet at <a href="https://xgcwallet.org" target="_blank">www.xgcwallet.org</a>, obtain your unique KYC identification number and then  <a href="/users/signup">Register</a><br>
		Please read the <a href="/company/termsofservice">terms of service</a> page before you sign up.<br>
		<h3>Security</h3>
		We use <strong>Two Factor Authentication</strong> for your account to login to <?=COMPANY_URL?>.<br>
		We also offer you the option of using <strong>Time-based One-time Password Algorithm (TOTP)</strong> for login, withdrawal/deposits and settings. This is an option and not a requirement. If you decide to use Google Authenticator TOTP you will enjoy even stronger security capability. <br>
		Optional Google Authenticator can be activated via the TOTP links below.<br>
Customers must password verify XGC or BTC withdrawal.<br>
All XGC or BTC withdrawals are approved by SiiCrypto for extra security.<br>
		<p><h3>TOTP Project and downloads</h3>
			<ul>
			<li><a href="http://code.google.com/p/google-authenticator/" target="_blank">Google Authenticator</a></li>
			<li><a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_blank">TOTP Android App</a></li>
			<li><a href="http://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8" target="_blank">TOTP iOS App</a></li>
			</ul>
		</p>
	</div>
</div>
</div>

