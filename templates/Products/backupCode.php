<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<script>
    
     function productCardsMoreInfo(){
        $(".action-more-info").click(function(){
        let itemContainer = $(this).parent().parent().parent().parent();
        let windowSize = $(window).width();
        let imagesContainer = itemContainer.children(".images-container");
        let itemDescription = itemContainer.children(".item-description");
        let itemNameAction = itemContainer.children(".name-action-container");
        let isMoreInfoShowed = itemNameAction.children(".name-action").children(".name-product").hasClass("can-overflow-text")
        let imageList = imagesContainer.children(".image-list");
        if(!isMoreInfoShowed){
            imageList.removeClass("hidden");
            $(this).children(".more-info-title").html("less Infomation");
            $(this).children(".more-info-logo").addClass('transform rotate-180');
            itemNameAction.children(".name-action").children(".name-product").addClass("can-overflow-text")
            itemNameAction.children(".more-info").show("fast");
            itemNameAction.children(".action-buy").show("fast");
            
            imagesContainer.children(".image-navigator").show('fast');
            itemDescription.children(".no-overflow-text").addClass('can-overflow-text');
            itemDescription.attr('style','max-height: 50vh; transition: ease-out 350ms');
            
            itemDescription.show('fast',function(){
                itemDescription.removeClass('hidden');
            });
           }else{
            imageList.addClass("hidden");
            $(this).children(".more-info-title").html("more Infomation");
            $(this).children(".more-info-logo").removeClass('transform rotate-180');
            itemNameAction.children(".more-info").hide("fast");
             itemNameAction.children(".action-buy").hide("fast");
            itemNameAction.children(".name-action").children(".name-product").removeClass("can-overflow-text")
            imagesContainer.children(".image-navigator").hide('fast');   
            itemDescription.children(".no-overflow-text").removeClass('can-overflow-text');
            if(windowSize < 640){
                itemDescription.addClass('hidden');
            }
            itemDescription.attr('style','max-height: 15rem; transition: ease-out 350ms');
        }
        
    });
    
    $(".image-navigator").click(function(){
        var isForward = $(this).hasClass("image-navigate-forward");
        var currentSlider = $(this).parent().children(".item-image-slider");
        if(isForward){
            showDivs(1,currentSlider);
        }else{
            showDivs(-1,currentSlider);
        }
    });
    var slideIndex = 0;
    function showDivs(n, slider) {
        slideIndex += n;
        var sliderImages = slider.children(".product-image");  
        if (slideIndex > sliderImages.length - 1) {slideIndex = 0}
        if (slideIndex <= -1) {slideIndex = sliderImages.length - 1}
        
        $(sliderImages).hide(0,function(){
            $(this).addClass("opacity-0");
        });
        sliderImages.each(function(index,element){
            if(index === slideIndex){
                $(element).show(0,function(){
                    $(this).removeClass("opacity-0");
                });
            }
        });
    }
    $(".item-container").hover(function(){
        $(this).children(".images-container").children(".image-navigator").show("fast");
    }).mouseleave(function(){
        if($(window).width() > 640){
            $(this).children(".images-container").children(".image-navigator").hide("fast");
        }
    });
    }
    
    function addTagList(){
        $.ajax({
            url: '/tags/show',
            type: 'get',
            success: function(data) {
              var result = JSON.parse(data);
              discoverInstance.tags = result;
            }  
        });
    }
    
    function addProductTags(){
        $.ajax({
            url: '/products-tags/show',
            type: 'get',
            success: function(data) {
              var result = JSON.parse(data);
              discoverInstance.productTags = result;
            }  
        });
    }
    
    function addBestSellerProducts(){
        $.ajax({
            url: '/products/show/1',
            type: 'get',
            success: function(data) {
                if(data){
                   var result = JSON.parse(data);
                   //console.log(result);
                   let bestSellerProducts = result.bestSellers
                   for(var i = 0; i < bestSellerProducts.length; i++){
                       discoverInstance.bestSellerProducts.push(bestSellerProducts[i]);
                   }
                   discoverInstance.bestSellerNextPage = result.nextPageUrl;
                   discoverInstance.bestSellerPrevPage = result.previousPageUrl;
                   discoverInstance.bestSellerTitle = result.requestedProductTypeName;
                }
            }  
        });
    }
    
</script>    