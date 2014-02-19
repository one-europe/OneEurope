<?php
  require_once(HABARI_PATH . '/user/themes/euro/lib/Stripe.php');
  $stripe = array(
    "secret_key"      => "sk_test_C0J7bbsVhtfCzWkQ9r4uQFtD",
    "publishable_key" => "pk_test_XaplsFD7NLA1u19mjKVM1r6Q"
  );
  Stripe::setApiKey($stripe['secret_key']);
?>