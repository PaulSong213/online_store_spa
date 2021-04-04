<?php
//content of this page is created on vue
$productId = null;
$tagId = null;
$autoOpenBestSeller = false;

if(isset($_GET['product'])){$productId = $_GET['product'];}
if(isset($_GET['tag'])){$tagId = $_GET['tag'];}
if(isset($_GET['bestseller'])){$autoOpenBestSeller = $_GET['bestseller'];}


?>


<script>
    const productIdFromUrlGet = "<?= $productId ?>";
    const tagIdFromUrlGet = "<?= $tagId ?>";
    const autoOpenBestSellerUrlGet =  "<?= $autoOpenBestSeller ?>";
</script>	