<?php
use app\models\Parameters;
$Comm = Parameters::find('first');
?>
<?php $this->form->config(array( 'templates' => array('error' => '<p class="alert alert-danger">{:content}</p>'))); 
?>
<div class="row container-fluid">
	<div class="col-sm-6 col-md-5  col-md-offset-0 well" >
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Register</h3>
			</div>
		</div>
		<?=$this->form->create($Users,array('class'=>'form-group has-error')); ?>
		<div class="row" id="KYC-Check">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="form-group">
				<label for="kyc_id"><strong>KYC ID: Know your customer</strong></label>
		<?=$this->form->field('kyc_id', array('label'=>'','placeholder'=>'13JH-98UH76JK', 'class'=>'form-control' )); ?>

				</div>
			</div>
			<div class="col-sm-10 col-sm-offset-1" >
					<input type="button" class="btn btn-success btn-block" onclick="checkkyc();"  id="GetKYC" value="Verify KYC Info" />
			</div>
			<div class="col-sm-10 col-sm-offset-1">
					
					<br><span id="kyc_result" style="display:none;color:green">Your KYC is approved</span>
			</div>
	</div>	
<br>

			<div class="form-group has-error">			
				<div class="input-group">
					<span class="input-group-addon">
						<i class="glyphicon glyphicon-asterisk" id="FirstNameIcon"></i>
					</span>
		<?=$this->form->field('firstname', array('label'=>'','placeholder'=>'First Name', 'class'=>'form-control','onkeyup'=>'CheckFirstName(this.value);' )); ?>
				</div>
			</div>				
			<div class="form-group has-error">			
				<div class="input-group">
					<span class="input-group-addon">
						<i class="glyphicon glyphicon-asterisk" id="LastNameIcon"></i>
					</span>
		<?=$this->form->field('lastname', array('label'=>'','placeholder'=>'Last Name', 'class'=>'form-control','onkeyup'=>'CheckLastName(this.value);' )); ?>
				</div>
			</div>				
			<div class="form-group has-error">			
				<div class="input-group">
					<span class="input-group-addon">
						<i class="glyphicon glyphicon-asterisk" id="UserNameIcon"></i>
					</span>
		<?=$this->form->field('username', array('label'=>'','placeholder'=>'username', 'class'=>'form-control','onkeyup'=>'CheckUserName(this.value);' )); ?>
				</div>
		<p class="label label-danger">Only characters and numbers, NO SPACES</p>				
			</div>				
			<div class="form-group has-error">			
				<div class="input-group">
					<span class="input-group-addon">
						<i class="glyphicon glyphicon-asterisk" id="EmailIcon"></i>
					</span>

		<?=$this->form->field('email', array('label'=>'','placeholder'=>'name@youremail.com', 'class'=>'form-control','onkeyup'=>'CheckEmail(this.value);'  )); ?>
				</div>
			</div>				
			<div class="form-group has-error">			
				<div class="input-group">
					<span class="input-group-addon">
						<i class="glyphicon glyphicon-asterisk" id="PasswordIcon"></i>
					</span>
		<?=$this->form->field('password', array('type' => 'password', 'label'=>'','placeholder'=>'Password', 'class'=>'form-control','onkeyup'=>'CheckPassword(this.value);' )); ?>
				</div>
			</div>				
			<div class="form-group has-error">			
				<div class="input-group">
					<span class="input-group-addon">
						<i class="glyphicon glyphicon-asterisk" id="Password2Icon"></i>
					</span>
		<?=$this->form->field('password2', array('type' => 'password', 'label'=>'','placeholder'=>'same as above', 'class'=>'form-control','onkeyup'=>'CheckPassword(this.value);' )); ?>
				</div>
			</div>				
		<?php // echo $this->recaptcha->challenge();?>
		<input type="submit" id="RegisterMe" disabled="disabled" class="btn btn-primary btn-block" value="Register">
		<br><span id="ERROR" style="display:none;color:red">.</span>
		<p>Already have an account. <br><a href="/login">Click here to login</a></p>
		<?=$this->form->end(); ?>
	</div>
	<div class="col-sm-9 col-sm-offset-3 col-md-6  col-md-offset-1 well" >
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">How to Register</h3>
			</div>
		</div>
		 <p>To Register, first obtain a "Know Your Client" or KYC number by opening a GreenCoinX online wallet. Click on this link to start the process and open a wallet <a href="https://xgcwallet.org" target="_blank">www.xgcwallet.org</a>.</p><p> When your wallet is opened you will receive a KYC unique number.  Insert that number in the KYC ID box on this page and then click Validate KYC Info. You will then be validated as having completed the KYC process and can proceed to open a SiiCrypto account.</p>

<p>Insert your name and then a UserName for trading purposes. Your user name should be only characters and numbers with no spaces. Insert your email address and create a Password. Then Click the Register button to complete the SiiCrypto account opening process.</p>
<p>
Any issues please contact us at <a href="mailto:support@SiiCrypto.com">support@SiiCrypto.com</a>
</p>
		</div>
	</div>

