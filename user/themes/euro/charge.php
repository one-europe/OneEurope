<?php

if ($_POST) {
	require_once('./lib/Stripe.php');
	
	$stripe = array(
		"secret_key"      => "sk_test_C0J7bbsVhtfCzWkQ9r4uQFtD",
		"publishable_key" => "pk_test_XaplsFD7NLA1u19mjKVM1r6Q"
	);
	
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

?>