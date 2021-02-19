<?php
//print_r(json_encode($products));
?>

<div class="content mb-10" id="discover">
    <div class="header-discover">
        <div class="header-title">
            <h1 class="my-auto font-medium" style="margin-right: 1.5vw">Best Seller</h1>
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
        :base-price="product.basePrice"
        :discounted-price="product.discountedPrice"
        :discount-percentage="product.discountPercentage"
        :description="product.description"
        :quantity="product.quantity"
        :sold="product.soldQuantity"
        :warranty="product.warrantyDay"
        :is-available="product.isAvailable"
        :product-tags="productTags"
        :image-paths="product.imagesPath"
        >
        </thumbnail-card>
    </div>
    
</div>
<script>
    
    var discoverInstace = null;
    
    const vm = Vue.createApp({
        data() {
            return {
                products: null,
                tags: null,
                productTags: null,
                test: null
            }
        },
        mounted(){
            addTagList(),
            addBestSellerProducts(),
            addProductTags()
        },
        unmounted(){
            
        },
        beforeCreate(){
           
        }
    })
    vm.component('thumbnail-card', {
        data(){
            return{
                isMoreInfoOpened: true,
                moreInfoState: "hidden",
                areTagsLoaded: false,
                infoButtonTitle: "more Information",
                infoButtonLogoPosition: "",
                textsState: "",
                descriptionState: "max-height: 15rem; transition: ease-in 350ms",
                
                currentImageIndex: 0,
                imageEffect: "",
                isSliderMoved: false
            }
        },
        
        props: ['id','name','basePrice','discountedPrice','discountPercentage','quantity',
            'sold','warranty','isAvailable','productTags','description','imagePaths'],
        template: 
          `
            <div class="item-container">
                <div class="item-description small-scroll" :style="descriptionState">
                <h6 class="desciption-text  no-overflow-text" 
                    :class="textsState">{{description}}</h6>
                </div>
                <div class="images-container">
                    <div class="item-image-slider" :class="imageEffect" style="height:40vh">
                        <section v-for="(el, index) in imagePaths">
                            <img
                            v-if="index === currentImageIndex"    
                            :src="imagePaths[index]" 
                            class="product-image bg-black fade-in-out"/>
                            <img
                            v-else-if="isSliderMoved"   
                            :src="imagePaths[index]" 
                            class="product-image bg-black hidden"/>        
                        </section>
                    </div>
                    <ion-icon name="chevron-forward-outline" class="image-navigator
                        image-navigate-forward select-false block md:hidden"
                        v-on:click="changeSliderImageToNextImage()"></ion-icon>
                    <ion-icon name="chevron-back-outline" class="image-navigator
                        image-navigate-back select-false block md:hidden"
                        v-on:click="changeSliderImageToNextImage(false)"></ion-icon>
                </div>
                
                <div class="name-action-container">
                            
                    <section class="name-action">
                        <h4 class="name-product" :class="textsState" >{{name}}</h4>

                        <span class="price-product ">
                        <s class="text-gray-500 text-lg"
                            v-if="discountPercentage > 0">
                            {{ "$" + basePrice }} </s>    
                        <h2 class="text-green-600 font-bold tracking-wide text-2xl 
                            md:text-xl lg:text-2xl">
                            {{ "$" + discountedPrice }} </h2>     
                        </span>

                        <section class="actions-product">
                            <h5 v-if="isAvailable" class="action-add-cart select-false">
                                <ion-icon name='cart-outline' style="margin-bottom:-2px">
                                </ion-icon>add to Cart </h5>
                            
                            <h5 v-else class="action-add-cart 
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
                        <h5 class="info-text">
                            <span class="info-title">Warranty: </span>{{warranty}}
                            <span v-if="warranty > 1"> days</span>
                            <span v-else> day</span>
                        </h5>
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
            
            moreInfoToggle(){
                if(!this.areTagsLoaded){
                    this.areTagsLoaded = true;
                }
                    
                if(this.isMoreInfoOpened){
                    this.moreInfoState = "block fade-in";
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
                this.isSliderMoved = true;
            },
            changeSliderImageToNextImage(toNextImage = true){
                this.isSliderMoved = true;
                if(toNextImage){
                    this.currentImageIndex++;
                }else{
                    this.currentImageIndex--;
                }
                if(this.currentImageIndex > this.totalImages){this.currentImageIndex = 0}
                if(this.currentImageIndex < 0){this.currentImageIndex = this.totalImages}
                this.imageEffect = "fade-in-out";
            }
        },
        computed: {
            totalImages(){
                return this.totalImages = this.imagePaths.length - 1;
            }
        },
        
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
            }  
        });
    }
    
    function addBestSellerProducts(){
        $.ajax({
            url: '/products/show/1',
                type: 'get',
                success: function(data) {
                var result = JSON.parse(data);
                console.log(result);
                discoverInstace.products = result.bestSellers;
                console.log(discoverInstace.products);
            }  
        });
    }
    
</script>