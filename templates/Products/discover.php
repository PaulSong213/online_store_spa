<?php
//print_r(json_encode($products));
?>

<div class=" mb-10" id="discover">
    <div class="header-discover">
        <h6 class="my-auto font-bold text-xl text-gray-500">PAUL SHOP</h6>
        <div class="text-justify w-full md:w-2/3 lg:w-2/4 transition-all
             md:text-right m-2">
            <filter-tag 
            v-for="tag in tags"
            :key="tag.id"
            :tag-name="tag.name"
            :tag-id="tag.id"
            ></filter-tag>
        </div>    
    </div>
    
    <div class="best-sellers content my-10">
        <div class="header-title mt-0">
            <h1 class="my-auto font-medium" style="margin-right: 1.5vw">
                {{bestSellerTitle}}
            </h1>
            <h6 class="my-auto font-bold text-xl text-gray-500"
            v-if="bestSellerTitle">FIND</h6>
        </div>
        
        <div class="mt-20 grid grid-cols-1 gap-10"> 
            
            <featured-product-card
            v-for="product in bestSellerProductsThumbnail"
            :key="product.id"
            :id="product.id"
            :name="product.name"
            :description="product.description"
            :base-price="product.basePrice"
            :discounted-price="product.discountedPrice"
            :discount-percentage="parseFloat(product.discountPercentage).toFixed(0)"
            :quantity="product.availableQuantity"
            :sold="product.soldQuantity"
            :warranty="product.warrantyDay"
            :is-available="product.isAvailable"
            :product-tags="productTags"
            :image-paths="product.imagesPath"
            :next-page="bestSellerNextPage"
            >
            </featured-product-card>
        </div>
        
        <h4 class="w-max mx-auto my-16"  
            v-if="bestSellerProductsThumbnail.length > 0"
            v-on:click="toggleInlineTab(true,bestSellerTitle,'featured-product-card')"
            v-cloak>
            <span class="btn-default text-xl px-10 py-5 bg-transparent">
                View More Best Sellers</span>
        </h4>
        
    </div>
    
    
<!--    NORMAL PRODUCT  -->
    <div class="normal-products content my-10">
        <div class="mt-20 grid grid-cols-2 md:grid-cols-3 
             lg:grid-cols-4 gap-2">
            
            <normal-product-card
            v-for="product in normalProduct"
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
            v-on:click="toggleInlineTab(true,'','normal-product-on-tab',product)"
            >
            </normal-product-card>
            
        </div>
    </div>
    
<!--    INLINE TAB -->
    <div class="inline-tab fixed bg-white w-full h-full border-2 border-gray-300 
        bottom-0 left-2/4 shadow-2xl rounded-t-3xl overflow-hidden"
        :class="inlineTabAnimation"
        style="max-height: 90vh;max-width: 1200px; transform: translateX(-50%);"
        v-if="isInlineTabOpen">
        <div class="tab-head flex justify-between shadow-2xl p-5">
            <h1 class="my-auto font-bold text-3xl tracking-widest"
                v-cloak>
                {{inlineTabTitle}}
            </h1>
            <span v-on:click="toggleInlineTab(false)">
                <ion-icon name="close-outline" 
                    class="close-tab-button"    
                ></ion-icon>
            </span>
        </div>
        
        <div class="tab-content p-10 h-full overflow-auto small-scroll"
             
             v-if="inlineTabContentComponent === 'featured-product-card'"
             v-on:scroll.passive="addBestSellerProduct(bestSellerNextPage)">
            <keep-alive>
                <div class="items-discover grid grids-col-1 gap-10 py-10 mb-10">
                    <component
                        :is=" 'featured-product-card' "
                        v-for="product in bestSellerProducts"
                        v-bind="{ 
                            key : product.id,
                            id : product.id,
                            name : product.name,
                            description : product.description,
                            basePrice : product.basePrice,
                            discountedPrice : product.discountedPrice,
                            discountPercentage : product.discountPercentage,
                            quantity : product.availableQuantity,
                            sold : product.soldQuantity,
                            warranty : product.warrantyDay,
                            isAvailable : product.isAvailable,
                            productTags : productTags,
                            imagePaths : product.imagesPath,
                        }"
                    ></component>
                    <div class="pt-10 pb-20">
                        <circle-loader
                            v-if="addingNewItem">
                        </circle-loader>
                        <reached-end-message
                            v-if="!bestSellerNextPage"
                            message="Reached End. There are more items to discover!">
                        </reached-end-message> 
                    </div>
                </div>    
            </keep-alive>
        </div>
        
        <div class="tab-content p-10 h-full overflow-auto small-scroll"
             v-if="inlineTabContentComponent === 'normal-product-on-tab'"
             >
           
           <keep-alive>
                <div class="items-discover grid grids-col-1 gap-10 py-10 mb-10">

                    <component
                        :is=" 'normal-product-on-tab' "
                        v-bind="{ 
                            key : inlineTabNormalProduct.id,
                            id : inlineTabNormalProduct.id,
                            name : inlineTabNormalProduct.name,
                            description : inlineTabNormalProduct.description,
                            basePrice : inlineTabNormalProduct.basePrice,
                            discountedPrice : inlineTabNormalProduct.discountedPrice,
                            discountPercentage : inlineTabNormalProduct.discountPercentage,
                            quantity : inlineTabNormalProduct.availableQuantity,
                            sold : inlineTabNormalProduct.soldQuantity,
                            warranty : inlineTabNormalProduct.warrantyDay,
                            isAvailable : inlineTabNormalProduct.isAvailable,
                            imagePaths : inlineTabNormalProduct.imagesPath,
                            productTags : productTags
                        }"
                    ></component>
                </div>    
            </keep-alive>
        </div>
        
    </div>
