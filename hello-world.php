<?php
// A simple web site in Cloud9 that runs through Apache
// Press the 'Run' button on the top to start the web server,
// then click the URL that is emitted to the Output tab of the console

// sample data
include 'product_list.php';
include 'promotion.php';
include 'checkout_basket.php';
include 'state_product.php';

$state = [0 => [Product_Show, Product_CommandShow, Product_CommandProcess]];
$currentState = 0;

echo 'Hello world from Cloud9!'. "\r\n";

do
{
    $curState = $state[$currentState];
    
    // display
    $curState[0]();
    
    // process
    if($input != null && $input != false)
    {
        $curState[2]($input);
        continue;
    }
} while($input = readline("\r\n".$curState[1]().": "))
?>