<?php

require_once '../vendor/autoload.php';
require_once '../php/secrets.php';

\Stripe\Stripe::setApiKey($stripeSecretKey);

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/gotravel/php/success.php",
    "cancel_url" => "http://localhost/gotravel/php/cancel.php",
    "payment_method_types" => ['card'],
    "mode" => "subscription",
    "line_items" => [
        [
            'price' => 'price_1Ov17AK2XupZuyoV5eexoVUH',
            'quantity' => 1,
        ],
    ],
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);