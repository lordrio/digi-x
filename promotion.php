<?php
$promotion = [];

// first promo ATV buy 3 pay 2
$promotion[0] = ["atv", 3, Promo1_Execute];
// 2nd promo bulk super ipad > 4 -> 499.99
$promotion[1] = ["ipd", 4, Promo2_Execute];
// 3rd promo check bundle mpb with vga
$promotion[2] = ["mbp", 1, Promo3_Execute];

function PromoCheckerHelper($checkoutBasket, $sku, $count)
{
    if(array_key_exists($sku, $checkoutBasket))
    {
        return $checkoutBasket[$sku] >= $count;
    }
    
    return false;
}

function CheckPromotion($checkoutBasket)
{
    global $promotion;
    
    $adjustedPrice = [];
    $addedItem = [];
    
    foreach($promotion as $promo)
    {
        if(PromoCheckerHelper($checkoutBasket, $promo[0], $promo[1]))
        {
            $promo[2]($checkoutBasket, $adjustedPrice, $addedItem);
        }
    }
    
    return [$adjustedPrice, $addedItem];
}

// first promo ATV buy 3 pay 2
function Promo1_Execute($checkoutBasket, &$adjustedPrice, &$addedItem)
{
    global $product;
    
    $totalCnt = $checkoutBasket["atv"];
    $cnt = (int)($totalCnt/3.0);
    
    $adjustedPrice["atv"] = $cnt * $product["atv"][1];
    $adjustedPrice["atv_txt"] = "Buy $totalCnt Pay ". ($totalCnt - $cnt);
}

// 2nd promo bulk super ipad > 4 -> 499.99
function Promo2_Execute($checkoutBasket, &$adjustedPrice, &$addedItem)
{
    global $product;
    
    $cnt = $checkoutBasket["ipd"];
    $adjustedPrice["ipd"] = $cnt * ($product["ipd"][1] - 499.99);
    $adjustedPrice["ipd_txt"] = sprintf("%s each $%0.2f -> $%0.2f", $product["ipd"][0], $product["ipd"][1], 499.99);
}

// 3rd promo check bundle mpb with vga
function Promo3_Execute($checkoutBasket, &$adjustedPrice, &$addedItem)
{
    global $product;
    
    $cnt = $checkoutBasket["mbp"];
    
    $addedItem["vga_free"] = $cnt;
    $adjustedPrice["mbp_txt"] = sprintf("%s for each %s", $product["vga_free"][0], $product["mbp"][0]);
}
?>