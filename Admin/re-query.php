<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/b10ee527f33e478594b0688fadcab7f8/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:b6337bf77bdbb61446211089a958f8d3",
                  "X-Auth-Token:03f7b088d00d9527795299da04459b2b"));
$response = curl_exec($ch);

curl_close($ch); 

echo $response;

$x = json_decode($response);

$payment_id = $x->payment_request->payments[0]->payment_id;

$status = $x->payment_request->payments[0]->status;

echo $status;

?>