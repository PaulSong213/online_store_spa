<template>

<div class="mb-10">
    
    {{$store.state.lovedProductIds}}
    <div class="hero content">
        
        <div class="">
            <hero-images></hero-images>
        </div>
        
        <div class="my-5 ">
            <filter-tag :tags="tags"></filter-tag>
        </div>
        
    </div>
    
	
    <div class="best-sellers content my-10">
         <div class="bg-white flex mt-20 md:mt-0">
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
                 :tags="product.tags"
                 :image-paths="product.imagesPath"
                 >
                 </featured-product-card>
         </div>

         <h4 class="w-max mx-auto my-16"  
                 v-if="bestSellerProductsThumbnail.length > 0"
                 @click="this.$refs.inlineTab.toggleInlineTab(true,bestSellerTitle,'featured-product-card')"
                 v-cloak>
                 <span class="btn-default text-xl px-10 py-5 bg-transparent">
                         View More Best Sellers</span>
         </h4>

    </div>
	
    <!--    DISCOVER PRODUCT  -->
    <div class="content my-10">
        <div class="mt-20 grid grid-cols-2 md:grid-cols-3 
                 lg:grid-cols-4 gap-2">
            
            <div v-for="product in discoverProduct"
                 class="relative max-w-sm mx-auto">
                <add-favorite
                :product-id="product.id"    
                ></add-favorite>
                <discover-product-card
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
                :product-tags="product.tags"
                :image-paths="product.imagesPath"
                :is-on-tab="false"
                @click="this.$refs.inlineTab.toggleInlineTab(true,' ','discover-product-on-tab',product,
                        null,false,product.tags)"
                >
                   <div> test</div>
                </discover-product-card>
                
            </div>
            
        </div>
        <!--LOADER-->
        <div class="pt-10 pb-20">
            <circle-loader
                    v-if="isAddingHomeItem">
            </circle-loader>
            <reached-end-message
                    v-if="isDiscoverProductReacheadEnd"
                    message="Reached End.">
            </reached-end-message> 
        </div>
    </div>

    <!--INLINE TAB -->
    <inline-tab
    ref="inlineTab"    
    :best-seller-products="bestSellerProducts"
    :loved-products="lovedProducts"
    ></inline-tab>
	
</div>

</template>

<script>

