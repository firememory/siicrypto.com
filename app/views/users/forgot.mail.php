<?php use lithium\core\Environment; 
if(substr(Environment::get('locale'),0,2)=="en"){$locale = "en";}else{$locale = Environment::get('locale');}
//if(strlen($locale>2)){$locale='en';}
// print_r(Environment::get('locale'));
// print_r($locale);
?>
<?php
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
				<th style="	padding: 20px 0 20px 0;	background-color:#ddd; font-size:24px"><?=$t('Confirm Your Email address')?>
				</th>
			</tr>
			<tr>
				<td><h4><?=$t('Hi')?> <?=$name?>,</h4>
<p><?=$t('Please click on this link to change the password!')?></p>
<p><a href="https://<?=$_SERVER['HTTP_HOST'];?>/<?=$locale?>/users/changepassword/<?=$key?>">https://<?=$_SERVER['HTTP_HOST'];?>/<?=$locale?>/users/changepassword/<?=$key?></a></p>
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
	<p><?=$t('SiiCrypto is a REALLY safe crypto currency exchange')?>.</p>
	<p><a href="https://greencoinx.com">GreenCoinX.com</a> - <a href="https://xgcwallet.org">XGCWallet.org</a> - <a href="https://KYCGlobal.net">KYCGlobal.net</a></p>
	<div style="padding:30px;font-size:10px">
	<p><?=$t('Please do not reply to this email.')?> </p>
	<p><?=$t('This email was sent to you as you tried to register on')?> <?=COMPANY_URL?> <?=$t('with the email address.')?> 
	<?=$t('If you did not register, then you can delete this email.')?></p>
<p><?=$t('We do not spam.')?> </p>
	</div>
</div>
</body>
</html>
