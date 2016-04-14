<?php use lithium\core\Environment; 
if(substr(Environment::get('locale'),0,2)=="en"){$locale = "en";}else{$locale = Environment::get('locale');}
//if(strlen($locale>2)){$locale='en';}
// print_r(Environment::get('locale'));
// print_r($locale);
?>
<div class="row container-fluid">
	<div class="col-md-6" >
		<h4><?=$t('Forgot password')?></h4>
		<?=$this->form->create("",array('url'=>'/'.$locale.'/users/forgotpassword','class'=>'form-group has-error')); ?>
		<?=$this->form->field('email', array('type' => 'text', 'label'=>$t('Your email'),'placeholder'=>'name@yourdomain.com','class'=>'form-control' )); ?>					<br>
		<?=$msg?><br>
		<?=$this->form->submit($t('Send password reset link') ,array('class'=>'btn btn-primary')); ?>					
		<?=$this->form->end(); ?>
	</div>
</div>