</div>

<?= $this->Html->script('vue-component') ?>
<script>
    
    var productAppInstance = null;
    
    const vm = Vue.createApp({
        data() {
            return {
                bestSellerTitle: null,
                bestSellerProducts: Array(),
                bestSellerProductsThumbnail: Array(),
                bestSellerNextPage: null,
                bestSellerPrevPage: null,
                tags: null,
                productTags: null,
                isInlineTabOpen: false,
                inlineTabAnimation: "close-tab",
                inlineTabTitle: null,
                inlineTabContentComponent: null,
                addingNewItem : false,
                isBestSellerThumbnailCreated : false,
                normalProduct: Array(),
                inlineTabNormalProduct : null
            }
        },
        mounted(){
            this.addTagList(),
            this.addBestSellerProduct('/products/show/1', true),
            this.addNormalProduct(),
            this.addProductTags()
        },
                                   
        methods:{
            
            toggleInlineTab(willOpen = true,tabTitle, tabComponentContent = null,
                tabProductContent = null){
                if(willOpen){
                    this.isInlineTabOpen = true;
                    this.inlineTabAnimation = "open-tab";
                    if(tabComponentContent === 'featured-product-card'){
                       this.addBestSellerProduct(this.bestSellerNextPage);
                    }
                    if(tabComponentContent === 'normal-product-on-tab'){
                       this.inlineTabNormalProduct = tabProductContent;
                    }
                }else{
                    this.isInlineTabOpen = false;
                    this.inlineTabAnimation = "close-tab";
                }
                if(tabTitle){this.inlineTabTitle = tabTitle;}
                
                if(tabComponentContent){this.inlineTabContentComponent = tabComponentContent}
                
            },
            async addNormalProduct(page = '/products/show/2'){
                let response = await $.get(page,function(data){return data });
                let data = JSON.parse(response);
                let product = data.product;
                for(var i = 0; i < product.length; i++){
                    this.normalProduct.push(product[i]);
                }
            },
            async addBestSellerProduct(page = '/products/show/1',isThumbnailOnCreate = false){
                if(!this.addingNewItem && this.bestSellerNextPage !== ""){
                    this.addingNewItem = true;
                    let response = await $.get(page,function(data){return data });
                    let data = JSON.parse(response);
                    let product = data.product;
                    let bestSellerData = this.bestSellerProducts;
                    if(isThumbnailOnCreate){bestSellerData = this.bestSellerProductsThumbnail;}
                    for(var i = 0; i < product.length; i++){
                        bestSellerData.push(product[i]);
                    }
                    this.bestSellerNextPage = data.nextPageUrl;
                    this.bestSellerPrevPage = data.previousPageUrl;
                    this.bestSellerTitle = data.requestedProductTypeName;
                    this.addingNewItem = false;
                    if(isThumbnailOnCreate){this.isBestSellerThumbnailCreated = true}
                }
                
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
    vm.component('featured-product-loader',featuredProductLoader),
    vm.component('circle-loader',circleLoader),
    vm.component('reached-end-message',reachedEndMessage),
    vm.component('normal-product-on-tab',{
        props: ['id','name','basePrice','discountedPrice','discountPercentage','quantity',
            'sold','warranty','isAvailable','productTags','description','imagePaths',
            'productTags'],
        template:
            `
            <div class="normal-prod-card-on-tab">
                <div class="prod-card-on-tab-container"
                     style="height: 50vh;">
                    <section  class="prod-card-main-image-container">
                        <img :src="imagePaths[0]" class="prod-card-main-image"
                             />
                    </section>
                    <section class="prod-card-list-image-container small-scroll">
                        <div class="whitespace-nowrap h-full md:h-auto max-w-xs">
                            
                            <div class="prod-card-sec-image-container select-false"
                                v-for="(el, index) in imagePaths">
                                <img :src="imagePaths[index]" class="prod-card-sec-image" 
                                  />
                            </div>
                            
                        </div>
                    </section> 
                </div>
                <div class="prod-card-information-container">
                    <section class="prod-card-main-info">
                        <div class="bg-yellow-300 p-4 flex justify-start
                             flex-col" style="max-height: fit-content">
                            <div>
                                <h3 class="prod-title">{{name}}</h3>
                            </div>
                            <div class="flex justify-center my-3">
                                <s class="prod-base-price">{{'$' + basePrice}}</s>
                                <h4 class="prod-discounted-price">{{'$' + discountedPrice}}</h4>
                                <h6 class="prod-discount-percentage">{{discountPercentage + '%'}}</h6>
                            </div>

                            <div class="prod-action-container">
                                <h5  class="prod-action-buy select-false">BUY NOW</h5>
                                <h5  class="prod-action-cart select-false">
                                    <ion-icon name="cart-outline"class="text-2xl transform rotate-12">
                                    </ion-icon>ADD TO CART
                                </h5>       
                            </div>
                        </div>
                    </section> 
                    <section class="prod-card-sec-info">
                        <h4 class="prod-description"><span class="text-gray-500">
                            Available: </span> {{quantity + ' items'}} </h4>
                        <h4 class="prod-description"><span class="text-gray-500">
                            <span class="info-title">Warranty: </span>{{warranty}}
                            <span v-if="warranty > 1"> days</span>
                            <span v-else> day</span> </h4> 
                        <h4 class="prod-description"><span class="text-gray-500">
                            Sold: </span> {{sold + ' items'}} </h4>
                        <h4 class="prod-description"><span class="text-gray-500">
                            Tags: </span>
                            <span
                            v-for="productTag in productTags">
                                <p v-if="productTag.productId === id"
                                class="inline">
                                    {{productTag.tagName + " "}}
                                </p>        
                            </span>        
                        </h4>
                        
                        <h4 class="prod-description">{{description}} </h4>
                    </section> 
                </div>    
            </div>
            `
    }),
    vm.component('normal-product-card', {
        props: ['id','name','basePrice','discountedPrice','discountPercentage','quantity',
            'sold','warranty','isAvailable','productTags','description','imagePaths'],
        template:
            `
            <div class="overflow-hidden cursor-pointer hover:shadow-lg 
                transition-all flex flex-col justify-between
                bg-yellow-300 p-0">
                                    
                <div>
                    <img :src="imagePaths[0]" class="rounded-none"/>
                </div>
                            
                <div class="flex flex-col justify-between space-y-4 pt-2">
                            
                    <div class="px-2">
                        <h3 class="table m-auto text-center text-lg md:text-xl  tracking-wider 
                          text-gray-900 font-normal line-clamp-2 text-gray-900">
                        {{name}}
                        </h3>
                    </div>
                    
                    <div>
                         <h4 class="table m-auto text-center text-2xl md:text-3xl 
                            font-bold text-gray-900 tracking-widest">{{'$'+discountedPrice}}</h4>           
                    </div>
                    
                    <div  class="flex justify-between">
                        <h6 class="table my-auto text-base md:text-lg line-through 
                            decoration-bg-light"
                            v-if="discountPercentage > 0">{{ '$' + basePrice}}</h6>
                            
                        <h6 class="table my-auto text-base md:text-lg discount-percentage-tag
                            px-2 py-0"
                            v-if="discountPercentage > 0">
                            {{discountPercentage + '%'}}</h6>
                            
                        <h6 class="table my-auto text-base md:text-lg"
                            >{{sold}} sold</h6>        
                            
                    </div>
                </div>    
            </div>
            `,
    }),
    vm.component('featured-product-card', {
        data(){
            return{
                isMoreInfoOpened: false,
                areTagsLoaded: false,
                currentImageIndex: 0,
                imageEffect: null,
                isSliderMoved: false
            }
        },
        
        props: ['id','name','basePrice','discountedPrice','discountPercentage','quantity',
            'sold','warranty','isAvailable','description','imagePaths','productTags'],
        template: 
          `
            <div class="grid grid-cols-1 sm:grid-cols-10 lg:grid-cols-3 gap-5 
                sm:gap-2 overflow-hidden">
                
                
                <div v-if="!isMoreInfoOpened"
                class="small-scroll sm:col-span-full md:col-span-3 
                    lg:col-span-1 h-full overflow-auto  mx-10 md:mx-2 sm:mt-2 px-4
                    transition-all row-start-3 sm:row-start-2 md:row-start-auto
                    max-h-80 direction-rtl hidden sm:block"> 
                <h6 class="line-clamp-4 text-gray-500 text-justify w-full text-lg
                    md:text-xl md:relative md:top-1/4 hover:line-clamp-none 
                    hover:static direction-ltr">
                     {{description}}</h6> 
               
                </div>
                <div v-else
                class="small-scroll sm:col-span-full md:col-span-3 
                    lg:col-span-1 h-full overflow-auto  mx-10 md:mx-2 sm:mt-2 px-4
                    transition-all row-start-3 sm:row-start-2 md:row-start-auto
                    sm:block max-h-96 direction-rtl"> 
                <h6 class="text-gray-500 text-justify w-full text-lg md:text-xl
                    direction-ltr">
                {{description}}</h6> 
                </div>
                
               
                <div class="overflow-hidden sm:col-span-7 md:col-span-5 
                    lg:col-span-1 sm:px-20 md:px-0 row-start-1 md:row-start-auto
                    relative"> 
        
                    <div class="overflow-hidden max-h-96 max-w-xl relative mx-auto" 
                        :class="imageEffect" 
                        style="height:40vh">
                            
                        <section v-for="(el, index) in imagePaths">
                            <img
                            v-if="index === currentImageIndex"    
                            :src="imagePaths[index]" 
                            class="absolute left-2/4 top-2/4 fade-in-out m-auto
                            min-h-full min-w-full"
                            style="transform: translate(-50%, -50%);"/>
                                    
                            <img
                            v-else-if="isSliderMoved"   
                            :src="imagePaths[index]" 
                            class="absolute left-2/4 top-2/4 fade-in-out m-auto
                            min-h-full min-w-full hidden"/>        
                        </section>
                    </div>
                                    
                    <ion-icon name="chevron-forward-outline" 
                        class="absolute inset-y-2/4 right-0 text-5xl shadow-xl 
                        text-red-100 bg-gray-600 select-none block 
                        cursor-pointer opacity-50  hover:opacity-100 
                        rounded-sm p-1 bg-gray-800"
                        
                        v-if="currentImageIndex !== totalImages"      
                        v-on:click="changeSliderImageToNextImage()"></ion-icon>
                            
                    <ion-icon name="chevron-back-outline" 
                        class="absolute inset-y-2/4 left-0 text-5xl shadow-xl 
                            text-red-100 bg-gray-600 cursor-pointer opacity-50 
                            hover:opacity-100 select-none block
                             rounded-sm p-1 bg-gray-800"
                        
                        v-if="currentImageIndex !== 0"     
                        v-on:click="changeSliderImageToNextImage(false)"></ion-icon>
                </div>
                
                <div class="flex flex-col justify-around sm:col-span-3 
                    md:col-span-2 lg:col-span-1 row-start-2 row-start-auto">
                            
                    <section class="flex flex-col justify-center">
                        
                        <h4 v-if="isMoreInfoOpened"
                            class="text-center mb-2 text-2xl 
                            sm:text-2xl md:text-xl lg:text-2xl mx-2 block" 
                            >{{name}}</h4>
                        <h4 v-else
                            class="text-center my-2 text-2xl line-clamp-2 mx-auto
                            sm:text-2xl md:text-xl lg:text-2xl mx-2 block max-w-xl" 
                            >{{name}}</h4>    
                            
                        <span class="flex justify-center py-2 space-x-4">
                            <h2 v-if="discountPercentage > 0"
                                class="text-gray-700 text-xl line-through 
                                decoration-bg-light text-lg md:text-base 
                                lg:text-lg table my-auto">
                                {{ "$" + basePrice }} </h2>    
                                
                            <h2 class="font-bold tracking-widest
                               text-3xl md:text-2xl lg:text-3xl table my-auto">
                                {{ "$" + discountedPrice }} </h2> 
                                
                            <h2 v-if="discountPercentage > 0"
                                class="discount-percentage-tag py-0 px-2  
                                    text-lg md:text-base lg:text-lg table my-auto">
                                {{ discountPercentage + "%" }} </h2>
                            
                        </span>

                        <section class="mt-10 flex flex-col justify-center
                               space-y-2">
                                    
                            <h5 v-if="isAvailable" 
                                class="group btn-default">
                                <ion-icon name='cart-outline'
                                    class="transform rotate-12
                                        group-hover:font-black"> 
                                </ion-icon>add to Cart</h5>
                            
                            <h5 v-else 
                                class="group btn-default">
                                <ion-icon name='balloon-outline'
                                    class="transform rotate-12 
                                        group-hover:font-black"> 
                                </ion-icon> add to Wishlist</h5>

                            <h5 class="text-gray-600 cursor-pointer
                                text-2xl md:text-xl lg:text-2xl text-center
                                transition-all table m-auto hover:underline 
                                hover:text-blue-600 select-none"  
                                v-on:click="moreInfoToggle">
                                        
                                <span v-if="!isMoreInfoOpened">        
                                <ion-icon name="chevron-down-outline"> 
                                </ion-icon>
                                    more information
                                </span>
                                 
                                <span v-if="isMoreInfoOpened"
                                    class="text-lg">        
                                    less information
                                </span> 
                                        
                            </h5>
                        </section>
                    </section>
                    
                    <!--MORE INFORMATION TAB -->
                    <transition name="fade">                    
                    <section
                        class="mt-4"
                        v-if="isMoreInfoOpened">
                            
                        <h5 v-if="isAvailable" 
                            class="group btn-default">
                            Buy now</h5>
                                    
                        <h5 v-else class="text-red-500 text-2xl text-center 
                            tracking-wider table m-auto">
                             Item Unavailble yet 
                        </h5>

                        <section
                            class="mt-5">
                            
                            <div class="grid grid-cols-2 sm:grid-cols-1 
                                lg:grid-cols-2 ">
                              

                            <h5 class="text-xl text-center"><span 
                                class="font-extrabold text-gray-600">
                                Available: </span>{{quantity}} items</h5>

                            <h5 class="text-xl text-center"><span 
                                class="font-extrabold text-gray-600">
                                Sold: </span>{{sold}} items</h5>

                            <h5 class="text-xl text-center">
                                <span 
                                class="font-extrabold text-gray-600">
                                Warranty: </span>{{warranty}}
                                <span v-if="warranty > 1"> days</span>
                                <span v-else> day</span>

                            </h5>

                            <h5  v-if="areTagsLoaded"
                                class="text-xl text-center">
                                <span class="font-extrabold text-gray-600">
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
                    </section>                    
                    </transition>
                    
                </div>
            </div>    
          `,
        
        methods:{
            
            moreInfoToggle(){
                if(!this.areTagsLoaded){
                    this.areTagsLoaded = true;
                }
                this.isMoreInfoOpened = !this.isMoreInfoOpened;
                this.isSliderMoved = true;
            },
            changeSliderImageToNextImage(toNextImage = true){
                this.isSliderMoved = true;
                if(toNextImage){
                    this.currentImageIndex++;
                }else{
                    this.currentImageIndex--;
                }
                this.imageEffect = "fade-in-out";
            }
        },
        computed: {
            totalImages(){
                return  this.imagePaths.length - 1;
            }
        },
        
    }),
    vm.component('filter-tag',filterTag),
    
    productAppInstance = vm.mount("#discover");
</script>