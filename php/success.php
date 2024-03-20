<script src="https://js.stripe.com/v3/"></script>

<?php
    session_start();
    $user_id = $_SESSION['id'];

    include "../php/dbconnect.php";
    require_once '../vendor/autoload.php';
    require_once '../php/secrets.php';

    $stripe = new \Stripe\StripeClient($stripeSecretKey);

    try {
      $session = $stripe->checkout->sessions->retrieve($_GET['session_id']);
      $session_id = $session->id; // output the session id string
      $customer = $stripe->customers->retrieve($session->customer); // output the multiple choise for customer values
      $membership_plan = $stripe->checkout->sessions->allLineItems($session_id)->data[0]; // output the membership plan
      
      //make sure user with assigned login id is the one to be updated in the database
      if ($user_id){
        echo "<h1>Thanks for your order, $customer->name</h1>";
        //update the customer_id into users table
        $sql = "UPDATE users SET customer_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $customer->id, $user_id);
        if($stmt->execute()){
          //echo "Successfully updating customer id into database";
        }
        else{
          //echo "Error updating customer id into database" . $conn->error;
        }
        $stmt->close();

        //echo "<br><br>";

        //update membership plan into users table
        $sql = "UPDATE users SET membership_plan = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $membership_plan->description, $user_id);
        if($stmt->execute()){
          //echo "Successfully inserting membership plan into database";
        }
        else{
          //echo "Error inserting membership plan into database";
        }
        $stmt->close();

        http_response_code(200);
      }
    } 
    catch (Error $e) {
      http_response_code(500);
      echo json_encode(['error' => $e->getMessage()]);
    }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Thanks for your order!</title>
  <link rel="stylesheet" href="">
</head>
<body>
  <section>
    <div>
      <p>We appreciate your business! If you have any questions, please email</p>
      <a href="mailto:gotravel@gmail.com">gotravel@gmail.com</a>.
      <br>
      <a href="../php/membership.php">Return To Previous Page</a>
  </div>
  </section>
</body>
</html>