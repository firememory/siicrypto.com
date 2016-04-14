<?php
use lithium\util\String;

$sel_curr = $this->_request->params['args'][0];

$first_curr = strtoupper(substr($sel_curr,0,3));
$second_curr = strtoupper(substr($sel_curr,4,3));

$BalanceFirst = $details['balance'][$first_curr];
$$first_curr = $details['balance'][$first_curr];
$BalanceSecond = $details['balance'][$second_curr];
$$second_curr = $details['balance'][$second_curr];
if (is_null($BalanceFirst)){$BalanceFirst = 0;}
if (is_null($BalanceSecond)){$BalanceSecond = 0;}

?>
<div id="User_ID" style="display:none "><?=$details['user_id']?></div>
<?php if(strtolower($this->_request->controller)=='ex'){ 	?>
<div class="row" >
	<div class="col-md-12" style="background-color:#eeeeee;padding:9px;padding-left:30px;margin-bottom:10px;border-bottom:double;margin-top:10px">
	<div class="rates">
		<a class="tooltip-y" data-placement="bottom" title="<?=$t('Latest low price')?>" href="#"><?=$t('Low')?>:<strong><span id="LowPrice" class="btn-success" style="padding:2px;margin-left:5px;padding-left:5px;padding-right:5px"></span></strong></a>
		<a class="tooltip-y" data-placement="bottom" title="<?=$t('Latest high price')?>" href="#"><?=$t('High')?>:<strong><span id="HighPrice" class="btn-danger"  style="padding:2px;margin-left:5px;padding-left:5px;padding-right:5px"></span></strong></a>
		<a class="tooltip-y" data-placement="bottom" title="<?=$t('Latest price')?>" href="#"><?=$t('Last')?>:<strong><span id="LastPrice" class="btn-info"  style="padding:2px;margin-left:5px;padding-left:5px;padding-right:5px"></span></strong></a>
		<a class="tooltip-y" data-placement="bottom" title="<?=$t('Volume')?>" href="#"><?=$t('Vol')?>:<strong><span id="Volume" class="btn-inverse"  style="padding:2px;margin-left:5px;padding-left:5px;padding-right:5px"></span></strong></a>							
		<a class="pull-right "><i class="fa fa-spinner fa-spin"></i> <span id="Timer"></span></a>
	</div>
	</div>
	<div class="col-md-12 alert-danger alert">
		<a href="#" class="" data-toggle="modal" data-target="#myModal" ><?=$t('Help - Information on how to trade')?></a>
	</div>
</div>
	<?php } ?>

<div class="row" >
	<?php 
	$alldocuments = array();
	$i=0;		
	foreach($settings['documents'] as $documents){
		if($documents['required']==true){
				if($documents['alias']==""){
					$name = $documents['name'];
				}else{
					$name = $documents['alias'];
				}
			if(strlen($details[$documents['id'].'.verified'])==0){
					$alldocuments[$documents['id']]="No";
			}elseif($details[$documents['id'].'.verified']=='No'){
					$alldocuments[$documents['id']]="Pending";
			}else{
					$alldocuments[$documents['id']]="Yes";
			}
		}
	}
		$all = true;
		foreach($alldocuments as $key=>$val){						
			if($val!='Yes'){
			$all = false;
			}
		}
	echo $this->_render('element', 'Graph',array(
			'first_curr' => $first_curr,
			'second_curr' => $second_curr,
		));
	if(!$all){
				echo $this->_render('element', 'Buy',array(
				'first_curr' => $first_curr,
				'second_curr' => $second_curr,
				'BalanceFirst' => $BalanceFirst,		
				'BalanceSecond' => $BalanceSecond,
				'details' => $details
			));

	}else{
		if($$second_curr!=0 && $all){ 
			echo $this->_render('element', 'Buy',array(
				'first_curr' => $first_curr,
				'second_curr' => $second_curr,
				'BalanceFirst' => $BalanceFirst,		
				'BalanceSecond' => $BalanceSecond,
				'details' => $details
			));
			}else{
			echo $this->_render('element', 'Verify1',array(
				'first_curr' => $first_curr,
				'second_curr' => $second_curr,
				'details' => $details,		
			));
		}
	}

	if(!$all){
			echo $this->_render('element', 'Sell',array(
			'first_curr' => $first_curr,
			'second_curr' => $second_curr,
			'BalanceFirst' => $BalanceFirst,		
			'BalanceSecond' => $BalanceSecond,
			'details' => $details			
			));
	}else{
		if($$first_curr!=0 && $all){
			echo $this->_render('element', 'Sell',array(
				'first_curr' => $first_curr,
				'second_curr' => $second_curr,
				'BalanceFirst' => $BalanceFirst,		
				'BalanceSecond' => $BalanceSecond,
				'details' => $details			
				));
		 }else{
			echo $this->_render('element', 'Verify2',array(
				'first_curr' => $first_curr,
				'second_curr' => $second_curr,
				'details' => $details,		
			));
		}
	}
	?>
	</div>
	<div class="row">
	<?php
		echo $this->_render('element', 'Orders-Sell',array(
			'first_curr' => $first_curr,
			'second_curr' => $second_curr,
			'TotalSellOrders' => $TotalSellOrders,		
			'SellOrders' => $SellOrders,
			'sel_curr' => $sel_curr,
		));
		echo $this->_render('element', 'Orders-Buy',array(
			'first_curr' => $first_curr,
			'second_curr' => $second_curr,
			'TotalBuyOrders' => $TotalBuyOrders,		
			'BuyOrders' => $BuyOrders,
			'sel_curr' => $sel_curr,
		));
	?>