export default {
    data() {
        return {
            bestSellerTitle: null,
            bestSellerProducts: Array(),
            bestSellerThumbnailMaxProduct: 3,
            bestSellerProductsThumbnail: Array(), //items that will show on home which will act as static object (will not change state)
            requestPageInformations: Array(), //consist of request url of next/previous page and page info
            tags: Array(),
            isAddingHomeItem : false,
            isBestSellerThumbnailCreated : false,
            discoverProduct: Array(),
            inlineTabDiscoverProduct : null,
           
            autoOpenBestSellerTab: false,
            lovedProducts: Array() //items that are saved from cookie
        };
    },
    mounted(){
        this.addTagList(),
        //this.handleUrlGetRequest(),
        //this.addBestSellerProduct('/products/show/1?limit=10', true),
        this.addDiscoverProduct('/products/show/2'),
        window.addEventListener('scroll', this.handleScrollDiscover)
	;
    },
    unmounted() {
        window.removeEventListener('scroll', this.handleScrollDiscover); 
    },
    methods:{
      
	async handleUrlGetRequest(){
            if(productIdFromUrlGet){
                let url = "/products/show/null/" + productIdFromUrlGet;
                let response = await $.get(url,function(data){return data });
                let data = JSON.parse(response);
                let hasProduct = data.product.length > 0;

                if(hasProduct){
                    let product = data.product[0];
                    this.$refs.inlineTab.toggleInlineTab(true,'','discover-product-on-tab',product,
                    null,false,product.tags);
                }else{
                    this.$refs.inlineTab.toggleInlineTab(true,'Item Not Found','item-not-found-on-tab',null,
                    null,false,null);
                }
            }else if(autoOpenBestSellerUrlGet && !tagIdFromUrlGet){
                this.autoOpenBestSellerTab = true;
            }
	},
	handleScrollBestSellerTab(event){
            //almost bottom is triggered when the scroll is at 70% (scrollContainer.offsetHeight * 0.7)
            // of the max hieght of grid container when product cards ia attached
            let scrollContainer = this.$refs.bestSellerProductTab;
            let mainContainer = this.$refs.bestSellerProductTabGrid;
            let almostBottomOfContainer = scrollContainer.scrollTop + (scrollContainer.innerHeight || scrollContainer.offsetHeight) > (mainContainer.offsetHeight || mainContainer.innerHeight) * 0.7;
            if(almostBottomOfContainer && !this.addingNewItem){
                if(this.getItemNextPage('Best Sellers') !== ""){
                    this.addBestSellerProduct(this.getItemNextPage('Best Sellers'));
                }else{
                    this.$refs.bestSellerProductTab.removeEventListener('scroll',this.handleScrollBestSellerTab);
                }
            }
	},
	handleScrollDiscover(event) {
            let almostBottomOfWindow = document.documentElement.scrollTop + window.innerHeight > document.documentElement.offsetHeight * 0.7;
 	    //almost bottom = scroll is at position of more 75% of total scoll size
 	    if(this.requestPageInformations['Discover']){
 	    	let nextPage = this.requestPageInformations['Discover'].nextPageUrl;
 	    	if (almostBottomOfWindow && nextPage !== "" && !this.isAddingHomeItem) {
 	    		this.addDiscoverProduct(nextPage);
 	    	}
 	    }
            
        },
        
        async addDiscoverProduct(page = '/products/show/2'){
			this.isAddingHomeItem = true;
            let response = await $.get(page,function(data){return data });
            let data = JSON.parse(response);
            let product = data.product;
            for(var i = 0; i < product.length; i++){
                this.discoverProduct.push(product[i]);
            }
            this.addRequestInformation(data);
            this.isAddingHomeItem = false;
            //this.$refs.inlineTab.toggleInlineTab(true,"",'discover-product-on-tab',product[0]);
        },
        async addBestSellerProduct(page = null,isThumbnailOnCreate = false){
			
            let hasBestSellerNextPage = page !== "";

            if(this.requestPageInformations['Best Sellers']){
                    hasBestSellerNextPage = this.requestPageInformations['Best Sellers'].nextPageUrl !== "";
            }
			
            if(!this.addingNewItem && hasBestSellerNextPage){
				
                this.addingNewItem = true;
                let response = await $.get(page,function(data){return data });
                let data = JSON.parse(response);
                let product = data.product;
				
		//by default item will added to 'bestSellerProduct' which are on the inline tab
		//but if isThumbnailOnCreate is true then the items will be added to 'bestSellerProductsThumbnail'
		//this method makes seperation of thumbnail(static) and inlinetab product (added dynamicaly)
                
                if(isThumbnailOnCreate){
                    let maxThumbnail = this.bestSellerThumbnailMaxProduct 
                    for(var i = 0; i < product.length; i++){
                            if(maxThumbnail > 0){
                                    this.bestSellerProductsThumbnail.push(product[i]);
                            }else{
                                    this.bestSellerProducts.push(product[i]);
                            }
                            maxThumbnail--;
                    }
                    }else{
                            for(var i = 0; i < product.length; i++){
                                    this.bestSellerProducts.push(product[i]);
                            }
                    }

                this.addRequestInformation(data);
                this.bestSellerTitle = data.requestedProductTypeName;
                this.addingNewItem = false;
                if(isThumbnailOnCreate){this.isBestSellerThumbnailCreated = true;}
				if(this.isInlineTabOpen && !isThumbnailOnCreate){this.$refs.bestSellerProductTab.addEventListener('scroll', this.handleScrollBestSellerTab);}
            }
            if(this.autoOpenBestSellerTab){this.$refs.inlineTab.toggleInlineTab(true,this.bestSellerTitle,'featured-product-card');}
        },
		addRequestInformation(requestData){
			var requestInformation = Array();
			requestInformation.nextPageUrl = requestData.nextPageUrl;
			requestInformation.previousPageUrl = requestData.previousPageUrl;
			requestInformation.pageInformation = requestData.pageInformation;
			this.requestPageInformations[requestData.requestedProductTypeName] = requestInformation;
			
		},
        async addTagList(){
            let response = await $.get('/tags/show',function(data){return data });
            this.tags = JSON.parse(response);
            //console.log(this.tags);
            
            if(tagIdFromUrlGet && !productIdFromUrlGet ){
                let isTagExist = false;
                for(var i = 0; i < this.tags.length; i ++){
                    if(tagIdFromUrlGet === this.tags[i].id){
                        this.inlineTabTitle = this.tags[i].name
                        isTagExist = true;
                    }
                }
                if(isTagExist){
                    this.getRelatedToTag(tagIdFromUrlGet,'');
                }else{
                    this.$refs.inlineTab.toggleInlineTab(true,'Item Not Found','item-not-found-on-tab',null,
                    null,false,null);}
            }
        },
	async getRelatedToTag(tagId, tagName,prevData = null){
            this.$refs.inlineTab.modifyUrlParameter("?tag=" + tagId);            
            this.$refs.inlineTab.clearRelatedProductsOfTag();
            this.$refs.inlineTab.addingNewItem = true;
            this.$refs.inlineTab.toggleInlineTab(true,tagName,'discover-product-card-related-tags',
                    this.productsOnRelatedTag,prevData);
            let tagOnProductUrl = '/products-tags/show/' + tagId;
            let response = await $.get(tagOnProductUrl,function(data){return data });
            let listRelated = JSON.parse(response);

            let relatedProductId = [];
            //console.log(listRelated);
            listRelated.forEach((item,index)=>{
                relatedProductId.push(item.productId);
            });

            if(relatedProductId.length > 0){
                let specificProductUrl = '/products/show/null/' + relatedProductId.toString();
                let products = await this.$refs.inlineTab.getSpecificProducts(specificProductUrl);
                this.$refs.inlineTab.productsOnRelatedTag = products;
            }else{
                this.$refs.inlineTab.addingNewItem = false;
            }
            
        },
        isItemReachedEnd(requestItem){
                let isReachedEnd = false;
                if(this.requestPageInformations[requestItem]){
                        isReachedEnd = this.requestPageInformations[requestItem].nextPageUrl === "";
                }
                return isReachedEnd;
        },
        getItemNextPage(requestItem){
                let itemNextPage = "";
                if(this.requestPageInformations[requestItem]){
                        itemNextPage = this.requestPageInformations[requestItem].nextPageUrl;
                }
                return itemNextPage;
        },
        async openFavoriteProducts(){
            console.log('getting data');
            this.$refs.inlineTab.toggleInlineTab(true,"Loved Items",'loved-products',this.lovedProducts);
            if(this.lovedProductIds.length > 0){
                this.addingNewItem = true;
                console.log(this.lovedProductIds.toString());
                let url = "/products/show/null/" + this.lovedProductIds.toString();
                let favoriteProducts = await this.getSpecificProducts(url);
                this.lovedProducts = favoriteProducts;
                this.addingNewItem = false;
            }
            
        },
        closeLovedItemTab() {
            this.$store.commit('closeLovedItemTab');
        }
        
        },
	computed: {
            
            isDiscoverProductReacheadEnd(){
		return this.isItemReachedEnd("Discover");
            },
            isBestSellersProductReacheadEnd(){
		return this.isItemReachedEnd("Best Sellers");
            },
            isLovedProductTabOpen(){
                return this.$store.state.isLovedProductTabOpen;
            },
            lovedProductIds(){
                return this.$store.state.lovedProductIds;
            }    
        },
        watch: {
            isLovedProductTabOpen(isCurrentlyOpened){
                if(isCurrentlyOpened ){
                   this.openFavoriteProducts();
                }
            }
        }
    };
</script>

