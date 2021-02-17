<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r(json_encode($products));
?>

<div class="content mb-10" id="discover">
    <div class="header-discover">
        <div class="header-title">
            <h1 class="my-auto font-medium" style="margin-right: 1.5vw">Discover</h1>
            <h6 class="my-auto font-bold text-xl text-gray-500">SHOP</h6>
        </div>
        <div class="header-tags md:text-right">
            <filter-tag 
            v-for="tag in tags"
            :key="tag.id"
            :tag-name="tag.name"
            :tag-id="tag.id"
            ></filter-tag>
        </div>    
    </div>
    
    <div class="items-discover mt-20 grid grids-col-1 gap-10" >
        <thumbnail-card
        v-for="product in products"
        :key="product.id"
        :id="product.id"
        :name="product.name"
        :description="product.description"
        :base-price="product.price"
        :discounted-price="product.discount_percentage"
        :description="product.description"
        :quantity="product.quantity"
        :sold="product.sold"
        :warranty="product.warranty_day"
        :is-available="product.is_available"
        :product-tags="productTags"
        >
        </thumbnail-card>
    </div>
    
</div>
<script>
    
    var discoverInstace = null;
    
    const vm = Vue.createApp({
        data() {
            return {
                products: <?= json_encode($products) ?>,
                tags: null,
                productTags: null
            }
        },
        mounted(){
            //productCardsMoreInfo(),
            addTagList(),
            addProductTags()
        },
        unmounted(){
            
        }
    })
    vm.component('thumbnail-card', {
        data(){
            return{
                isMoreInfoOpened: true,
                moreInfoState: "hidden",
                areTagsLoaded: false,
                infoButtonTitle: " more Information",
                infoButtonLogoPosition: "",
                textsState: "",
                descriptionState: "max-height: 15rem; transition: ease-in 350ms",
                
            }
        },
        props: ['id','name','basePrice','discountedPrice','description','quantity',
            'sold','warranty','isAvailable','productTags'],
        template: 
          `
            <div class="item-container">

                <div class="item-description small-scroll" :style="descriptionState">
                <h6 class="desciption-text  no-overflow-text" 
                    :class="textsState">{{description}}</h6>
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
                            image-navigate-forward select-false hidden transition-all"></ion-icon>
                    <ion-icon name="chevron-back-outline" class="image-navigator
                            image-navigate-back select-false hidden transition-all"></ion-icon>
                </div>
                
                <div class="name-action-container">
                            
                    <section class="name-action">
                        <h4 class="name-product" :class="textsState" >{{name}}</h4>

                        <span class="price-product ">
                        <s class="text-gray-500 text-lg">
                            {{ isDiscounted(basePrice,discountedPrice) }} </s>    
                        <h2 class="text-green-600 font-bold tracking-wide text-2xl 
                            md:text-xl lg:text-2xl">
                            {{ computeDiscount(basePrice,discountedPrice) }} </h2>     
                        </span>

                        <section class="actions-product">
                            <h5 v-if="isAvailable" class="action-add-cart select-false">
                                <ion-icon name='cart-outline' style="margin-bottom:-2px">
                                </ion-icon>add to Cart </h5>
                            
                            <h5 v-else="isAvailable" class="action-add-cart 
                                select-false hover:text-gray-700">
                                <ion-icon name='bookmark-outline' style="margin-bottom:-2px">
                                </ion-icon>add to Wishlist </h5>

                            <h5 class="action-more-info" v-on:click="moreInfoToggle">
                               
                                <ion-icon name="chevron-down-outline" 
                                style="margin-bottom: -3px;transition: ease-in-out 650ms"
                                class="more-info-logo" :class="infoButtonLogoPosition" ></ion-icon>
                              
                                <span class="more-info-title select-false">
                                {{ infoButtonTitle }}</span>

                            </h5>
                                        
                        </section>
                    </section>

                    <section class="action-buy" :class="moreInfoState" >
                        <h5 v-if="isAvailable" class="buy-title select-false ">
                            <ion-icon name="checkmark-done-outline" 
                            style="margin-bottom: -2px"></ion-icon>
                            Buy now </h5>
                        <h5 v-else class="buy-title select-false hover:bg-white
                            cursor-auto text-2xl hover:text-black border-0 tracking-wider">
                            <ion-icon name="construct-outline" style="margin-bottom: -2px">
                            </ion-icon> Item Unavailble yet </h5>
                    </section>

                    <section class="more-info" :class="moreInfoState">
                        <div class="info-container">
                        <h5 class="info-text"><span class="info-title">Available: </span>{{quantity}} items</h5>
                        <h5 class="info-text"><span class="info-title">Sold: </span>{{sold}} items</h5>    
                        <h5 class="info-text"><span class="info-title">Warranty: </span>{{warranty}} days</h5>
                        <h5 class="info-text" v-if="areTagsLoaded">
                            <span class="info-title">
                            Tags: </span>
                            <span
                            v-for="productTag in productTags">
                                <p v-if="productTag.productId === id"
                                class="inline">
                                    {{productTag.tagName + " "}}
                                </p>        
                            </span>
                        </h5>
                        </div>
                    </section>        
                </div>
            </div>    
          `,
        methods:{
            computeDiscount(basePrice, discountPercentage){
                var decimalValueOfPercent = discountPercentage / 100;
                var discountPrice = basePrice * decimalValueOfPercent;
                var discountedBasePrice = "$" + (basePrice - discountPrice).toFixed(2);
                return  discountedBasePrice;
            },
            isDiscounted(basePrice, discountPercentage){
                if(discountPercentage > 0){
                    return "$" + basePrice;
                }
                return "";
            },
            moreInfoToggle(){
                if(!this.areTagsLoaded){
                    this.areTagsLoaded = true;
                }
                    
                if(this.isMoreInfoOpened){
                    
                    this.moreInfoState = "block";
                    this.infoButtonTitle = " less Information";
                    this.infoButtonLogoPosition = "transform rotate-180 md hydrated";
                    this.textsState = "can-overflow-text";
                    this.descriptionState = "max-height: 50vh; transition: ease-out 350ms";
                    this.isMoreInfoOpened = false;
                }else{
                    
                    this.moreInfoState = "hidden";
                    this.infoButtonTitle = " more Information";
                    this.infoButtonLogoPosition = "md hydrated";
                    this.textsState = "";
                    this.descriptionState = "max-height: 15rem; transition: ease-out 350ms";
                    this.isMoreInfoOpened = true;
                }
                
            }
        }
        
    }),
    vm.component('filter-tag',{
        props: ['tagName','tagId'],
        template: `
            <h5 class="discover-tag  select-false" :id="tagId">{{tagName}}</h5>
        `,
    }),
    discoverInstace = vm.mount("#discover");
    
    function addTagList(){
        $.ajax({
            url: '/tags/show',
            type: 'get',
            success: function(data) {
              var result = JSON.parse(data);
              discoverInstace.tags = result;
              //console.log(discoverInstace.tags);
              //console.log(result);
            }  
        });
    }
    
    function addProductTags(){
        $.ajax({
            url: '/products-tags/show',
            type: 'get',
            success: function(data) {
              var result = JSON.parse(data);
              discoverInstace.productTags = result;
              //console.log(result);
            }  
        });
    }
    
    
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
    
</script>