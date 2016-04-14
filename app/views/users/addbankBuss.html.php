<?php use lithium\core\Environment; 
if(substr(Environment::get('locale'),0,2)=="en"){$locale = "en";}else{$locale = Environment::get('locale');}
//if(strlen($locale>2)){$locale='en';}
// print_r(Environment::get('locale'));
// print_r($locale);
?><br>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><?=$t('Add / Edit Business Bank')?></h3>
	</div>
	<div class="panel-body">

<div class="row container">
	<div class="col-md-4">
<p><?=$t('This will un-set "verified" status, you will have to verify the bank again.')?></p>
<?php
foreach($details as  $d){
?>
<?=$this->form->create('',array('url'=>'/'.$locale.'/users/addbankBussdetails')); ?>
<?=$this->form->field('accountname', array('label'=>'1. Account name','placeholder'=>'Account name','value'=>$d['bankBuss']['accountname'],'class'=>'form-control')); ?>
<?=$this->form->field('companyname', array('label'=>'1a. Company name','placeholder'=>'Company name','value'=>$d['bankBuss']['companyname'],'class'=>'form-control')); ?>
<?=$this->form->field('companynumber', array('label'=>'1b. Company number','placeholder'=>'Company number','value'=>$d['bankBuss']['companynumber'],'class'=>'form-control')); ?>
<?=$this->form->field('sortcode', array('label'=>'2. Sort code','placeholder'=>'Sort code','value'=>$d['bankBuss']['sortcode'],'class'=>'form-control' )); ?>
<?=$this->form->field('accountnumber', array('label'=>'3. Account number','placeholder'=>'Account number','value'=>$d['bankBuss']['accountnumber'],'class'=>'form-control')); ?>
<?=$this->form->field('bankname', array('label'=>'4. Bank name','placeholder'=>'Bank name','value'=>$d['bankBuss']['bankname'] ,'class'=>'form-control')); ?>
<?=$this->form->field('branchaddress', array('label'=>'5. Branch address','placeholder'=>'Branch address','value'=>$d['bankBuss']['branchaddress'],'class'=>'form-control')); ?>
<?=$this->form->submit('Save bank',array('class'=>'btn btn-primary btn-block')); ?>
<?=$this->form->end(); ?>
<?php }?>
	</div>
	<div class="col-md-6">
		<p>Sample bank cheque for adding bank details.</p>
		<img src="/img/Cheque.png" alt="sample bank cheque">	
		<p>
</ul>
</p>
<p>If your bank is not listed, do not worry, please contact us via support@SiiCrypto.com and we will confirm whether or not your bank falls within our locality.</p>
	</div>
</div>
