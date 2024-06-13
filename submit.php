<?php

if (session_id() === "") {
    session_start();
}
?>

<?php
//$time_pre = microtime(true);
?>


<?php

$quantity = $_SESSION['quantity-selector'];

$priceSum = $totalCost;
/*
if (!$priceSum) {
    echo "<h4>Order Already Submitted</h4>";
    echo "<script>window.location.href='shop.php';</script>";
    exit;
}
*/

//print_r('hi g this is submit.php ');
//check whether stripe token is not empty
if(!empty($_SESSION['stripeToken'])){
    //print_r("theres a token");
    //get token, card and user info from the form
    $token  = $_SESSION['stripeToken'];


    //UPDATE : can avoid this because already set in validateCheckout
    $first_name = $_SESSION['First_name'];
    $last_name = $_SESSION['Last_name'];
    $email = $_SESSION['Email'];
    $phone = $_SESSION['Phone'];
    $address = $_SESSION['Address'];
    $city = $_SESSION['City'];
    $region = $_SESSION['Region/State'];
    $postcode = $_SESSION['Postal_code'];

        /*
    $card_num = $_SESSION['card_num'];
    $card_name = $_SESSION['card_name'];
    $card_cvc = $_SESSION['cvc'];
    $card_exp_month = $_SESSION['exp_month'];
    $card_exp_year = $_SESSION['exp_year'];
        */

    //include Stripe PHP library
    require_once("stripe-php/init.php");
    //set api key
    $stripeKeys = array(
      "secret_key"      =>                                      "sk_test_51K3FIuE3QizePBpfyEYIPLUGt4kqRbUevD9RIEd90UEt3kfEfEFtkaaaHxviH9bUD6dcdjiMs2FlyWLZYUm8cvvP00sUxEkJaN",
      "publishable_key" =>                                      "pk_test_51K3FIuE3QizePBpf0DwNYsjqAhY6Y2NvKLarC75WS3mzNU4rkpoFnMhzyEaFfCcAk31NIEFap3xBDCDX4rP9nU0P00dXSf5sb7"
    );

    \Stripe\Stripe::setApiKey($stripeKeys['secret_key']);


   $stripe = new \Stripe\StripeClient(
        $stripeKeys['secret_key']
    );


    $priceDollars = intval($priceSum);
    $priceCents = $priceSum - $priceDollars;
    $priceCents = round($priceCents, 2);
    $priceCents = substr((string)$priceCents, 2);
    //print_r("$priceDollars and $priceCents");
    $priceDollars=(string)$priceDollars;
    $priceCents=(string)$priceCents;
    $price = $priceDollars.$priceCents;
    $price = (int)$price;



$charge = \Stripe\Charge::create([
  'amount' => $price,
  'currency' => 'aud',
  'description' => "Bite Help charge {
  Name: $first_name $last_name,
  Email: $email
  }",
  'source' => $token,
]);





//echo "<script>window.location.href='orderConfirmation.php';</script>";



    //check payment status
    //include("webhook.php");



    //check whether the charge is successful
    if($charge['amount_refunded'] == 0 && empty($charge
['failure_code']) && $charge['paid'] == 1 && $charge['captured'] == 1){



        echo"<h2>Transaction successful</h2>";
        $statusMsg = "<h2>Transaction Successful.</h2>
        <h3>Amount Paid = ".'$'."$priceSum AUD</h3>";


        //$setTimeBefore = microtime(true);

        //include("sendOrderToMe.php");


        //$setTimeAfter = microtime(true);

 ///
        //order details
        $amount = $charge['amount'];
        $txn_id = $charge['balance_transaction'];
        $currency = $charge['currency'];
        $status = $charge['status'];
        $date = date("Y-m-d H:i:s");


        $itemName = "BITEHELP";


        $itemPrice = $price / $quantity;

        //include database config file
        include_once("htaccess/databaseconnect.php");

        //insert tansaction data into the database
        $sql =
        "
            INSERT INTO orders (first_name, last_name, email, phone, 
            address, city, region, postcode, item_name, item_price, 
            currency, quantity, paid_amount, txn_id, created, modified)
            VALUES ('$first_name', '$last_name', '$email', '$phone',
             '$address', '$city', '$region', $postcode, '$itemName', 
             $itemPrice, '$currency', $quantity, $amount, '$txn_id', NOW(), NOW());
        ";

        $insert = $conn->query($sql);
        //$last_insert_id = $conn->insert_id;

        if($insert === TRUE){
            echo "";
            //echo "Successfully inserted into database";
        } else {
            //echo  "Error: " . $conn->error;
            $db_message = "<p>There was an error inserting into database, please contact us and quote this transaction id:</p><p>$txn_id</p>";
        }

/*
        //if order inserted successfully
        if($last_insert_id){

            echo"<h4>Order ID: {$last_insert_id}</h4>";
        }else{
            $statusMsg .= "<h4>Error inserting into database</h4>";
        }
*/



        //Prevent repeat attempts
        unset($priceSum);

        $_SESSION['order-email'] = $email;
        $_SESSION['order-name'] = $first_name;
        echo "<script>window.location.href='orderConfirmation.php';</script>";

    }else{
        $statusMsg = "Transaction has failed";
        echo "<script>window.location.href='issue-with-order.php';</script>";
    }
}else{
    $statusMsg = "Form submission error.......";
    echo "<script>window.location.href='issue-with-order.php';</script>";
}

/*
$time_post = microtime(true);
$exec_time = $time_post - $time_pre;
$_SESSION['time'] = $exec_time;
*/

//$setTime = $setTimeAfter-$setTimeBefore;

//$_SESSION['setTime'] = $setTime;


$_SESSION['statusMsg'] = $statusMsg;




?>