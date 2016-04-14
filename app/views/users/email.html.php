<?php use lithium\core\Environment; 
if(substr(Environment::get('locale'),0,2)=="en"){$locale = "en";}else{$locale = Environment::get('locale');}
//if(strlen($locale>2)){$locale='en';}
// print_r(Environment::get('locale'));
// print_r($locale);
?><div class="col-md-12">
	<h3><?=$t('Email Verification')?>:</h3>
	<?php echo $msg;?>
	<?=$this->form->create("",array('url'=>'/'.$locale.'/users/confirm/')); ?>
	<?=$this->form->field('email', array('label'=>$t('Email'),'placeholder'=>'name@youremail.com','class'=>'form-control' )); ?>
	<?=$this->form->field('verified', array('type' => 'text', 'label'=>$t('Verification code'),'placeholder'=>'50d54d309d5d0c3423000000','class'=>'form-control' )); ?><br>
	<?=$this->form->submit($t('Verify'),array('class'=>'btn btn-primary')); ?>
	<?=$this->form->end(); ?>
	<p><?=$t('Please check your spam folder too while checking your inbox!')?></p>
</div>