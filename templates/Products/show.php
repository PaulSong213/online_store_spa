<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//print_r(json_encode($products));

//echo "<br><br><br><br><br>";
if($isPageHasData){
    
    $pageInformation = $this->Paginator->counter(__('Page {{page}} of {{pages}},'
            . ' showing {{current}} record(s) out of {{count}} total'));
    
    $nextPageLink = "";
    $previousPageLink = "";
    
    if($this->Paginator->hasNext()){
        $nextPageLink = $this->FormatLink->rawUrl($this->Paginator->next());
    }
    if($this->Paginator->hasPrev()){
        $previousPageLink = $this->FormatLink->rawUrl($this->Paginator->prev());
    }
    
    $listProduct = [];
    
    foreach ($products as $product) {
    
        $listImages = [];
        foreach ($product->images as $images ) {
            $listImages[] = $images->file_root.$images->file_name;
        }

        $listProduct[] = array(
            'id' => $product->id,
            'name' => $product->name,
            'basePrice' => $product->price,
            'discountedPrice' => $this->Calculate->discountedPrice($product->price,$product->discount_percentage),
            'discountPercentage' => $product->discount_percentage,
            'description' => $product->description,
            'isAvailable' => $this->Boolean->plain($product->is_available),
            'availableQuantity' => $product->quantity,
            'soldQuantity' => $product->sold,
            'warrantyDay' => $product->warranty_day,
            'pubslishedAt' => $product->created,
            'imagesPath' => $listImages,
            'productType' => array(
                    'id' => $product->product_type->id,
                    'name' => $product->product_type->name,
                    'description' => $product->product_type->description,
                ),
            'seller' => array(
                    'id' => $product->seller->id,
                    'firstName' => $product->seller->first_name,
                    'middleName' => $product->seller->middle_name,
                    'lastName' => $product->seller->last_name,
                    'email' => $product->seller->email,
                    'gender' => $this->Gender->formatToText($product->seller->gender),
                    'address' => $product->seller->address,
                    'accountTypeId' => $product->seller->account_type_id,
                )
            );
    }
    
$items = array("product" => $listProduct,'nextPageUrl' => $nextPageLink,
    'previousPageUrl' => $previousPageLink, 'pageInformation' => $pageInformation,
    'requestedProductTypeName' => $requestedProductTypeName);

print_r(json_encode($items));
}

?>
