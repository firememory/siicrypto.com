<div style="background-color:#eeeeee;height:50px;padding-left:20px;padding-top:10px">
	<img src="https://<?=COMPANY_URL?>/img/<?=COMPANY_URL?>.gif" alt="<?=COMPANY_URL?>">
</div>
<h4>Hi <?=$user['firstname']?>,</h4>
<p>Your deposit has been approved by <?=COMPANY_URL?>. Please make a deposit now as per the details below. We will credit your account at <?=COMPANY_URL?> when your wire transfer has cleared.</p>
<p>We always recommend taking a screenshot/scanned receipt of your deposit, which can be sent to support@<?=COMPANY_URL?> if any issues arise.</p>

	<h4>To send Fiat (paper/cash currency) you wire transfer funds as follows</h4>

	 <h3><?=$Transactions['Currency']?></h3>
			<p><strong><?=$bank['Bank Name']?></strong><br>
			<?=$bank['Bank Address']?><br>
			SWIFT:<?=$bank['Bank SWIFT Code']?><br></p>
			
			<p>Intermediary Bank: <?=$bank['Intermediary Bank']?><br>
			Intermediary Bank SWIFT Code: <?=$bank['Intermediary Bank SWIFT Code']?>

			<p>For the Benefit of: <?=$bank['For the Benefit of']?><br>
	Account No: <?=$bank['Account No']?><br>
	SWIFT: <?=$bank['SWIFT Code']?><br></p>

<p>For the Further Benefit of : <?=$bank['For the Further Benefit of']?><br>
<?=$bank['Further Bank Address']?><br>
Account No: <?=$bank['Further Account No']?><br></p>

<p>Vantu Account Name: <?=$bank['Vantu Account Name']?><br>
Account No: <?=$bank['Vantu Account No']?>


<p>For Benefit of Account Name and No:<br>
ILS/SiiCrypto:  ____________________<br>
Reference:<br>


<table>
		<tr>
			<td>UserName:</td>
			<td><strong><?=$Transactions['username']?></strong></td>
		</tr>
		<tr>
			<td>Reference:</td>
			<td><strong><?=$Transactions['Reference']?></strong></td>
		</tr>
		<tr>
			<td>Amount:</td>
			<td><?=$Transactions['Amount']?></td>
		</tr>
		<tr>
			<td>Currency:</td>
			<td><?=$Transactions['Currency']?></td>
		</tr>		
</table>

<blockquote><strong>Deposit and Withdrawal fees</strong></p>
<ul>Bank charges are as following:
<li>Inbound Wire 25 Euro and Outbound Wire minimum 50 Euro or 0.10% with a maximum of Euro 500.</li>
</ul>
</blockquote>


<p>Thanks,<br>
<?=NOREPLY?></p>

<p>P.S. Please do not reply to this email. </p>
<p>If you did not initiate this action please contact SiiCrypto.com as soon as possible via support@SiiCrypto.com.</p>
<p>We do not spam. </p>