<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r(json_encode($productsTags));
$items = [];

if(!$tag){
foreach ($productsTags as $productTag) {
    $items[] = array(
		'id' => $productTag->id,
		'tagId' => $productTag->tag->id,
		'tagName' => $productTag->tag->name,
        'productId' => $productTag->product->id,
		'productName' => $productTag->product->name	
	);
}
}else{
	$specificTagId = null;
	$specificTagName = null;
	$relatedProduct = [];
	foreach ($productsTags as $productTag) {
		$relatedProduct[] = array(
			'id' => $productTag->product->id,
			'name' => $productTag->product->name,
		);
		if(!$specificTagId){$specificTagId = $productTag->tag->id; }
		if(!$specificTagName){$specificTagName = $productTag->tag->name; }
	}
	$items = ['tagId' => $specificTagId, 'tagName' => $specificTagName,
		'products' => $relatedProduct];
}

$listItems = array('items' => $items);
print_r(json_encode($items));
