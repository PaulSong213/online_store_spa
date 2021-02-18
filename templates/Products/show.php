<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

print_r(json_encode($products));

echo "<br><br><br><br><br>";

foreach ($products as $product) {
    
    $listImages = [];
    foreach ($product->images as $images ) {
        $listImages[] = $images->file_root.$images->file_name;
    }
    
    $listProduct[] = array(
        'id' => $product->id,
        'name' => $product->name,
        'price' => $product->price,
        'description' => $product->description,
        'isAvailable' => $this->Boolean->plain($product->is_available),
        'availableQuantity' => $product->quantity,
        'soldQuantity' => $product->sold,
        'warrantyDay' => $product->warranty_day,
        'pubslishedAt' => $product->created,
        'imagesPath' => $listImages    
        );
}


 print_r(json_encode($listProduct));
