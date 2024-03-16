<?php
include "../php/dbconnect.php";
require_once '../vendor/stripe/stripe-php/init.php'; // Adjust the path to the Stripe PHP library
require_once '../php/secrets.php';

// Set your secret key. Remember to switch to your live secret key in production.
\Stripe\Stripe::setApiKey($stripeSecretKey);

$endpoint_secret = "whsec_d0b20243ecfb3f97e34734bf9c7fb245d5fd3cc048ff90c5165b6fc9b5f0539a";
$payload = @file_get_contents('php://input');
$event = null;

try {
    $event = \Stripe\Event::constructFrom(
      json_decode($payload, true)
    );
  } catch(\UnexpectedValueException $e) {
    // Invalid payload
    echo '⚠️  Webhook error while parsing basic request.';
    http_response_code(400);
    exit();
  }
  if ($endpoint_secret) {
    // Only verify the event if there is an endpoint secret defined
    // Otherwise use the basic decoded event
    $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
    try {
      $event = \Stripe\Webhook::constructEvent(
        $payload, $sig_header, $endpoint_secret
      );
    } catch(\Stripe\Exception\SignatureVerificationException $e) {
      // Invalid signature
      echo '⚠️  Webhook error while validating signature.';
      http_response_code(400);
      exit();
    }
  }
  
  // Handle the event based on its type
switch ($stripe_event->type) {
    case 'checkout.session.completed':
        // Extract relevant information from the event
        $session = $stripe_event->data->object;
        $payment_intent_id = $session->payment_intent;
        $customer_id = $session->customer;
        // Retrieve payment intent to get payment amount, product ID, etc.
        $payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);
        // Extract relevant data from payment intent
        $amount = $payment_intent->amount;
        $product_id = $payment_intent->metadata->product_id; // Assuming you set metadata during checkout
        // Now you can retrieve the product details using the product ID
        $product = \Stripe\Product::retrieve($product_id);
        $product_name = $product->name;
        
        // Now you have the product name associated with the subscription
        // Perform database operations to update the user's subscription status
        // Update the users table with the product name in the is_subscribe column
        $user_id = $_SESSION['id']; // Retrieve the user ID based on the customer ID or session
        // Example SQL query to update the user's subscription status
        // Adjust this query based on your actual table structure
        $sql = "UPDATE users SET is_subscribed = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $product_name, $user_id);
        $stmt->execute();
        // Close the prepared statement
        $stmt->close();
        // Close the database connection
        $conn->close();
        break;
    // Handle other event types as needed
    default:
        // Unexpected event type
        http_response_code(400); // Bad request
        exit();
}


?>
