
<?php

if (session_id() === "") {
    session_start();
}
    ?>



    <?php

    //$arr = json_decode(file_get_contents("php://input"));
    /** get orders */
    /*
    $orders = simplexml_load_file('htaccess/orders.xml');
    $newOrder = $orders->addChild('order');
    $delivery = $newOrder->addChild('delivery');
    /*if ($_SESSION['authenticatedUser']){
    $delivery->addChild('user', $_SESSION['authenticatedUser']);}*/
/*
    $delivery->addChild('first_name', $_SESSION['First_name']);
    $delivery->addChild('email', $_SESSION['Email']);
    $delivery->addChild('address', $_SESSION['Address1']);
    $delivery->addChild('city', $_SESSION['City']);
    $delivery->addChild('postcode', $_SESSION['Postcode']);
    $items = $newOrder->addChild('items');

    $item = $items->addChild('item');
    $item->addChild('title', 'BITEHELP');
    $item->addChild('quantity', $quantity);
    $item->addChild('total_cost', $totalCost);

    
    $orders->saveXML('htaccess/orders.xml');
    //echo"success";
    //echo"processCartContents";
    //print_r($priceSum);

*/
$quantity = $_SESSION['quantity-selector'];

    $priceSum = $totalCost;
    ?>


<?php
include("submit.php"); ?>