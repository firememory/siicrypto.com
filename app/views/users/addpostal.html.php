<?php use lithium\core\Environment; 
if(substr(Environment::get('locale'),0,2)=="en"){$locale = "en";}else{$locale = Environment::get('locale');}
//if(strlen($locale>2)){$locale='en';}
// print_r(Environment::get('locale'));
// print_r($locale);
?><div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><?=$t('Add/Edit Postal Details')?>:</h3>
	</div>
	<div class="panel-body">
	<div class="row container" >
	<div class="col-md-5">
	<p><?=$t('This address may be used when you withdraw funds.')?></p>
<?php
foreach($details as  $d){
?>
<?=$this->form->create('',array('url'=>'/'.$locale.'/users/addpostaldetails')); ?>
<?=$this->form->field('Name', array('label'=>'1. Name','placeholder'=>'Name','value'=>$d['postal']['Name'],'class'=>'form-control')); ?>
<?=$this->form->field('Address', array('label'=>'2. Address','placeholder'=>'Address','value'=>$d['postal']['Address'],'class'=>'form-control' )); ?>
<?=$this->form->field('Street', array('label'=>'3. Street','placeholder'=>'Street','value'=>$d['postal']['Street'],'class'=>'form-control' )); ?>
<?=$this->form->field('City', array('label'=>'4. City','placeholder'=>'City','value'=>$d['postal']['City'],'class'=>'form-control' )); ?>
<?=$this->form->field('Zip', array('label'=>'5. Postal / Zip Code','placeholder'=>'Zip Code','value'=>$d['postal']['Zip'],'class'=>'form-control' )); ?>
<?=$this->form->field('Country', array('label'=>'6. Country','placeholder'=>'Country','value'=>$d['postal']['Country'],'class'=>'form-control' )); ?><br>

<?=$this->form->submit('Save Address',array('class'=>'btn btn-primary btn-block')); ?>
<?=$this->form->end(); ?>
<?php }?>
	</div>
</div>
</div>
</div>