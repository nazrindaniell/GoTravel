<?php

require_once '../vendor/autoload.php';
require_once '../php/secrets.php';

\Stripe\Stripe::setApiKey($stripeSecretKey);

$session = \Stripe\Checkout\Session::create([
    "success_url" => "http://localhost/gotravel/php/success.php?session_id={CHECKOUT_SESSION_ID}",
    "cancel_url" => "http://localhost/gotravel/php/cancel.php",
    "payment_method_types" => ['card'],
    "mode" => "subscription",
    "line_items" => [
        [
            'price' => 'price_1OvO7GK2XupZuyoVXyH1wJqn',
            'quantity' => 1,
        ],
    ],
]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe("pk_test_51Ov0X0K2XupZuyoVIbsl6ohJrX38jTqWX3Ecai2kCnuhpwonIKD61eUHbCPJeF7avtzGm8KvxsLRnufvEBg5nDMQ00ZY9zOFmn");
        var sessionId = "<?php echo $session['id'];?>";
        stripe.redirectToCheckout({
            sessionId: sessionId,
        }).then(function(result){

        });
    </script>
</body>
</html>

