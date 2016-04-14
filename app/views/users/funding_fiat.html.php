<?php use lithium\core\Environment; 
if(substr(Environment::get('locale'),0,2)=="en"){$locale = "en";}else{$locale = Environment::get('locale');}
//if(strlen($locale>2)){$locale='en';}
// print_r(Environment::get('locale'));
// print_r($locale);
?><?php
use lithium\util\String;
use app\extensions\action\Functions;
$function = new Functions();
?>
<style>
	.Address_success{background-color: #9FFF9F;font-weight:bold}
</style>

<h2 id=tabs-examples><?=$t('Deposit / Withdraw')?> <?=$currency?>
	<?php if($currency=="CAD" || $currency=="GBP"){?>
	<br><small>(<?=$currency?> <?=$t('Deposits will be coming soon. Thank you for your patience while our bank resolves this issue')?>)</small>
	<?php }?>
</h2> 

<div class="" data-example-id=togglable-tabs> 
	<ul id=myTabs class="nav nav-tabs nav-justified" role=tablist> 
	<li role=presentation class="active"><a href=#home id=home-tab role=tab data-toggle=tab aria-controls=home aria-expanded=true style="font-weight:bold;color:#5cb85c"><?=$t('Deposit')?> <?=$currency?></a></li> 
	<li role=presentation><a href=#profile role=tab id=profile-tab data-toggle=tab aria-controls=profile  style="font-weight:bold;color:#d9534f;"><?=$t('Withdraw')?> <?=$currency?></a></li>
	</ul>
	
	<div id=myTabContent class="tab-content"> 
	
		<div role=tabpanel class="tab-pane fade in active tab-content-deposit" id=home aria-labelledby=home-tab> 
	
				<!-- Deposit Tab -->
				<!-- //////////////////////////////////////////////////////////////////////////////////////-->
				<?php if(count($depositRequest)==0){		?>
				<div style="">
				<blockquote><small><strong><?=$t('Note')?>:</strong> <?=$t('Vantu Bank\'s customer service may contact you to authenticate your expected payment. Please make sure the contact details below are valid. If Vantu Bank needs to reach you and is unable to do so within 48 hours your funds may be put on hold. The information you provide must be clear in order to prevent delays.')?></small></blockquote>
				</div>
				<h2><?=$t('Declaration of Source of Funds (DSF)')?></h2>
				<form method="POST" action="/<?=$locale?>/users/deposit" class="form">
					<table class="table table-condensed table-bordered table-hover" >
					<tr>
					<th style="width:50%"><?=$t('FULL NAME OF YOUR ACCOUNT AT VANTU BANK')?>:</th>
					<td>ILS FIDUCIARIES (SWITZERLAND) SARL</td>
					</tr>
					<tr>
					<th><?=$t('FULL ACCOUNT NUMBER OF YOUR ACCOUNT')?>:</th>
					<td>ACC <?=$currency?>-100-070378-<?php
					switch ($currency){
					case "USD":
					print_r("1");break;
					case "EUR":
					print_r("2");break;
					case "GBP":
					print_r("3");break;
					case "CAD":
					print_r("4");break;										
					}
					?>
					</td>
					</tr>
					<tr>
					<th><?=$t('YOUR FULL NAME')?>:</th>
					<td><input type="text" name="fullName" id="fullName" class="form-control"></td>
					</tr>
					<tr>
					<th><?=$t('YOUR TELEPHONE NUMBER')?>:</th>
					<td><input type="text" name="telephone" id="telephone" class="form-control"></td>
					</tr>
					<tr>
					<th><?=$t('YOUR FULL PHYSICAL OR STREET ADDRESS')?>: <br>(<small><?=$t('a PO Box number alone is not accepted')?></small>)</th>
					<td><input type="text" name="address" id="address" class="form-control"></td>
					</tr>
					<tr>
					<th><?=$t('YOUR CITY, STATE, ZIP CODE, COUNTRY')?>:</th>
					<td><input type="text" name="addressDetail" id="addressDetail" class="form-control"></td>
					</tr>
					<tr>
					<th><?=$t('YOUR EMAIL ADDRESS')?>:</th>
					<td><input type="text" class="form-control" name="emailShow" id="emailShow" value="<?=$user['email']?>" disabled>
					<input type="hidden" class="form-control" name="email" id="email" value="<?=$user['email']?>"></td>
					</tr>
					<tr>
					<th><?=$t('YOUR TYPE OF OCCUPATION/BUSINESS')?>:</th>
					<td>
					<select class="form-control" name="occupation" id="occupation">
					<option><?=$t('-- Select --')?></option>
					<option value='<?=$t('Accounting')?>'><?=$t('Accounting')?></option>
					<option value='<?=$t('Architecture')?>'><?=$t('Architecture')?></option>
					<option value='<?=$t('Community and Social Services')?>'><?=$t('Community and Social Services')?></option>
					<option value='<?=$t('Computer and Software')?>'><?=$t('Computer and Software')?></option>
					<option value='<?=$t('Designer')?>'><?=$t('Designer')?></option>
					<option value='<?=$t('Education')?>'><?=$t('Education')?></option>
					<option value='<?=$t('Engineering')?>'><?=$t('Engineering')?></option>
					<option value='<?=$t('Entertainment')?>'><?=$t('Entertainment')?></option>
					<option value='<?=$t('Farming')?>'><?=$t('Farming')?></option>
					<option value='<?=$t('Fishing')?>'><?=$t('Fishing')?></option>
					<option value='<?=$t('Food Industry')?>'><?=$t('Food Industry')?></option>
					<option value='<?=$t('Forestry')?>'><?=$t('Forestry')?></option>
					<option value='<?=$t('General Management')?>'><?=$t('General Management')?></option>
					<option value='<?=$t('Healthcare Services')?>'><?=$t('Healthcare Services')?></option>
					<option value='<?=$t('Installation and Repair')?>'><?=$t('Installation and Repair')?></option>
					<option value='<?=$t('Lawyer')?>'><?=$t('Lawyer')?></option>
					<option value='<?=$t('Manufacturing and Production')?>'><?=$t('Manufacturing and Production')?></option>
					<option value='<?=$t('Media')?>'><?=$t('Media')?></option>
					<option value='<?=$t('Mining and Extraction')?>'><?=$t('Mining and Extraction')?></option>
					<option value='<?=$t('Office and Administrative Support')?>'><?=$t('Office and Administrative Support')?></option>
					<option value='<?=$t('Personal Care and Service')?>'><?=$t('Personal Care and Service')?></option>
					<option value='<?=$t('Physical Scientist')?>'><?=$t('Physical Scientist')?></option>
					<option value='<?=$t('Private Investor')?>'><?=$t('Private Investor')?></option>
					<option value='<?=$t('Property and Construction')?>'><?=$t('Property and Construction')?></option>
					<option value='<?=$t('Property Maintenance')?>'><?=$t('Property Maintenance')?></option>
					<option value='<?=$t('Protective Services')?>'><?=$t('Protective Services')?></option>
					<option value='<?=$t('Retired')?>'><?=$t('Retired')?></option>
					<option value='<?=$t('Sales and Marketing')?>'><?=$t('Sales and Marketing')?></option>
					<option value='<?=$t('Scientist')?>'><?=$t('Scientist')?></option>
					<option value='<?=$t('Self Employed')?>'><?=$t('Self Employed')?></option>
					<option value='<?=$t('Sports')?>'><?=$t('Sports')?></option>
					<option value='<?=$t('Transportation')?>'><?=$t('Transportation')?></option>

					</select>
					</td>
					</tr>
					<?php $Reference = $details['username'].'-'.rand(10000,99999);?>
					<tr>
					<th colspan="2" style="background-color:#CAFFFF"><?=$t('DETAILS OF YOUR INWARD WIRE PAYMENT')?></th>
					</tr>
					<tr>
					<th><?=$t('REFERENCE')?>: (<small><?=$t('Quote this reference number in your deposit')?></small>)</th>
					<td>
					<input type="text" id="ReferenceShow" name="ReferenceShow" value="<?=$Reference?>" disabled  class="form-control">
					<input type="hidden" id="Reference" name="Reference" value="<?=$Reference?>"  class="form-control">
					</td>
					</tr>
					<tr>
					<th><?=$t('CURRENCY')?>:</th>
					<td>
					<input type="text" id="currencyShow" name="currencyShow" value="<?=$currency?>" disabled  class="form-control">
					<input type="hidden" id="currency" name="currency" value="<?=$currency?>"  class="form-control">
					</td>
					</tr>
					<tr>
					<th><?=$t('AMOUNT')?>:</th>
					<td>
					<input type="number" id="amountFiat" name="amountFiat" value="" min="0" step="any" max="999999" class="form-control" onblur="this.value=(this.value).replace(/,/g, '')">
					</td>
					</tr>
					<tr>
					<th colspan="2" style="background-color:#CAFFFF"><?=$t('ORIGINAL SENDING BANK')?></th>
					</tr>
					<tr>
					<th><?=$t('Bank Name')?>:</th>
					<td><input type="text" class="form-control" name="bankName" id="bankName"></td>
					</tr>
					<tr>
					<th><?=$t('Bank Address')?>:</th>
					<td><input type="text" class="form-control" name="bankAddress" id="bankAddress"></td>
					</tr>
					<tr>
					<th><?=$t('SWIFT Code')?>:</th>
					<td><input type="text" class="form-control" name="swiftCode" id="swiftCode"></td>
					</tr>
					<tr>
					<td colspan="2"  style="background-color:#CAFFFF"><strong><?=$t('I declare that the source of this payment is one of the following')?>:</strong>
					<table class="table">
					<tr>
					<td><input type="checkbox" name="sourceEmploymentIncome" id="sourceEmploymentIncome" value="Yes"> <?=$t('Employment Income')?></td>
					<td><input type="checkbox" name="sourceGift" id="sourceGift" value="Yes"> <?=$t('Gift')?></td>
					<td><input type="checkbox" name="sourceGrants" id="sourceGrants" value="Yes"> <?=$t('Grants/Scholarships')?></td>
					</tr>
					<tr>
					<td><input type="checkbox" name="sourceInsurance" id="sourceInsurance" value="Yes"> <?=$t('Insurance Claim Payments')?></td>
					<td><input type="checkbox" name="sourceInvestment" id="sourceInvestment" value="Yes"> <?=$t('Investment Income Savings')?></td>
					<td><input type="checkbox" name="sourcePension" id="sourcePension" value="Yes"> <?=$t('Retirement/Pension Income')?></td>
					</tr>							
					<tr>
					<td><input type="checkbox" name="sourceSale" id="sourceSale" value="Yes"> <?=$t('Sale of Assets')?></td>
					<td><input type="checkbox" name="sourceTrust" id="sourceTrust" value="Yes"> <?=$t('Trust/Inheritance')?></td>
					<td><input type="checkbox" name="sourceLottery" id="sourceLottery" value="Yes"> <?=$t('Lottery Winnings')?></td>
					</tr>							
					<tr>
					<td colspan="3"><input type="checkbox"  name="sourceBusiness" id="sourceBusiness" value="Yes"> <?=$t('Business')?> <small>(<?=$t('If this box is checked you will need to complete the Details of Business Payment section below')?>)</small></td>
					</tr>							
					<tr>
					<td><input type="checkbox" name="sourceOther" id="sourceOther" value="Yes"> <?=$t('Other, please be specific')?>.</td>
					<td colspan="2"><input type="text" class="form-control"  name="Other" id="Other" ></td>
					</tr>							
				</table>
				</td>
				</tr>
				<tr>
				<td colspan="2">
				<table class="table">
				<tr>
				<th colspan="2"><?=$t('DETAILS OF BUSINESS PAYMENT')?><br><small> (<?=$t('Only complete this section if you have checked the Business box above')?>)</small></th>
				</tr>
				<tr>
				<td style="width:50%"><?=$t('WHAT IS THE PRINCIPAL BUSINESS ACTIVITY OF THE ORIGINATING PARTY?')?></td>
				<td><input type="text" class="form-control"  name="Business1" id="Business1" ></td>
				</tr>
				<tr>
				<td><?=$t('WHAT IS THE NATURE OF YOUR BUSINESS RELATIONSHIP WITH THE ORIGINATING PARTY?')?></td>
				<td><input type="text" class="form-control" name="Business2" id="Business2" ></td>
				</tr>
				<tr>
				<td><?=$t('WHAT ARE THE UNDERLYING GOODS OR SERVICES RELATED TO THIS PAYMENT?')?></td>
				<td><input type="text" class="form-control" name="Business3" id="Business3" ></td>
				</tr>
				<tr>
				<td><?=$t('PLEASE ADVISE THE WEBSITE OF THE ORIGINATING PARTY, IF APPLICABLE')?></td>
				<td><input type="text" class="form-control" name="Business4" id="Business4" ></td>
				</tr>
				<tr>
				<td><?=$t('WHAT ARE YOUR EXPECTED MONTHLY PAYMENTS FROM THE ORIGINATING PARTY (number and value)?')?></td>
				<td><input type="text" class="form-control" name="Business5" id="Business5" ></td>
				</tr>
				<tr>
				<td colspan="2"><small><?=$t('If the Details of Business Payment section has been completed then we have attached full supporting documentation for this transaction (e.g. an invoice, a bill, a contract, agreement or similar document).')?></small></td>
				</tr>
				</table>
				</td>
				</tr>
				<tr>
				<td colspan="2">
				<ol>
				<li><input type="checkbox"  name="attached" id="attached" onclick="CheckDepositForm();"> 
				<?=$t('I/We have attached full supporting documentation for this transaction (e.g. an invoice, a bill, a contract, agreement or similar document)')?>.</li>
				<li><input type="checkbox"  name="agree" id="agree"  onclick="CheckDepositForm();"> <?=$t('I/We understand that under the requirements of Vanuatu\'s Anti-Money Laundering & Counter-Terrorism Financing Act No. 13 of 2014, Regulations made thereunder and Vantu Bank\'s and National Bank of Vanuatu\'s respective AML/CTF Compliance Manuals as currently in force, your policy may require both banks to be satisfied as to the source of this payment before accepting any inward wire transfer and that my/our transfer(s) may be held pending or returned in the absence of such confirmation. This payment does not originate from any sanctioned or prohibited country or related sanctioned program.')?></li>
				<li><input type="checkbox"  name="correct" id="correct"  onclick="CheckDepositForm();"> <?=$t('I/We declare that the above information is true and correct.')?></li>
				</ol>
				<div class="alert alert-danger" id="AlertSelect" style="display:none"><?=$t('Check all of the above')?></div>
				</td>
				</tr>
				<tr>
				<td><?=$t('Date')?>: <?=gmdate('Y-M-d H:i:s',time())?></td>
				<td><input type="submit" value="<?=$t('Submit')?>" class="btn btn-primary" disabled name="DepositSubmit" id="DepositSubmit"></td>
				</tr>
				</table>
				</form>
				<!-- //////////////////////////////////////////////////////////////////////////////////////-->
				<?php }else{?>
				<div style=""><blockquote><small><strong><?=$t('Note')?>:</strong> <?=$t('Vantu Bank\'s customer service may contact you to authenticate your expected payment. Please make sure the contact details below are valid. If Vantu Bank needs to reach you and is unable to do so within 48 hours your funds may be put on hold. The purpose for the wire must be made clear in order to prevent delays.')?></small></blockquote></div>
				<?php if($fileupload=="NO"){?>
				<div class="alert alert-danger" role="alert"><?=$t('File not uploaded... Not sent to ILS/Vantu Bank')?></div>
				<h2><?=$t('Deposit request: (DSF)')?></h2>
				<?php }?>
				<?php if($fileupload=="YES"){?>
				<div class="alert alert-success" role="alert"><?=$t('File uploaded... Sent to ILS/Vantu Bank')?></div>
				<h2><?=$t('WIRE TRANSFER INSTRUCTIONS TO BE GIVEN TO YOUR BANK')?></h2>
				<p><?=$t('Please use the information below to send a wire transfer to fund your SiiCrypto account. You can print out this form and give it to your bank, or use this information to complete your bank\'s standard wire instruction form. These instructions have also been sent to your email address.')?></p>
				<?php }?>
				<div>
					<table class="table table-condensed table-bordered table-hover" >
					<tr>
					<th style="width:50%"><?=$t('YOUR FULL NAME')?>:</th>
					<td><?=$depositRequest['data']['fullName']?></td>
					</tr>
					<tr>
					<th><?=$t('YOUR TELEPHONE NUMBER')?>:</th>
					<td><?=$depositRequest['data']['telephone']?></td>
					</tr>
					<tr>
					<th><?=$t('CURRENCY')?>:</th>
					<td><?=$depositRequest['data']['currency']?></td>
					</tr>
					<tr>
					<th><?=$t('AMOUNT')?>:</th>
					<td><?=$depositRequest['data']['amountFiat']?></td>
					</tr>
					<tr>
					<th colspan="2" style="background-color:#CAFFFF"><?=$t('ORIGINAL SENDING BANK')?>:</th>
					</tr>
					<tr>
					<th><?=$t('Bank Name')?>:</th>
					<td><?=$depositRequest['data']['bankName']?></td>
					</tr>
					<tr>
					<th><?=$t('Bank Address')?>:</th>
					<td><?=$depositRequest['data']['bankAddress']?></td>
					</tr>
					<tr>
					<th><?=$t('SWIFT Code')?>:</th>
					<td><?=$depositRequest['data']['swiftCode']?></td>
					</tr>
					<?php if($depositRequest['SenttoBank']!="Yes"){?>
					<tr>
					<th><?=$t('UPLOAD YOUR SIGNED DSF HERE')?>:<br><?=$t('Only upload a PDF file. Locate your DSF file by clicking Select File. Select your DSF File. Then click Upload.')?>
					<p><?=$t('If you want to modify the DSF, please')?> <a href="/<?=$locale?>/users/deleteDepositRequest/<?=$depositRequest['data']['Reference']?>/<?=String::hash($depositRequest['_id'])?>/<?=$depositRequest['data']['currency']?>"><?=$t('Delete this request')?></a> <?=$t('and create a new DSF. Your request will remain open until your funds have been wired and received or until you delete your request.')?> </p>
					</th>
					<td>
					<?=$this->form->create("", array('type' => 'file', 'action'=>'uploadDepositPDF/')); ?>
					<div id="DepositSelect" type="file" ><?=$t('Select file')?>...<br>SiiCrypto-<?=$depositRequest['data']['Reference']?>-<?=gmdate('Y-M-d',time())?>-<?=$depositRequest['Currency']?>-<?=$depositRequest['Amount']?>.pdf</div><br>
					<small><strong><?=$t('CLICK ON LINK ABOVE TO LOCATE YOUR DSF FILE')?></strong></small>
					<input id="DepositInput"  class="hideMe" style="display:none" name="DepositInput" type="file">
					<input type="hidden" name="fileToUpload" id="fileToUpload" value="SiiCrypto-<?=$depositRequest['data']['Reference']?>-<?=gmdate('Y-M-d',time())?>-<?=$depositRequest['Currency']?>-<?=$depositRequest['Amount']?>.pdf">
					<input type="hidden" name="currency" value="<?=$depositRequest['data']['currency']?>">
					<input type="hidden" name="SelectedSourceFile" id="SelectedSourceFile" value="">
					<div id="SelectedFile"><?=$t('No file selected')?>...</div>
					<br>
					<?=$this->form->field('Reference',array('type'=>'hidden','value'=>$depositRequest['data']['Reference'])); ?>
					<?=$this->form->submit('UPLOAD',array('class'=>'btn btn-primary','id'=>'SaveButton','disabled'=>'disabled')); ?>
					<br><strong><?=$t('When you have located and selected your file, click Upload')?></strong>
					<?=$this->form->end(); ?>
					</td>
					</tr>
					<?php }else{?>
					<tr>
					<th colspan="2" style="background-color:#CAFFFF"><?=$t('RECEIVING BANK')?></th>
					</tr>
					<tr>
					<th><?=$t('BANK NAME')?>:</th>
					<th><?=$bank['Bank Name']?></th>
					</tr>
					<tr>
					<th><?=$t('BANK ADDRESS')?>:</th>
					<th><?=$bank['Bank Address']?></th>
					</tr>
					<tr>
					<th><?=$t('SWIFT CODE')?>:</th>
					<th><?=$bank['Bank SWIFT Code']?></th>
					</tr>
					<tr>
					<th><?=$t('Intermediary Bank')?>:</th>
					<th><?=$bank['Intermediary Bank']?></th>
					</tr>
					<tr>
					<th><?=$t('Intermediary Bank SWIFT Code')?>:</th>
					<th><?=$bank['Intermediary Bank SWIFT Code']?></th>
					</tr>


					<tr>
					<th><?=$t('For the Benefit of')?>:</th>
					<th><?=$bank['For the Benefit of']?></th>
					</tr>
					<tr>
					<th><?=$t('Account No')?>:</th>
					<th><?=$bank['Account No']?></th>
					</tr>
					<tr>
					<th><?=$t('SWIFT CODE')?>:</th>
					<th><?=$bank['SWIFT Code']?></th>
					</tr>
					<tr>
					<th><?=$t('For the Further Benefit of')?>:</th>
					<th><?=$bank['For the Further Benefit of']?></th>
					</tr>
					<tr>
					<th><?=$t('Bank Address')?>:</th>
					<th><?=$bank['Further Bank Address']?></th>
					</tr>				
					<tr>
					<th><?=$t('Account No')?>:</th>
					<th><?=$bank['Further Account No']?></th>
					</tr>
					<tr>
					<th><?=$t('Vantu Account Name')?>:</th>
					<th><?=$bank['Vantu Account Name']?></th>
					</tr>
					<tr>
					<th><?=$t('Vantu Account No')?>:</th>
					<td><strong><?=$bank['Vantu Account No']?></strong>
					</td>
					</tr>
					<tr>
					<th colspan="2" style="background-color:#CAFFFF"><?=$t('REFERENCE')?></th>
					</tr>
					<tr>
					<th><?=$t('SiiCrypto Client Name')?>:</th>
					<th><?=$depositRequest['data']['fullName']?></th>
					</tr>
					<tr>
					<th><?=$t('SiiCrypto Client Reference No')?>:</th>
					<th><?=$depositRequest['data']['Reference']?></th>
					</tr>
					<tr>
					<td colspan=2>
					<div style=""><blockquote><small><strong><?=$t('Note')?>:</strong> <?=$t('After you send the funds to Vantu Bank, wait for 3 to 7 working days for the funds to be credited to your SiiCrypto Account. This wire request will remain open until your funds have been received. In the event that funds are not received then you will need to delete the request and the DSF before you can make a new wire transfer.')?> </small></blockquote>

					<p><?=$t('Please')?> <a href="/<?=$locale?>/users/deleteDepositRequest/<?=$depositRequest['data']['Reference']?>/<?=String::hash($depositRequest['_id'])?>/<?=$depositRequest['data']['currency']?>"><?=$t('delete this request')?></a> <?=$t('and create a new DSF')?>.</p>
					</div>
					</td>
					</tr>
					<?php }?>
				</table>			
				</div>
				<?php }?>
				
				<!-- Deposit Tab-->
		</div>	
		<div role=tabpanel class="tab-pane fade tab-content-withdrawal" id=profile aria-labelledby=profile-tab> 
		<!-- //////////////////////////////////////////////////////////////////////////////////////-->
	<?php $Reference = $details['username'].'-'.rand(10000,99999);?>
	<?php if(count($withdrawRequest)==0){	?>
	<div style="">
	<blockquote><small><strong><?=$t('To withdraw funds for your account, please complete the below Withdrawal Request. SiiCrypto will process your request and email you a confirmation. Wiring to your bank may take a few days depending on your bank routing instruction.')?></strong></small></blockquote>
	</div>
	<h2><?=$t('Withdrawal Request')?></h2>
	
	<form method="POST" action="/<?=$locale?>/users/withdraw" class="form">
	<input type="hidden" id="withdrawILSCharges" name="withdrawILSCharges" value="0"  class="form-control">
	<input type="hidden" id="withdrawVantuChargesMin" name="withdrawVantuChargesMin" value="<?=$parameters['withdrawal'][$currency]['min']?>"  class="form-control">
	<input type="hidden" id="withdrawVantuChargesMax" name="withdrawVantuChargesMax" value="<?=$parameters['withdrawal'][$currency]['max']?>"  class="form-control">
	<input type="hidden" id="withdrawVantuCharges" name="withdrawVantuCharges" value="<?=$parameters['withdrawal'][$currency]['min']?>"  class="form-control">
	<input type="hidden" id="withdrawVantuChargesPercent" name="withdrawVantuChargesPercent" value="<?=$parameters['withdrawal'][$currency]['percent']?>"  class="form-control">
	<input type="hidden" id="netWithdrawAmount" name="netWithdrawAmount" value="0"  class="form-control">
		<table class="table table-condensed table-bordered table-hover" >
		<tr>
		<th style="width:50%"><?=$t('BANK ACCOUNT NAME')?>:</th>
		<td>ILS FIDUCIARIES (SWITZERLAND) SARL</td>
		</tr>
		<tr>
		<th><?=$t('BANK ACCOUNT NUMBER')?>:</th>
		<td>ACC <?=$currency?>-100-070378-<?php
		switch ($currency){
		case "USD":
		print_r("1");break;
		case "EUR":
		print_r("2");break;
		case "GBP":
		print_r("3");break;
		case "CAD":
		print_r("4");break;										
		}
		?>
		</td>
		</tr>
		<tr>
		<th><?=$t('SIICRYPTO REFERENCE NO')?>:</th>
		<th><?=$Reference?>
		<input type="hidden" id="withdrawReference" name="withdrawReference" value="<?=$Reference?>"  class="form-control">
		<input type="hidden" id="withdrawCurrency" name="withdrawCurrency" value="<?=$currency?>"  class="form-control">
		<input type="hidden" id="maxWithdraw" name="maxWithdraw" value="<?=$details['balance'][$currency]?>"  class="form-control">
		</th>
		</tr>
		<tr>
		<th><?=$t('YOUR SIICRYPTO ACCOUNT BALANCE')?>:<br><small>(<?=$t('Withdrawal Request should not exceed this amount')?>)</small></th>
		<td><?=number_format($details['balance'][$currency],2)?> <?=$currency?></td>
		</tr>
		<tr>
		<th><?=$t('WITHDRAWAL AMOUNT')?>:</th>
		<td>
		<div class="input-group">
		<input type="number" class="form-control" min="30" max="<?=$details['balance'][$currency]?>" value="" step="0.01" id="withdrawAmount" name="withdrawAmount" onblur="this.value=(this.value).replace(/,/g, '');CalculateWithdrawAmount();" >
		<div class="input-group-addon"><?=$currency?></div>
		</div>
		</td>
		</tr>
		<tr>
		<th><?=$t('FIDUCIARIES	CHARGES DEDUCTED 0.2% (Click box to calculate amount)')?></th>
		<th id="ILSCharges" style="text-align:right">
		</th>
		</tr>
		<tr>
		<th><?=$t('VANTU BANK CHARGES DEDUCTED')?>:</th>
		<th id="VantuCharges" style="text-align:right"><?=$parameters['withdrawal'][$currency]['min']?> <?=$currency?>
		</th>
		</tr>
		<tr>
		<th><?=$t('NET AMOUNT TO BE WIRED TO SIICRYPTO CLIENT')?></th>
		<th id="NewwithdrawAmount" style="text-align:right">

		</th>
		</tr>
		<tr>
		<th colspan="2" style="background-color:#CAFFFF"><?=$t('SIICRYPTO CLIENT\'S RECEIVING BANK ACCOUNT DETAILS')?></th>
		</tr>
		<tr>
		<th><?=$t('SIICRYPTO CLIENT FULL NAME')?>:</th>
		<td><input type="text" class="form-control" value="" onblur="this.value=this.value.toUpperCase();" id="withdrawName" name="withdrawName"></td>
		</tr>
		<tr>
		<th><?=$t('BANK ACCOUNT NUMBER')?>:</th>
		<td><input type="text" class="form-control" value="" onblur="this.value=this.value.toUpperCase();" id="withdrawAccountNumber" name="withdrawAccountNumber"></td>
		</tr>						
		<tr>
		<th><?=$t('BANK NAME')?>:</th>
		<td><input type="text" class="form-control" value="" onblur="this.value=this.value.toUpperCase();" id="withdrawBankName" name="withdrawBankName"></td>
		</tr>
		<tr>
		<th><?=$t('BANK ADDRESS')?>:</th>
		<td><input type="text" class="form-control" value="" onblur="this.value=this.value.toUpperCase();" id="withdrawBankAddress" name="withdrawBankAddress"></td>
		</tr>
		<tr>
		<th><?=$t('BANK SWIFT CODE')?>:</th>
		<td><input type="text" class="form-control" value="" onblur="this.value=this.value.toUpperCase();" id="withdrawSwiftCode" name="withdrawSwiftCode"></td>
		</tr>
		<tr>
		<td colspan="2">
		<ol>
		<li><input type="checkbox"  name="withdrawAgree" id="withdrawAgree" onclick="CheckWithdrawForm();"> 
		<?=$t('I/We confirm that the funds requested to be withdrawn from my SiiCrypto account  will only be transmitted to my/our own bank account. I/We understand that under the requirements of Vanuatu\'s Anti-Money Laundering & Counter-Terrorism Financing Act No. 13 of 2014, Regulations made thereunder and Vantu Bank\'s and National Bank of Vanuatu\'s respective AML/CTF Compliance Manuals as currently in force, your policy may require both banks to be satisfied as to the source of this payment before accepting any outward wire transfer and that my/our transfer(s) may be held pending or returned in the absence of such confirmation.')?></li>
		</ol>
		<div class="alert alert-danger" id="AlertWithdrawSelect" style="display:none"><?=$t('Fill all details and then check the above checkbox')?></div>
		</td>

		</tr>
		<tr>
		<td><?=$t('Date')?>: <?=gmdate('Y-M-d H:i:s',time())?></td>
		<td><input type="submit" value="<?=$t('Submit')?>" class="btn btn-primary" disabled name="WithdrawSubmit" id="WithdrawSubmit"></td>
		</tr>
	</table>
	</form>
	<?php }else{?>
	<div style="">
	<blockquote><small><strong><?=$t('Note')?>:</strong> <?=$t('Upon receipt of your withdrawal request, please sign and upload the signed request using the link provided in the email. Once you upload')?> "<strong><?=$t('Withdrawal Request Form')?></strong>", <?=$t('we will send this document for SiiCrypto Approval. Upon approval, we will forward to the bank for wire transfer.')?></small>
	</blockquote>
	</div>
	<?php if($fileupload=="NO"){?>
	<div class="alert alert-danger" role="alert"><?=$t('File not uploaded... Not sent to ILS/Vantu Bank')?></div>
	<h2><?=$t('Withdrawal Request Form: (WRF)')?></h2>
	<?php }?>
	<?php if($fileupload=="YES"){?>
	<div class="alert alert-success" role="alert"><?=$t('File uploaded... Sent to Admin for approval')?></div>
	<?php }?>
	<div>
			<table class="table table-condensed table-bordered table-hover" >
			<tr>
			<th style="width:50%"><?=$t('YOUR FULL NAME')?>:</th>
			<th><?=$withdrawRequest['data']['AccountName']?></th>
			</tr>
			<tr>
			<th><?=$t('SIICRYPTO REFERENCE NO')?>:</th>
			<th><?=$withdrawRequest['Reference']?></th>
			</tr>
			<tr>
			<th><?=$t('WITHDRAWAL AMOUNT')?>:</th>
			<th><?=number_format($withdrawRequest['Amount'],2)?> <?=$withdrawRequest['Currency']?></th>
			</tr>
			<tr>
			<th><?=$t('VANTU BANK CHARGES')?>:</th>
			<th><?=number_format($withdrawRequest['VantuCharges'],2)?> <?=$withdrawRequest['Currency']?></th>
			</tr>
			<tr>
			<th><?=$t('ILS FIDUCIARIES CHARGES')?>:</th>
			<th><?=number_format($withdrawRequest['ILSCharges'],2)?> <?=$withdrawRequest['Currency']?></th>
			</tr>
			<tr>
			<th><?=$t('NET AMOUNT')?>:</th>
			<th><?=number_format($withdrawRequest['netAmount'],2)?> <?=$withdrawRequest['Currency']?></th>
			</tr>
			<tr>
			<th><?=$t('YOUR BANK ACCOUNT NUMBER')?>:</th>
			<th><?=$withdrawRequest['data']['AccountNumber']?></th>
			</tr>
			<tr>
			<th><?=$t('YOUR BANK NAME')?>:</th>
			<th><?=$withdrawRequest['data']['BankName']?></th>
			</tr>
			<tr>
			<th><?=$t('YOUR BANK ADDRESS')?>:</th>
			<th><?=$withdrawRequest['data']['BankAddress']?></th>
			</tr>
			<tr>
			<th><?=$t('YOUR BANK SWIFT CODE')?>:</th>
			<th><?=$withdrawRequest['data']['SwiftCode']?></th>
			</tr>
			<?php if($withdrawRequest['Uploaded']!="Yes"){?>
			<tr>
			<th><?=$t('UPLOAD YOUR SIGNED WITHDRAWAL REQUEST FORM (WRF) HERE')?>:<br><?=$t('Only upload a PDF file.')?>
			<p><?=$t('If you want to modify the WRF, please')?> <a href="/<?=$locale?>/users/deleteWithdrawRequest/<?=$withdrawRequest['data']['Reference']?>/<?=String::hash($withdrawRequest['_id'])?>/<?=$withdrawRequest['Currency']?>"><?=$t('Delete this request')?></a> <?=$t('and create a new WRF')?>.</p>
			</th>
			<td>
			<?=$this->form->create("", array('type' => 'file', 'action'=>'uploadWithdrawPDF/')); ?>
			<div id="WithdrawSelect" type="file" ><?=$t('Select file')?>...<br>SiiCrypto-Withdraw-<?=$withdrawRequest['Reference']?>-<?=gmdate('Y-M-d',time())?>-<?=$withdrawRequest['Currency']?>-<?=$withdrawRequest['Amount']?>.pdf</div><br>
			<small><strong><?=$t('CLICK ON LINK ABOVE TO LOCATE YOUR WRF FILE')?></strong></small>
			<input id="WithdrawInput"  class="hideMe" style="display:none" name="WithdrawInput" type="file">
			<input type="hidden" name="fileToUploadWithdraw" id="fileToUploadWithdraw" value="SiiCrypto-Withdraw-<?=$withdrawRequest['data']['Reference']?>-<?=gmdate('Y-M-d',time())?>-<?=$withdrawRequest['Currency']?>-<?=$withdrawRequest['Amount']?>.pdf">
			<input type="hidden" name="withdrawCurrency" value="<?=$withdrawRequest['Currency']?>">
			<input type="hidden" name="SelectedSourceFileWithdraw" id="SelectedSourceFileWithdraw" value="">
			<div id="SelectedWithdrawFile"><?=$t('No file selected')?>...</div>
			<br>
			<?=$this->form->field('WithdrawReference',array('type'=>'hidden','value'=>$withdrawRequest['data']['Reference'])); ?>
			<?=$this->form->submit('UPLOAD',array('class'=>'btn btn-primary','id'=>'SaveWithdrawButton','disabled'=>'disabled')); ?>
			<br><strong>PDF file:<br>SiiCrypto-Withdraw-<?=$withdrawRequest['Reference']?>-<?=gmdate('Y-M-d',time())?>-<?=$withdrawRequest['Currency']?>-<?=$withdrawRequest['Amount']?>.pdf </strong>
			<?=$this->form->end(); ?>
			</td>
			</tr>
			<?php }?>
			<?php if($withdrawRequest['SenttoBank']=="Yes"){?>
			<tr>
			<td colspan="2">
			<div class="alert alert-success"><?=$t('Withdrawal Request form is uploaded, approved by Admin and sent to ILS Fiduciaries (SRAL) and Vantu bank for wire transfer of funds')?></div>
			</td>
			</tr>
			<?php }elseif($withdrawRequest['Uploaded']=="No"){
				?>
			<tr>
			<td colspan="2">
			<div class="alert alert-danger"><?=$t('Withdrawal Request form, we are waiting for you to upload the signed document.')?></div>
			</td>
			</tr>
				<?php }else{?>
			<tr>
				<td colspan="2">
					<div class="alert alert-danger"><?=$t('Withdrawal Request form, Uploaded. Waiting for Admin to Approve.')?></div>
				</td>
			</tr>

			<?php	}?>
		</table>
			<!-- Table -->				
	</div> 
	<?php }?>		
	
		</div>

	</div>
</div>
<p>&nbsp;</p>