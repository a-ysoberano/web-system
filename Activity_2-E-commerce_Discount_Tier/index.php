<?php
$total = $_GET['total'];

if ($total >= 200) {
    $discountPrice = $total * 0.20;
    $discount = "20%";
} else if ($total >= 100) {
    $discountPrice = $total * 0.15;
    $discount = "15%";
} else if ($total >= 50) {
    $discountPrice = $total * 0.10;
    $discount = "10%";
} else {
    $discountPrice = 0;
    $discount = "No Discount";
}

$finalPrice = $total - $discountPrice;

echo "Total Price: $total, Discount: $discount, Final Price: $finalPrice";
