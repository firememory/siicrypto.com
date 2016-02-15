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
		<?=$this->form->submit('Sign up' ,array('class'=>'btn btn-primary btn-block')); ?>
		<?=$this->form->end(); ?>
	</div>
	<div class="col-sm-9 col-sm-offset-3 col-md-6  col-md-offset-1 well" >
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Advantages</h3>
			</div>
		</div>
		<h3>Sabrina Investments Inc. SiiCrypto.com</h3>
		<ul>
<li>SiiCrypto first time users need to open an online GreenCoinX wallet at <a href="https://xgcwallet.org" target="_blank">www.xgcwallet.org</a>.</li>
<li>Users will complete an online “Know Your Client” verification process which only takes a few minutes.</li>
<li>The promise of crypto currency was always the fast and inexpensive transfer of funds worldwide, while bypassing the banking system.</li>
<li>Until GreenCoinX this has been impeded by identity concerns. Now GreenCoinX has made this promise a reality by its KYC capability.</li>
<li>All fiat funds are held by third party fiduciary trust company</li>
		</ul>


<p>
Any issues please contact us at <a href="mailto:support@siiCrypto.com">support@siiCrypto.com</a>
</p>
		</div>
	</div>

