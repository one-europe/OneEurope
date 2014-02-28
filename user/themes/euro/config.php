<?php
  require_once(HABARI_PATH . '/user/themes/euro/lib/Stripe.php');
  $stripe = array(
    "secret_key"      => "sk_live_CTroOsJmZJJPGEfdQtuf45kh",
    "publishable_key" => "pk_live_d7uVopGCxMtSVQS60zuJtIAF"
  );
  Stripe::setApiKey($stripe['secret_key']);
?>