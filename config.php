<?php

$response = [];
$staus = 'NOK';
require_once('stripe-php-6.30.1/init.php');

if (isset($_POST)) {

    $amount = trim($_POST['Price']);
    $token = trim($_POST['tokenId']);
    $email = trim($_POST['email']);
    
    try {

        // print_r($currency);exit;
        \Stripe\Stripe::setApiKey("sk_test_BthpPuXiQPftLlcaVYEuALYf");

        $charge = \Stripe\Charge::create([
                    'amount' => $amount * 100,
                    'currency' => 'usd',
                    'source' => $token,
                    'receipt_email' => $email,
        ]);

        if ($charge->status == "succeeded") {
            $staus = 'OK';
            $response['status'] = $staus;
        }
    } catch (Exception $ex) {
        $response['status'] = $staus;
        $response['error'] = $ex->getMessage();
    }
    echo json_encode($response);
} 
