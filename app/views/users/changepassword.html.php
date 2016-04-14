<?php use lithium\core\Environment; 
if(substr(Environment::get('locale'),0,2)=="en"){$locale = "en";}else{$locale = Environment::get('locale');}
//if(strlen($locale>2)){$locale='en';}
// print_r(Environment::get('locale'));
// print_r($locale);
?><h4><?=$t('Change password')?></h4>
<?=$this->form->create("",array('url'=>'/'.$locale.'/users/password/','class'=>'col-md-5')); ?>
<?=$this->form->field('email', array('type' => 'text', 'label'=>$t('Your email address'),'placeholder'=>'email@domain.com','class'=>'form-control' )); ?>					
<?=$this->form->field('password', array('type' => 'password', 'label'=>$t('New Password'),'placeholder'=>'Password','class'=>'form-control' )); ?>
<?=$this->form->field('password2', array('type' => 'password', 'label'=>$t('Repeat new password'),'placeholder'=>'same as above','class'=>'form-control' )); ?>
<?=$this->form->hidden('key', array('value'=>$key))?><br>
<?=$this->form->submit($t('Change Password') ,array('class'=>'btn btn-primary')); ?>					
<?=$this->form->end(); ?>
