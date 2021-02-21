<?php
//print_r(json_encode($products));
?>

<div class="content mb-10" id="discover">
    <div class="header-discover">
        <h6 class="my-auto font-bold text-xl text-gray-500">SHOP</h6>
        <div class="header-tags md:text-right">
            <filter-tag 
            v-for="tag in tags"
            :key="tag.id"
            :tag-name="tag.name"
            :tag-id="tag.id"
            ></filter-tag>
        </div>    
    </div>
    <div class="best-sellers">
        <div class="header-title">
            <h1 class="my-auto font-medium" style="margin-right: 1.5vw">
                {{bestSellerTitle}}
            </h1>
            <h6 class="my-auto font-bold text-xl text-gray-500"
            v-if="bestSellerTitle">FIND</h6>
        </div>
        
        <div class="items-discover mt-20 grid grids-col-1 gap-10" >
            <best-seller-card
            v-for="product in bestSellerProducts"
            :key="product.id"
            :id="product.id"
            :name="product.name"
            :description="product.description"
            :base-price="product.basePrice"
            :discounted-price="product.discountedPrice"
            :discount-percentage="product.discountPercentage"
            :quantity="product.quantity"
            :sold="product.soldQuantity"
            :warranty="product.warrantyDay"
            :is-available="product.isAvailable"
            :product-tags="productTags"
            :image-paths="product.imagesPath"
            :next-page="bestSellerNextPage"
            >
            </best-seller-card>
        </div>
        <h4 class="px-5 py-3 border border-gray-600 w-max mx-auto my-3 cursor-pointer
            hover:bg-gray-700 hover:text-gray-100 rounded-sm transition-colors
            text-2xl"
            v-if="bestSellerProducts.length > 0"
            v-on:click="toggleInlineTab(true,bestSellerTitle,'best-seller-card')">
            View All Best Sellers
        </h4>
    </div>
    <div class="inline-tab fixed bg-white w-full h-full border-2 border-gray-300 
        bottom-0 left-2/4 shadow-2xl rounded-t-3xl overflow-hidden"
        :class="inlineTabAnimation"
        style="max-height: 90vh;max-width: 1200px; transform: translateX(-50%);"
        v-if="isInlineTabOpen">
        <div class="tab-head flex justify-between shadow-2xl p-5">
            <h1 class="my-auto font-bold text-3xl tracking-widest">
                {{inlineTabTitle}}
            </h1>
            <span v-on:click="toggleInlineTab(false)">
                <ion-icon name="close-outline" 
                    class="border border-gray-300 border-opacity-0 hover:text-white
                    hover:border-opacity-100 hover:shadow-xl hover:bg-gray-800 
                    transition-all p-1 rounded-full text-5xl text-gray-700 
                    font-bold  cursor-pointer"    
                ></ion-icon>
            </span>
        </div>
        
        <div class="tab-content p-10 h-full overflow-auto small-scroll"
             id="tab-content-container"
             v-on:scroll.passive="addBestSellerProduct(bestSellerNextPage)">
            <keep-alive>
                <div class="items-discover mt-20 grid grids-col-1 gap-10"
                    v-if="inlineTabContentComponent = 'best=seller-card' ">
                    <component
                        :is=" 'best-seller-card' "
                        v-for="product in bestSellerProducts"
                        v-bind="{ 
                            key : product.id,
                            id : product.id,
                            name : product.name,
                            description : product.description,
                            basePrice : product.basePrice,
                            discountedPrice : product.discountedPrice,
                            discountPercentage : product.discountPercentage,
                            quantity : product.quantity,
                            sold : product.soldQuantity,
                            warranty : product.warrantyDay,
                            isAvailable : product.isAvailable,
                            productTags : productTags,
                            imagePaths : product.imagesPath,
                        }"
                    ></component>
                </div>    
            </keep-alive>
            
        </div>
        
    </div>
    
</div>

<script>
    
    var discoverInstance = null;
    
    const vm = Vue.createApp({
        data() {
            return {
                bestSellerTitle: null,
                bestSellerProducts: Array(),
                bestSellerNextPage: null,
                bestSellerPrevPage: null,
                tags: null,
                productTags: null,
                isInlineTabOpen: false,
                inlineTabAnimation: "close-tab",
                inlineTabTitle: null,
                inlineTabContentComponent: null,
                
            }
        },
        mounted(){
            this.addTagList(),
            this.addBestSellerProduct(),
            this.addProductTags()
        },
                                   
        methods:{
           
            toggleInlineTab(willOpen = true,tabTitle, tabContent = null){
                if(willOpen){
                    this.isInlineTabOpen = true;
                    this.inlineTabAnimation = "open-tab";
                }else{
                    this.isInlineTabOpen = false;
                    this.inlineTabAnimation = "close-tab";
                }
                if(tabTitle){this.inlineTabTitle = tabTitle;}
                
                if(tabContent){this.inlineTabContentComponent = tabContent}
                
            },
            async addBestSellerProduct(page = '/products/show/1'){
                let response = await $.get(page,function(data){return data });
                let data = JSON.parse(response);
                let product = data.bestSellers;
                for(var i = 0; i < product.length; i++){
                    this.bestSellerProducts.push(product[i]);
                }
                this.bestSellerNextPage = data.nextPageUrl;
                this.bestSellerPrevPage = data.previousPageUrl;
                this.bestSellerTitle = data.requestedProductTypeName;
                
            },
            async addTagList(){
                let response = await $.get('/tags/show',function(data){return data });
                this.tags = JSON.parse(response);
            },
            async addProductTags(){
                let response = await $.get('/products-tags/show',function(data){return data });
                this.productTags = JSON.parse(response);
            } 
       
        }
    })
    vm.component('best-seller-card', {
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
                isSliderMoved: false,
            }
        },
        
        props: ['id','name','basePrice','discountedPrice','discountPercentage','quantity',
            'sold','warranty','isAvailable','productTags','description','imagePaths','nextPage'],
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
    discoverInstance = vm.mount("#discover");
    
    
    
</script>