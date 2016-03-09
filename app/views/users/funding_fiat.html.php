<style>
.Address_success{background-color: #9FFF9F;font-weight:bold}
</style>
<?php // echo $this->_render('element', 'funding_fiat_header');?>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-success">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
<strong>Deposit <?=$currencyName?> - <?=$currency?></strong>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
						<div style="padding:10px"><blockquote><small><strong>Note:</strong> Vantu Bank’s customer service may contact you to authenticate your expected payment. Please make sure the contact details below are valid. If Vantu Bank needs to reach you and is unable to do so within 48 hours your funds may be put on hold. The purpose for the wire must be made clear in order to prevent delays.</small></blockquote></div>
						<h2>Declaration of Source of Funds (DSF)</h2>
						<form method="POST" action="/users/deposit" class="form">
						<table class="table table-condensed table-bordered table-hover">
						<tr>
							<th width="50%">FULL NAME OF YOUR ACCOUNT AT VANTU BANK</th>
							<td>ILS FIDUCIARIES (SWITZERLAND) SARL</td>
						</tr>
						<tr>
							<th>FULL ACCOUNT NUMBER OF YOUR ACCOUNT</th>
							<td>100-070378-<strong><?php
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
							?></strong>
							</td>
						</tr>
						<tr>
							<th>YOUR FULL NAME</th>
							<td><input type="text" name="fullName" id="fullName" class="form-control"></td>
						</tr>
						<tr>
							<th>YOUR TELEPHONE NAME</th>
							<td><input type="text" name="telephone" id="telephone" class="form-control"></td>
						</tr>
						<tr>
							<th>YOUR FULL PHYSICAL OR STREET ADDRESS <br>(<small>a PO Box number alone is not accepted</small>)</th>
							<td><input type="text" name="address" id="address" class="form-control"></td>
						</tr>
						<tr>
							<th>YOUR CITY, STATE, ZIP Code, COUNTRY</th>
							<td><input type="text" name="addressDetail" id="addressDetail" class="form-control"></td>
						</tr>


						<tr>
							<th>YOUR EMAIL ADDRESS</th>
							<td><input type="text" class="form-control" name="emailShow" id="emailShow" value="<?=$user['email']?>" disabled>
							<input type="hidden" class="form-control" name="email" id="email" value="<?=$user['email']?>"></td>
						</tr>
						<tr>
							<th>YOUR TYPE OF OCCUPATION/BUSINESS</th>
							<td>
								<select class="form-control" name="occupation" id="occupation">
									<option>-- Select --</option>
									<option value='Accounting'>Accounting</option>
<option value='Architecture'>Architecture</option>
<option value='Community and Social Services'>Community and Social Services</option>
<option value='Computer and Software'>Computer and Software</option>
<option value='Designer'>Designer</option>
<option value='Education'>Education</option>
<option value='Engineering'>Engineering</option>
<option value='Entertainment'>Entertainment</option>
<option value='Farming'>Farming</option>
<option value='Fishing'>Fishing</option>
<option value='Food Industry'>Food Industry</option>
<option value='Forestry'>Forestry</option>
<option value='General Management'>General Management</option>
<option value='Healthcare Services'>Healthcare Services</option>
<option value='Installation and Repair'>Installation and Repair</option>
<option value='Lawyer'>Lawyer</option>
<option value='Manufacturing and Production'>Manufacturing and Production</option>
<option value='Media'>Media</option>
<option value='Mining and Extraction'>Mining and Extraction</option>
<option value='Office and Administrative Support'>Office and Administrative Support</option>
<option value='Personal Care and Service'>Personal Care and Service</option>
<option value='Physical Scientist'>Physical Scientist</option>
<option value='Private Investor'>Private Investor</option>
<option value='Property and Construction'>Property and Construction</option>
<option value='Property Maintenance'>Property Maintenance</option>
<option value='Protective Services'>Protective Services</option>
<option value='Retired'>Retired</option>
<option value='Sales and Marketing'>Sales and Marketing</option>
<option value='Scientist'>Scientist</option>
<option value='Self Employed'>Self Employed</option>
<option value='Sports'>Sports</option>
<option value='Transportation'>Transportation</option>

								</select>
							</td>
						</tr>
						
						<?php $Reference = substr($details['username'],0,10).rand(10000,99999);?>
					<tr>
					<th colspan="2" style="background-color:#CAFFFF">DETAILS OF YOUR INWARD WIRE PAYMENT</th>
					</tr>
				
						<tr>
							<th>REFERENCE (<small>Quote this reference number in your deposit</small>)</th>
							<td>
								<input type="text" id="ReferenceShow" name="ReferenceShow" value="<?=$Reference?>" disabled  class="form-control">
								<input type="hidden" id="Reference" name="Reference" value="<?=$Reference?>"  class="form-control">
							</td>
						</tr>
						<tr>
							<th>CURRENCY</th>
							<td>
								<input type="text" id="currencyShow" name="currencyShow" value="<?=$currency?>" disabled  class="form-control">
								<input type="hidden" id="currency" name="currency" value="<?=$currency?>"  class="form-control">
							</td>
						</tr>
						<tr>
							<th>AMOUNT</th>
							<td>
								<input type="text" id="amountFiat" name="amountFiat" value="" class="form-control">
							</td>
						</tr>
						<tr>
							<th colspan="2" style="background-color:#CAFFFF">ORIGINAL SENDING BANK</th>
						</tr>
						<tr>
							<th>Bank Name</th>
							<td><input type="text" class="form-control" name="bankName" id="bankName"></td>
						</tr>
						<tr>
							<th>Bank Address</th>
							<td><input type="text" class="form-control" name="bankAddress" id="bankAddress"></td>
						</tr>
						<tr>
							<th>SWIFT Code</th>
							<td><input type="text" class="form-control" name="swiftCode" id="swiftCode"></td>
						</tr>
						<tr>
							<td colspan="2"  style="background-color:#CAFFFF"><strong>I declare that the source of this payment is one of the following:</strong>
							<table class="table">
								<tr>
									<td><input type="checkbox" name="sourceEmploymentIncome" id="sourceEmploymentIncome" value="Yes"> Employment Income</td>
									<td><input type="checkbox" name="sourceGift" id="sourceGift" value="Yes"> Gift</td>
									<td><input type="checkbox" name="sourceGrants" id="sourceGrants" value="Yes"> Grants/Scholarships</td>
								</tr>
								<tr>
									<td><input type="checkbox" name="sourceInsurance" id="sourceInsurance" value="Yes"> Insurance Claim Payments</td>
									<td><input type="checkbox" name="sourceInvestment" id="sourceInvestment" value="Yes"> Investment Income Savings</td>
									<td><input type="checkbox" name="sourcePension" id="sourcePension" value="Yes"> Retirement/Pension Income</td>
								</tr>							
								<tr>
									<td><input type="checkbox" name="sourceSale" id="sourceSale" value="Yes"> Sale of Assets</td>
									<td><input type="checkbox" name="sourceTrust" id="sourceTrust" value="Yes"> Trust/Inheritance</td>
									<td><input type="checkbox" name="sourceLottery" id="sourceLottery" value="Yes"> Lottery Winnings</td>
								</tr>							
								<tr>
									<td colspan="3"><input type="checkbox"  name="sourceBusiness" id="sourceBusiness" value="Yes"> Business <small>(If this box is checked you will need to complete the Details of Business Payment section below)</small></td>
								</tr>							
								<tr>
									<td><input type="checkbox" name="sourceOther" id="sourceOther" value="Yes"> Other, please be specific.</td>
									<td colspan="2"><input type="text" class="form-control"  name="Other" id="Other" ></td>
								</tr>							
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table class="table">
									<tr>
										<th colspan="2">DETAILS OF BUSINESS PAYMENT</th>
									</tr>
									<tr>
										<td width="50%">WHAT IS THE PRINCIPAL BUSINESS ACTIVITY OF THE ORIGINATING PARTY?</td>
										<td><input type="text" class="form-control"  name="Business1" id="Business1" ></td>
									</tr>
									<tr>
										<td>WHAT IS THE NATURE OF YOUR BUSINESS RELATIONSHIP WITH THE ORIGINATING PARTY?</td>
										<td><input type="text" class="form-control" name="Business2" id="Business2" ></td>
									</tr>
									<tr>
										<td>WHAT ARE THE UNDERLYING GOODS OR SERVICES RELATED TO THIS PAYMENT?</td>
										<td><input type="text" class="form-control" name="Business3" id="Business3" ></td>
									</tr>
									<tr>
										<td>PLEASE ADVISE THE WEBSITE OF THE ORIGINATING PARTY, IF APPLICABLE</td>
										<td><input type="text" class="form-control" name="Business4" id="Business4" ></td>
									</tr>
									<tr>
										<td>WHAT ARE YOUR EXPECTED MONTHLY PAYMENTS FROM THE ORIGINATING PARTY (number and value)?</td>
										<td><input type="text" class="form-control" name="Business5" id="Business5" ></td>
									</tr>
									<tr>
									<td colspan="2"><small>If the Details of Business Payment section has been completed then we have attached full supporting documentation for this transaction (e.g. an invoice, a bill, a contract, agreement or similar document).</small></td>
									</tr>
									</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
							<ol>
								<li><input type="checkbox"  name="attached" id="attached" onclick="CheckDepositForm();"> 
								I/We have attached full supporting documentation for this transaction (e.g. an invoice, a bill, a contract, agreement or similar document).</li>
								<li><input type="checkbox"  name="agree" id="agree"  onclick="CheckDepositForm();"> I/We understand that under the requirements of Vanuatu’s Anti-Money Laundering & Counter-Terrorism Financing Act No. 13 of 2014, Regulations made thereunder and Vantu Bank’s and National Bank of Vanuatu’s respective AML/CTF Compliance Manuals as currently in force, your policy may require both banks to be satisfied as to the source of this payment before accepting any inward wire transfer and that my/our transfer(s) may be held pending or returned in the absence of such confirmation. This payment does not originate from any sanctioned or prohibited country or related sanctioned program.</li>
								<li><input type="checkbox"  name="correct" id="correct"  onclick="CheckDepositForm();"> I/We declare that the above information is true and correct.</li>
							</ol>
							<div class="alert alert-danger" id="AlertSelect" style="display:none">Check all of the above</div>
							</td>
						</tr>
						<tr>
							<td>Date: <?=gmdate('Y-M-d H:i:s',time())?></td>
							<td><input type="submit" value="Submit" class="btn btn-primary" disabled name="DepositSubmit" id="DepositSubmit"></td>
						</tr>
					</table>
				</form>
      </div>
    </div>
  </div>
  <div class="panel panel-danger">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <strong>Withdraw <?=$currencyName?> - <?=$currency?></strong>
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">

					
						
      </div>
    </div>
  </div>
</div>