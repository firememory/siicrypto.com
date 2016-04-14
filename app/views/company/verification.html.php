<?php use lithium\core\Environment; 
if(substr(Environment::get('locale'),0,2)=="en"){$locale = "en";}else{$locale = Environment::get('locale');}
//if(strlen($locale>2)){$locale='en';}
// print_r(Environment::get('locale'));
// print_r($locale);
?>
<h3><?=$t('Verification')?></h3>


<p><?=$t('To become a SiiCrypto customer and use our platform and services you need to register. SiiCrypto first time users need to open an online GreenCoinX wallet at')?> <a href="https://xgcwallet.org" target="_blank">www.xgcwallet.org</a>. <?=$t('Users will complete an online "Know Your Client" verification process which only takes a few minutes.')?> </p>
<p><?=$t('SiiCrypto.com reserve the right to seek more information to verify a customer\'s identity, and/or to refuse an account if the customer\'s identity is not verified to our requirement.')?></p>
<p><?=$t('Your information is subject to our')?> <a href="/<?=$locale?>/company/privacy"><?=$t('Privacy Policy')?></a>.</p>
<p><?=$t('To register an account and submit your verification information please')?> <a href="/<?=$locale?>/users/signup"><?=$t('click here')?></a>.</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
