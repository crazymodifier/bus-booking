<?php include('Crypto.php')?>
<?php require_once "config.php"; ?>
<?php

	error_reporting(1);

	$merchant_data='';
	$working_key = '1343ECAAB02A6AFAC46B515260B3064D';
	$access_code = 'AVJB87GI77BH35BJHB';

	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}
	//$merchant_data .= "order_id=".$orderId;
print_r($_POST);exit;
	$encrypted_data=encrypt($merchant_data,$working_key); 
	
	//$url='https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
	$url='https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;

	//echo $url;
?>
<iframe src="<?php echo $url?>" id="paymentFrame" width="482" height="630" frameborder="0" scrolling="No" ></iframe>