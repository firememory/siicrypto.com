<div class="row container-fluid">
<h2>Deposit <?=$data['data']['currency']?></h2>
<p>You have requested to deposit <?=$data['data']['amountFiat']?> <?=$data['data']['currency']?> to your SiiCrypto.com account <strong><?=$data['username']?></strong></p>
<!--<p>Click to download the PDF directly from here <a href="/vanity/out/SiiCrypto-<?=$data['data']['Reference']?>.pdf" target="_blank">SiiCrypto-<?=$data['data']['Reference']?>.pdf</a></p>-->
<a href="/users/sendDeposit/<?=$data['data']['Reference']?>" class="btn btn-primary">Click here to receive a completed copy of your DSF by email.</a>
<p>Upon receipt of your DSF, please sign and upload the signed DSF using the link provided in the email.</p>
Once you upload "<strong>Declaration of Source of Funds (DSF)</strong>", we will send this document for SiiCrypto Approval. Upon approval, you can send the funds to the account.</p>

<p>&nbsp;</p>
<a href="/ex/dashboard" class="btn btn-primary">Dashboard</a>
<p>&nbsp;</p>
</div>