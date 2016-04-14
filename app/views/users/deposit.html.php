<?php use lithium\core\Environment; 
if(substr(Environment::get('locale'),0,2)=="en"){$locale = "en";}else{$locale = Environment::get('locale');}
//if(strlen($locale>2)){$locale='en';}
// print_r(Environment::get('locale'));
// print_r($locale);
?><div class="row container-fluid">
<h2><?=$t('Deposit')?> <?=$data['data']['currency']?></h2>
<p><?=$t('You have requested to deposit')?> <?=$data['data']['amountFiat']?> <?=$data['data']['currency']?> <?=$t('to your SiiCrypto.com account')?> <strong><?=$data['username']?></strong>. <?=$t('From this deposit there will be deducted Bank Charges of minimum')?> <?=$parameters['deposit'][$data['data']['currency']]['min']?> <?=$data['data']['currency']?> <?=$t('and a Fiduciary Fee of')?> <?=$parameters['deposit'][$data['data']['currency']]['percent']?>%.</p>
<!--<p>Click to download the PDF directly from here <a href="/vanity/out/SiiCrypto-<?=$data['data']['Reference']?>.pdf" target="_blank">SiiCrypto-<?=$data['data']['Reference']?>.pdf</a></p>-->
<a href="/<?=$locale?>/users/sendDeposit/<?=$data['data']['Reference']?>" class="btn btn-primary"><?=$t('Click here to receive a completed copy of your DSF by email.')?></a>
<p><?=$t('Upon receipt of your DSF, please sign and upload the signed DSF using the link provided in the email.')?></p>
<?=$t('Once you upload')?> "<strong><?=$t('Declaration of Source of Funds (DSF)')?></strong>", <?=$t('we will send this document for SiiCrypto Approval. Upon approval, you can send the funds to the account.')?></p>

<p>&nbsp;</p>
<a href="/<?=$locale?>/ex/dashboard" class="btn btn-primary"><?=$t('Dashboard')?></a>
<p>&nbsp;</p>
</div>