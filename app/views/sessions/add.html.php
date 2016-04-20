<?php use lithium\core\Environment; 
if(substr(Environment::get('locale'),0,2)=="en"){$locale = "en";}else{$locale = Environment::get('locale');}
//if(strlen($locale>2)){$locale='en';}
// print_r(Environment::get('locale'));
// print_r($locale);
?>
<p class="alert alert-danger" id="LoginAlert">SiiCrypto.com: <strong><a href="/<?=$locale?>/users/signup" ><?=$t('Registration is FREE!')?></a></strong></p>
<div class="row container-fluid">
	<div class="col-md-6 well" >
		
		<div class="panel-body">
        <h3 style="margin-top:0; margin-bottom:15px;"><?=$t('Login')?></h3>
								<p><?=$t('Please make sure you enter your')?> <span style="color:red">username</span>, <?=$t('not your email')?>. <?=$t('Your username & password are')?> <span style="color:red"><?=$t('Case Sensitive')?></span>!</p>
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
				<small><?=$t('Please check your registered email in 5 seconds. You will receive')?> "<strong><?=$t('Login Email Password')?></strong>" <?=$t('(check your junk folder). Insert code in the box above and then click on Login')?>.</small>
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
				<small><strong><?=$t('Time based One Time Password (TOTP) from your smartphone')?></strong></small>	
			</div>
		
			<?=$this->form->submit($t('Login') ,array('class'=>'btn btn-primary btn-block','id'=>'LoginButton','disabled'=>'disabled')); ?>
			<?=$this->form->end(); ?>
			<a href="/<?=$locale?>/users/forgotpassword"><?=$t('Forgot password')?>?</a><br>
			<p><br><a href="/<?=$locale?>/users/signup"  class="btn btn-primary btn-block"><?=$t('Register / Open an account')?></a></p>
		</div>
	</div>
	<div class="col-md-6 well">
	
		<div style="padding-top:0;" class="panel-body">
		<h3 style="margin-top:0;"><?=$t('Sign up')?></h3>
		<?=$t('To open an account, first open a GreenCoinX wallet at')?> <a href="https://xgcwallet.org" target="_blank">www.xgcwallet.org</a>, <?=$t('obtain your unique KYC identification number and then ')?> <a href="/<?=$locale?>/users/signup"><?=$t('Register')?></a><br>
		<?=$t('Please read the')?> <a href="/<?=$locale?>/company/termsofservice"><?=$t('terms of service')?></a> <?=$t('page before you sign up')?>.<br>
		<h3><?=$t('Security')?></h3>
		<?=$t('We use')?> <strong><?=$t('Two Factor Authentication')?></strong> <?=$t('for your account to login to')?> <?=COMPANY_URL?>.<br>
		<?=$t('We also offer you the option of using')?> <strong><?=$t('Time-based One-time Password Algorithm (TOTP)')?></strong> <?=$t('for login, withdrawal/deposits and settings. This is an option and not a requirement. If you decide to use Google Authenticator TOTP you will enjoy even stronger security capability.')?> <br>
		<?=$t('Optional Google Authenticator can be activated via the TOTP links below.')?><br>
<?=$t('Customers must password verify XGC or BTC withdrawal.')?><br>
<?=$t('All XGC or BTC withdrawals are approved by SiiCrypto for extra security.')?><br>
		<p><h3><?=$t('TOTP Project and downloads')?></h3>
			<ul>
			<li><a href="http://code.google.com/p/google-authenticator/" target="_blank"><?=$t('Google Authenticator')?></a></li>
			<li><a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_blank"><?=$t('TOTP Android App')?></a></li>
			<li><a href="http://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8" target="_blank"><?=$t('TOTP iOS App')?></a></li>
			</ul>
		</p>
	</div>
</div>
</div>