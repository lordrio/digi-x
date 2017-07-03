<?php
function Product_Show()
{
    global $product;
    $keys = array_keys($product);
    foreach($keys as $i)
    {
        $item = $product[$i];
        if($item[2]) continue; // dont show promo item
        echo sprintf("SKU: $i || Name: $item[0] || Price: $%0.2f\r\n", $item[1]);
    }
}

function Product_CommandShow()
{
    return "cmd add <sku> || remove <sku> || checkout";
}

function Product_CommandProcess($proc)
{
    $res = explode(" ", $proc);
    switch ($res[0]) {
        case 'add':
            // code...)
            if(!AddItem($res[1], 1))
                echo "Product Unknown : $res[1]\r\n";
            break;
            
        case 'remove':
            // code...
            if(!RemoveItem($res[1], 1))
                echo "Product Unknown : $res[1]\r\n";
            break;
            
        case 'checkout':
            // code...
            PrintBasket(true);
            exit;
        
        default:
            // code...
            echo "Unknown command : $res[0]\r\n";
            break;
    }
    
    PrintBasket();
}
?>