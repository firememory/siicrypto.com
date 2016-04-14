<?php use lithium\core\Environment; 
if(substr(Environment::get('locale'),0,2)=="en"){$locale = "en";}else{$locale = Environment::get('locale');}
//if(strlen($locale>2)){$locale='en';}
// print_r(Environment::get('locale'));
// print_r($locale);
?><?php
use app\models\Parameters;
$Comm = Parameters::find('first');
?>
<h3><?=$t('FAQ')?></h3>

<p><strong><u><?=$t('Become a Customer')?></u></strong></p>

<blockquote><?=$t('To become an SiiCrypto customer please click')?> <a href="/<?=$locale?>/users/signup"><?=$t('signup')?></a>. <?=$t('Registration implies you have read and agreed to our')?> <a href="/<?=$locale?>/company/termsofservice"><?=$t('Terms of Service.')?></a>
</blockquote>
<p><strong><u><?=$t('Fees')?></u></strong></p>
<blockquote><ul>
<li><?=$t('We charge')?> <strong><?=$Comm['value']?></strong>% <?=$t('per transaction.')?></li>
<li><?=$t('If you')?> <strong><?=$t('buy')?></strong> <?=$t('1 Bitcoin our fee is')?> <strong><?=$Comm['value']/100?></strong> <?=$t('Bitcoins.')?></li>
<li><?=$t('If you')?> <strong><?=$t('sell')?></strong> $100 <?=$t('worth of Bitcoins our fee is')?> <strong><?=$Comm['value']*100?></strong> <?=$t('cent.')?></li>
</ul>
</blockquote>
<p><strong><u><?=$t('Deposits/Withdrawals')?></u></strong></p>
<blockquote>

<ul>
<span><?=$t('For')?> <strong><?=$t('bank wire transfer')?></strong> <?=$t('deposits/withdrawals')?></span><br>

		
<li><?=$t('All deposits and withdrawals need to be verified and cleared, please see relevant sections when you login.')?></li>
<li><?=$t('VERY IMPORTANT: Please make sure to INCLUDE your CUSTOMER REFERENCE with your deposit, which you can find when you complete FUNDING on your account page, so that we can credit your account appropriately.')?></li>
<li><?=$t('We cannot be held liable if you send us money with no reference and have not completed a deposit request via your account (though with recorded delivery we can attempt to return any such fiat or solve such matters).')?></li>
<li><?=$t('We cannot be held liable if you send us fiat with no reference, no deposit request, and no recorded delivery, and will treat such activity as suspicious and report it to the relevant authorities.')?></li>
<u><?=$t('Example Reference')?>:</u><br>
<?=$t('Account name')?>: <strong>silent bob</strong><br>
<?=$t('Reference number')?>: <strong>15828481</strong><br>
<?=$t('Amount')?>: <strong>$xxxx</strong><br>
</ul>  
<span><?=$t('When we receive your funds we verify with your deposit request and credit your SiiCrypto.com account the amount.')?></span><br>
<br>
<p><strong><?=$t('Deposits')?></strong></p>
<span><?=$t('Once fiat amounts are received your account gets credited the same amount, just the same as doing a bank transfer, without the bank.')?></span><br>
<br>
<p><strong><?=$t('Withdrawals')?></strong></p>

</blockquote>
