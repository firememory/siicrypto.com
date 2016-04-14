<?php use lithium\core\Environment; 
if(substr(Environment::get('locale'),0,2)=="en"){$locale = "en";}else{$locale = Environment::get('locale');}
//if(strlen($locale>2)){$locale='en';}
// print_r(Environment::get('locale'));
// print_r($locale);
?><?php
use lithium\g11n\Message;
extract(Message::aliases());
?><!DOCTYPE html>
<html>
<head>
<title><?=COMPANY_NAME?></title>
<style>@font-face {
 font-family: Calibre;
 src: url(https://siicrypto.com/css/calibre-regular.woff);
}
div{
	padding:20px;
	align:auto;
	text-align:center;
	background-color:#eee
}
body{
	font-family: Calibre;
	font-size:20px;
	margin:10px;
}
td{
	padding: 20px 20px 20px 20px;
	text-align:left;
}
a{
text-decoration: none
}
</style>
</head>
<body>
<div style="border-radius: 10px;-webkit-border-radius: 10px;-moz-border-radius: 10px;">
	<div style="background-color:black;border-radius: 10px;-webkit-border-radius: 10px;-moz-border-radius: 10px;">
		<a href="https://siicrypto.com" target="_blank"><img src="https://siicrypto.com/img/logo.png" alt="SiiCrypto.com" text="SiiCrypto.com"/></a>
	</div>
	
	<div>
		<table style="width:95%;	align:auto;	margin:auto;	border:0px;	background-color:white;">
			<tr>
				<th style="	padding: 20px 0 20px 0;	background-color:#ddd; font-size:24px"><?=$t('Deposit')?> <?=$compact['data']['data']['Amount']?> <?=$compact['data']['data']['Currency']?>
				</th>
			</tr>
			<tr>
				<td><h4><?=$t('Hi')?> <?=$compact['data']['data']['username']?>,</h4>
<p><?=$t('You have requested to deposit')?> <?=$compact['data']['data']['data']['amountFiat']?> <?=$compact['data']['data']['Currency']?> <?=$t('to your SiiCrypto.com account')?> <strong><?=$compact['data']['data']['username']?></strong> <?=$t('with Reference No')?>: <strong><?=$compact['data']['data']['Reference']?></strong>. <?=$t('From this deposit there will be deducted Bank Charges of')?> <?=$compact['data']['parameters']['deposit'][$compact['data']['data']['Currency']]['min']?> <?=$compact['data']['data']['Currency']?> <?=$t('and a Fiduciary Fee of')?> <?=$compact['data']['parameters']['deposit'][$compact['data']['data']['Currency']]['percent']?>%.</p>

<p><?=$t('Your Declaration of Source of Funds ("DSF") is attached to this email. Please print it out, sign it, and scan it.')?></p>
<p><?=$t('If the browser you used to connect to SiiCrypto is your primary browser then you can upload the signed DSF to this link')?> <a href="https://siicrypto.com/<?=$locale?>/users/funding_fiat/<?=$compact['data']['data']['Currency']?>" target="_blank"><?=$t('UPLOAD DSF HERE')?></a>.</p>
<p><?=$t('If your primary browser is not the browser you used to connect to SiiCrypto, then copy this link')?><br>
https://siicrypto.com/<?=$locale?>/users/funding_fiat/<?=$compact['data']['data']['Currency']?><br>
<?=$t('and paste it into the browser you are using.  You do not need to close down your open SiiCrypto webpage before pasting this link into your browser.')?></p>

<p><?=$t('If your SiiCrypto webpage has been open for longer than twenty minutes you will have been auto logged out and you will need to login again.')?></p>

<p><?=$t('Once you have uploaded the signed DSF to SiiCrypto using the above links, it will be sent to ILS Fiduciaries (Switzerland) Sarl and Vantu Bank. You will then receive another email providing the wire transfer details and you can then wire transfer the funds using the reference number quoted above.')?></p>

<p><?=$t('Please do not wire the funds until you receive an email confirmation from us.')?></p>
				</td>
			</tr>
			<tr>
				<td>IP: <?=$_SERVER['REMOTE_ADDR'];?><br>
<?=$tor?>
<?=$t('Date and time')?>: <?=gmdate('Y-m-d H:i:s',time())?>
</p></td>
			</tr>
			<tr>
			<td>
			<?=$t('Thanks')?>,<br><?=NOREPLY?>
			</td>
			</tr>
		</table>
	</div>
	<p><?=$t('SiiCrypto is a REALLY safe crypto currency exchange.')?></p>
	<p><a href="https://greencoinx.com">GreenCoinX.com</a> - <a href="https://xgcwallet.org">XGCWallet.org</a> - <a href="https://KYCGlobal.net">KYCGlobal.net</a></p>
	<div style="padding:30px;font-size:10px">
	<p><?=$t('Please do not reply to this email.')?></p>
	<p><?=$t('This email was sent to you as you tried to register on')?> <?=COMPANY_URL?> <?=$t('with the email address.')?>
	<?=$t('If you did not register, then you can delete this email.')?></p>
 <p><?=$t('We do not spam.')?> </p>
	</div>
</div>
</body>
</html>
