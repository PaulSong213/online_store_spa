<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$items = [];

foreach ($thumbnails as $thumbnail){ 
    
    if($thumbnail->is_displayed){
        $imagePaths = [];
        
        foreach ($thumbnail->thumbnail_images as $image) {
            $imagePaths[] = array(
                'filePath' => $image->file_path.$image->file_name
            );
        }
        
        $items[] = array(
            'id' => $thumbnail->id,
            'name' => $thumbnail->name,
            'description' => $thumbnail->description,
            'images' => $imagePaths
        );
    }
}
print_r(json_encode($items));
