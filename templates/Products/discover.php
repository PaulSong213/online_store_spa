<?php
//content of this page is created on vue
//get request
$productId = null;
$tagId = null;
$autoOpenBestSeller = false;

//cookike
$offlineLovedProductId = Array();

//setcookie('offline_loved_product_id', json_encode([]), time()+3600);

if(isset($_GET['product'])){$productId = filter_var( $_GET['product'], FILTER_VALIDATE_INT);}
if(isset($_GET['tag'])){$tagId = filter_var( $_GET['tag'], FILTER_VALIDATE_INT);}
if(isset($_GET['bestseller'])){$autoOpenBestSeller = filter_var($_GET['bestseller'], FILTER_VALIDATE_BOOLEAN);}
if(isset($_COOKIE['offline_loved_product_id'])) {
    $lovedIds = json_decode($_COOKIE['offline_loved_product_id']);
    for($i = 0; $i < sizeof($lovedIds); $i++){
        if(filter_var($lovedIds[$i],FILTER_VALIDATE_INT)){$offlineLovedProductId[] = $lovedIds[$i];}
    }
}

?>

<script>
    const productIdFromUrlGet = <?= json_encode($productId) ?>;
    const tagIdFromUrlGet = <?= json_encode($tagId) ?>;
    const autoOpenBestSellerUrlGet =  <?= json_encode($autoOpenBestSeller) ?>;
    
    
</script>	