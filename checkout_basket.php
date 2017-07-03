<?php
$checkoutBasket = [];

function AddItem($sku, $count = 1)
{
    global $checkoutBasket, $product;
    
    // check valid
    if(!array_key_exists($sku, $product))
        return false;
    
    if (array_key_exists($sku, $checkoutBasket))
    {
        $checkoutBasket[$sku] += $count;
    }
    else
    {
        $checkoutBasket[$sku] = $count;
    }
    
    return true;
}

function RemoveItem($sku, $count = 1)
{
    global $checkoutBasket, $product;
    
    // check valid
    if(!array_key_exists($sku, $product))
        return false;
        
    if (array_key_exists($sku, $checkoutBasket))
    {
        $checkoutBasket[$sku] -= $count;
        
        if($checkoutBasket[$sku] <= 0)
        {
            unset($checkoutBasket[$sku]);
        }
    }
    else
    {
        unset($checkoutBasket[$sku]);
    }
    
    return true;
}

function PrintBasket($checkout = false)
{
    global $checkoutBasket, $product;
    
    $price = 0.0;
    if($checkout)
    {
        echo "Check out :\r\n";
    }
    else
    {
        echo "Basket :\r\n";
    }
    
    if(empty($checkoutBasket))
    {
        echo " <EMPTY> ";
    }
    else
    {
        $promo = CheckPromotion($checkoutBasket);

        $keys = array_keys($checkoutBasket);
        foreach($keys as $i)
        {
            $ea_price = $product[$i][1];
            $discount_str = "";
            $discount = 0.0;
            
            if($checkout)
            {
                if(array_key_exists($i, $promo[0])) 
                {
                    $discount = $promo[0][$i];
                    $discount_str = sprintf(" (Discounted : $%.2f)", $discount);
                }
                
                if(array_key_exists($i."_txt", $promo[0]))
                {
                    $discount_str = "** ".$discount_str." ". $promo[0][$i."_txt"];
                }
                
                echo sprintf("$checkoutBasket[$i]x %s $%0.2f ea\r\n\t$discount_str\r\n", $product[$i][0], $ea_price);
            }
            else
            {
                echo sprintf("$i -> $checkoutBasket[$i] $%0.2f ea$discount_str\r\n", $ea_price);
            }
            
            $price += ($ea_price * $checkoutBasket[$i]) - $discount;
        }
        
        // free items
        if($checkout)
        {
            $keys = array_keys($promo[1]);
            $promoItem = $promo[1];
            foreach($keys as $i)
            {
                $ea_price = $product[$i][1];
                
                echo sprintf($promoItem[$i]. "x ". $product[$i][0]. " $%0.2f ea,", $ea_price);
                $price += ($ea_price * $promoItem[$i]);
            }
        }
    }
    
    echo sprintf("\r\nTotal Price : $%0.2f\r\n",$price);
}
?>