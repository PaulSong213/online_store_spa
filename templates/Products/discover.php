<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r(json_encode($products));
?>

<div class="content mb-10">
    <div class="header-discover">
        <div class="header-title">
            <h1 class="my-auto font-medium" style="margin-right: 1.5vw">Discover</h1>
            <h6 class="my-auto font-bold text-xl text-gray-500">SHOP</h6>
        </div>
        <div class="header-tags">
            <h5 class="discover-tag  select-false">Ceramic</h5>
            <h5 class="discover-tag  select-false">Aluminum</h5>
            <h5 class="discover-tag  select-false">Bamboo</h5>
            <h5 class="discover-tag  select-false">Steal</h5>
            <h5 class="discover-tag  select-false">Wood</h5>
            <h5 class="discover-tag  select-false">Costumized</h5>
            <h5 class="discover-tag  select-false">Modern</h5>
            <h5 class="discover-tag  select-false">Best Seller</h5>
        </div>    
    </div>
    
    <div class="items-discover mt-20 grid grids-col-1 gap-10" id="discover">
        <thumbnail-card
        v-for="product in products"
        :key="product.id"
        :name="product.name"
        :description="product.description"
        :base-price="product.price"
        :discounted-price="product.discount_percentage"
        :description="product.description"
        :quantity="product.quantity"
        :sold="product.sold"
        :warranty="product.warranty"
        >
        </thumbnail-card>
    </div>
    
</div>
<script>
    
    const vm = Vue.createApp({
        data() {
            return {
                products: <?= json_encode($products) ?>
            }
        },
        mounted(){
            productCardsMoreInfo();
        }
    })
    vm.component('thumbnail-card', {
        props: ['name','basePrice','discountedPrice','description','quantity',
            'sold','warranty'],
        template: 
          `
            <div class="item-container">

                <div class="item-description small-scroll" style="max-height: 15rem">
                <h6 class="desciption-text  no-overflow-text">{{description}}</h6>
                </div>
                
                <div class="images-container">
                    <div class="item-image-slider" style="height: 40vh">  
                         <img src="/img/products/p1.jpg" class="product-image"/>
                         <img src="/img/products/p2.jpg" class="product-image"/>
                         <img src="/img/products/p3.jpg" class="product-image"/>
                         <img src="/img/products/p4.jpg" class="product-image"/>
                         <img src="/img/products/p5.jpg" class="product-image"/>
                    </div>
                    <ion-icon name="chevron-forward-outline" class="image-navigator
                              image-navigate-forward select-false" ></ion-icon>
                    <ion-icon name="chevron-back-outline" class="image-navigator
                              image-navigate-back select-false"></ion-icon>
                </div>
                
                <div class="name-action-container">
                            
                    <section class="name-action">
                        <h4 class="name-product">{{name}}</h4>

                        <span class="price-product ">
                        <s class="text-gray-500 text-lg">
                            {{ basePrice }} </s>    
                        <h2 class="text-green-600 font-bold tracking-wide text-2xl 
                            md:text-xl lg:text-2xl">
                            {{ discountedPrice }} </h2>     
                        </span>

                        <section class="actions-product">
                            <h5 class="action-add-cart select-false">
                                <ion-icon name="cart-outline" style="margin-bottom: -2px"></ion-icon>
                                add to Cart </h5>

                            <h5 class="action-more-info">
                                <ion-icon name="chevron-down-outline" 
                                style="margin-bottom: -2px;transition: ease-in-out 650ms"
                                class="more-info-logo"></ion-icon>
                                <span class="more-info-title select-false">more Information</span></h5>
                        </section>
                    </section>

                    <section class="action-buy hidden">
                        <h5 class="buy-title select-false">
                            <ion-icon name="checkmark-done-outline" 
                            style="margin-bottom: -2px"></ion-icon>
                            Buy Now </h5>
                    </section>

                    <section class="more-info">
                        <div class="info-container">
                        <h5 class="info-text"><bold class="info-title">Available: </bold>{{quantity}} items</h5>
                        <h5 class="info-text"><bold class="info-title">Sold: </bold>{{sold}} items</h5>    
                        <h5 class="info-text"><bold class="info-title">Warranty: </bold>{{warranty}} days</h5>
                        <h5 class="info-text"><bold class="info-title">Tags: </bold>Ceramic, Powdered, Strong</h5>
                        </div>
                    </section>        
                
                </div>
                
            </div>    
          `,
    })
    vm.mount("#discover");
    
    function productCardsMoreInfo(){
        $(".action-more-info").click(function(){
        let itemContainer = $(this).parent().parent().parent().parent();
        let windowSize = $(window).width();
        let imagesContainer = itemContainer.children(".images-container");
        let itemDescription = itemContainer.children(".item-description");
        let itemNameAction = itemContainer.children(".name-action-container");
        let isMoreInfoShowed = itemNameAction.children(".name-action").children(".name-product").hasClass("can-overflow-text")
        let imageLoader = imagesContainer.children(".image-loader");
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
    $(".item-container").mouseenter(function(){
        $(this).children(".images-container").children(".image-navigator").show("fast");
    }).mouseleave(function(){
        if($(window).width() > 640){
            $(this).children(".images-container").children(".image-navigator").hide("fast");
        }
    });
    }
    
</script>