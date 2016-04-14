<?php use lithium\core\Environment; 
if(substr(Environment::get('locale'),0,2)=="en"){$locale = "en";}else{$locale = Environment::get('locale');}
//if(strlen($locale>2)){$locale='en';}
// print_r(Environment::get('locale'));
// print_r($locale);
?><h2><?=$t('How it works')?></h2>
<div class="col-sm-12 col-md-12">
<blockquote>
<p>
<ol>
<li><?=$t('First time users need to open a GreenCoinX wallet at')?> <a href="https://xgcwallet.org" target="_blank">www.xgcwallet.org</a>.</li>
<li><?=$t('Upon receipt of your unique KYC number, open a SiiCrypto account.')?></li>
<li><?=$t('To fund your SiiCrypto exchange wallet go to the REGISTER page and open an account, with your KYC number.')?></li>
<li><?=$t('Sign in to your account using 2FA (Two Factor Authorization).')?></li>
<li><?=$t('Fund your SiiCrypto account')?>
<ul>
	<li><?=$t('send GreenCoinX to your account at the master SiiCrypto GreenCoinX wallet through the page')?> <a href="/<?=$locale?>/users/funding/XGC"><?=$t('Funding/XGC')?></a>,  <?=$t('by clicking on XGC on the Dashboard or')?></li>

 <li><?=$t('send Bitcoin to your account at the master SiiCrypto Bitcoin wallet through the page')?> <a href="/<?=$locale?>/users/funding/BTC"><?=$t('Funding/BTC')?></a>,  <?=$t('by clicking on XGC on the Dashboard or')?></li>

 <li><?=$t('send fiat currency to your account at the master SiiCrypto bank account via  a bank wire (details of which are given on our funding fiat page for each currency')?> <a href="/<?=$locale?>/users/funding_fiat/USD"><?=$t('USD')?></a>, <a href="/<?=$locale?>/users/funding_fiat/CAD"><?=$t('CAD')?></a>, <a href="/<?=$locale?>/users/funding_fiat/EUR"><?=$t('EUR')?></a> <?=$t('and')?> <a href="/<?=$locale?>/users/funding_fiat/GBP"><?=$t('GBP')?></a>).</li>
									</ul>
<li><?=$t('To execute a transaction go to the Dashboard page and choose the type of order you wish to place. When executed your SiiCrypto account will be updated.')?></li>
<li><?=$t('To request a withdrawal of fiat currency go to funding fiat page for each currency')?> <a href="/<?=$locale?>/users/funding_fiat/USD"><?=$t('USD')?></a>, <a href="/<?=$locale?>/users/funding_fiat/CAD"><?=$t('CAD')?></a>, <a href="/<?=$locale?>/users/funding_fiat/EUR"><?=$t('EUR')?></a> <?=$t('and')?> <a href="/<?=$locale?>/users/funding_fiat/GBP"><?=$t('GBP')?></a>, <?=$t('by clicking on the currency you require.')?></li>

<li><?=$t('Withdraw from your SiiCrypto account')?> <ul><li><?=$t('withdraw GreenCoinX from your account to your GreenCoinX wallet through the page')?> <a href="/<?=$locale?>/users/funding/XGC"><?=$t('Funding/XGC')?></a>, <?=$t('by clicking on XGC on the Dashboard or')?></li>

         <li><?=$t('withdraw Bitcoin from your account to your Bitcoin wallet through the page')?> <a href="/<?=$locale?>/users/funding/BTC"><?=$t('Funding/BTC')?></a>, <?=$t('by clicking on BTC on the Dashboard or')?></li>

         <li><?=$t('withdraw fiat currency from your account by clicking on the currency you require on the Dashboard.')?></li>
									</ul>
</ol>

</blockquote>


<?=$t('Note: WE CHARGE NO COMMISSION FOR TRADES. Administration fees, to cover the cost of the fiduciary trust where client funds are held, are 0.2% or 1/5th of one percent per transaction. Wire transfers in or out of your fiat currency account. Inbound Wire 25 Euro and Outbound Wire minimum 50 Euro or 0.10% with a maximum of Euro 500.')?>

</div>
<div class="col-sm-12 col-md-12">
<h3><?=$t('Funding')?></h3>
<div class="row">
	<div class="col-md-12">
	<p><?=$t('To wire funds or to withdraw funds, access your Dashboard page and click on the Currency you require. You will then access the Funding page. Please follow the instructions to wire funds to your account or to withdraw funds from your account.')?></p>
<blockquote><strong><?=$t('Deposit and Withdrawal fees')?></strong></p>
<ul><?=$t('Bank charges are as following')?>:
<li><?=$t('Inbound Wire 25 Euro and Outbound Wire minimum 50 Euro or 0.10% with a maximum of Euro 500.')?></li>
</ul>
</blockquote>
	</div>
	
</div>
</div>