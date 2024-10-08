<?php include('Crypto.php')?>
<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
	$workingKey='1343ECAAB02A6AFAC46B515260B3064D';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	echo "<center>";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
	}

	if($order_status==="Success")
	{
		echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
		echo '<script>setTimeout(function () {window.location.href= "http://hop-on-hop-off-barcelona.com/Checkout/payment/success?'.$rcvdString.'"},3000);</script>';
	}
	else if($order_status==="Aborted")
	{
		echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
		echo '<script>setTimeout(function () {window.location.href= "http://hop-on-hop-off-barcelona.com/Checkout/payment/aborted?'.$rcvdString.'"},3000);</script>';
	
	}
	else if($order_status==="Failure")
	{
		echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
		echo '<script>setTimeout(function () {window.location.href= "http://hop-on-hop-off-barcelona.com/Checkout/payment/failed?'.$rcvdString.'"},3000);</script>';
		
	}
	else
	{
		echo "<br>Security Error. Illegal access detected";
	    echo '<script>setTimeout(function () {window.location.href= "http://hop-on-hop-off-barcelona.com/checkout"},3000);</script>';
	}

	echo "<br><br>";

// 	echo "<table cellspacing=4 cellpadding=4>";
// 	for($i = 0; $i < $dataSize; $i++) 
// 	{
// 		$information=explode('=',$decryptValues[$i]);
// 	    	echo '<tr><td>'.$information[0].'</td><td>'.@$information[1].'</td></tr>';
// 	}

// 	echo "</table><br>";
	echo "</center>";
// 	var_dump($decryptValues);
?>