</div>
<div class="row">
<?php	
	echo $this->_render('element', 'YourOrders',array(
			'first_curr' => $first_curr,
			'second_curr' => $second_curr,
			'YourOrders' => $YourOrders,		
			'sel_curr' => $sel_curr,
		));
		echo $this->_render('element', 'Orders-Complete',array(
			'first_curr' => $first_curr,
			'second_curr' => $second_curr,
			'YourCompleteOrders' => $YourCompleteOrders,		
			'BuyOrders' => $BuyOrders,
			'sel_curr' => $sel_curr,
		));
?>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?=$t('How to trade')?></h4>
      </div>
      <div class="modal-body">
        <h3><?=$t('Buy')?> <?=$first_curr?> <?=$t('with')?> <?=$second_curr?></h3>
								<ul>
									<li><?=$t('Enter Amount')?> <?=$first_curr?>: <?=$t('The amount you enter should be less than your balance of')?> <?=$$second_curr?> <?=$second_curr?></li>
									<li><?=$t('Enter Price per')?> <?=$first_curr?></li>
									<li><?=$t('Click Estimate')?></li>
									<li><?=$t('Submit')?></li>
								</ul>
								<h3><?=$t('Sell')?> <?=$first_curr?> <?=$t('get')?> <?=$second_curr?></h3>
								<ul>
									<li><?=$t('Enter Amount')?> <?=$second_curr?>: <?=$t('The amount you enter should be less than your balance of')?> <?=$$first_curr?> <?=$first_curr?></li>
									<li><?=$t('Enter Price per')?> <?=$second_curr?></li>
									<li><?=$t('Click Estimate')?></li>
									<li><?=$t('Submit')?></li>
								</ul>
								<h3><?=$t('Executing Multiple Orders')?></h3>
								<ul>
									<strong><?=$t('Buy')?> <?=$first_curr?> <?=$t('with')?> <?=$second_curr?></strong>
									<li><?=$t('Select the row from')?> <strong><?=$t('Orders: Sell')?> <?=$first_curr?> > <?=$second_curr?></strong>, <?=$t('click on it, will fill in')?> <strong><?=$t('Buy')?> <?=$first_curr?> <?=$t('with')?> <?=$second_curr?></strong> </li>
									<strong><?=$t('Sell')?> <?=$first_curr?> <?=$t('get')?> <?=$second_curr?></strong>
									<li><?=$t('Select the row from')?> <strong><?=$t('Orders: Buy')?> <?=$first_curr?> < <?=$second_curr?></strong>, <?=$t('click on it, will fill in')?> <strong><?=$t('Sell')?> <?=$first_curr?> <?=$t('get')?> <?=$second_curr?></strong> </li>
									
								</ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?=$t('Close')?></button>
      </div>
    </div>
  </div>
</div>