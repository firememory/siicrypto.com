<div class="row container-fluid">
<h2>Withdraw <?=$data['data']['Currency']?></h2>
<p>You have requested to withdraw <?=$data['data']['Amount']?> <?=$data['data']['Currency']?> from your SiiCrypto.com account <strong><?=$data['username']?></strong></p>
<a href="/users/sendWithdraw/<?=$data['data']['Reference']?>" class="btn btn-primary">Click here to receive a completed copy of your Withdrawal request by email.</a>
<p>Upon receipt of your withdrawal request, please sign and upload the signed request using the link provided in the email.</p>
Once you upload "<strong>Withdrawal Request Form</strong>", we will send this document for SiiCrypto Approval. Upon approval, we will forward to the bank for wire transfer.</p>


<p>&nbsp;</p>
<a href="/ex/dashboard" class="btn btn-primary">Dashboard</a>
<p>&nbsp;</p>
</div>