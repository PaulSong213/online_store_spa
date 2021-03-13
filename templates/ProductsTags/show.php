<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r(json_encode($productsTags));
$items = [];

foreach ($productsTags as $productTag) {
    $items[] = array(
		'id' => $productTag->id,
		'tagId' => $productTag->tag->id,
		'tagName' => $productTag->tag->name,
        'productId' => $productTag->product->id,
		'productName' => $productTag->product->name	
	);
}

$listItems = array('items' => $items);
print_r(json_encode($items));
