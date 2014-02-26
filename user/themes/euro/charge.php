<?php

if ($_POST) {
	require_once('./lib/Stripe.php');
	
	$stripe = array(
		"secret_key"      => "sk_live_CTroOsJmZJJPGEfdQtuf45kh",
		"publishable_key" => "pk_live_d7uVopGCxMtSVQS60zuJtIAF"
	);
	
	try {
		Stripe::setApiKey($stripe['secret_key']);

		$token  = $_POST;

		$customer = Stripe_Customer::create(array(
			'card'  => $token['id'],
			'email' => $token['email'],
			'description' => 'Donated EUR ' . $token['amount'] / 100
		));

		$charge = Stripe_Charge::create(array(
			'customer'		=> $customer->id,
			'amount'		=> $token['amount'],
			'currency'		=> 'eur'
		));

		echo '<p class="successful-payment">Your donation has been successfully accepted. We will send you an email with additional information regarding your reward.<br>Thank you!<br>OneEurope Team</p>';	
	}
	catch (Exception $e) {
		echo '<p class="successful-payment">Your donation has NOT been accepted. Please, try again later.</p>';		
	}
	
}

?>