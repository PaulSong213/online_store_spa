<template>
	
	<div class="mb-10" id="discover">
		
		<div class="flex justify-between flex-col-reverse md:flex-row my-5">
			<h6 class="my-auto font-bold text-xl text-gray-500">PAUL SHOP</h6>
			<div class="text-justify w-full md:w-2/3 lg:w-2/4 transition-all
				 md:text-right m-2">
				<filter-tag 
				v-for="tag in tags"
				v-on:click="getRelatedToTag(tag.id, tag.name)"
				:key="tag.id"
				:tag-name="tag.name"
				:tag-id="tag.id"
				></filter-tag>
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
				v-on:click="toggleInlineTab(true,bestSellerTitle,'featured-product-card')"
				v-cloak>
				<span class="btn-default text-xl px-10 py-5 bg-transparent">
					View More Best Sellers</span>
			</h4>

		</div>
		
		<!--    DISCOVER PRODUCT  -->
		<div class="content my-10">
			<div class="mt-20 grid grid-cols-2 md:grid-cols-3 
				 lg:grid-cols-4 gap-2">

				<discover-product-card
				v-for="product in discoverProduct"
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
				v-on:click="toggleInlineTab(true,' ','discover-product-on-tab',product,
					null,false,product.tags)"

				>
				</discover-product-card>
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
		<transition name="inline-tab-slide-fade">
		<div class="fixed bg-white w-full h-full border-2 border-gray-300 bottom-0 left-2/4
			 shadow-2xl overflow-hidden max-w-screen-lg h-screen-90 transform -translate-x-1/2"
			 id="inlineTab"

			v-if="isInlineTabOpen">
			<div class="tab-head flex justify-between shadow-2xl p-5">
				<div class="flex space-x-4">
					<!--currentHistoryIndex-->
					<ion-icon
						v-if="inlineTabHistoryData.length > 0"
						name="return-down-back-outline" 
						class="border border-gray-300 border-opacity-0 hover:text-white
							hover:border-opacity-100 hover:shadow-xl hover:bg-yellow-900 
							transition-all p-1 rounded-full text-5xl text-gray-700 
							font-bold  cursor-pointer mx-4"  
						v-on:click="toggleInlineTab(true,inlineTabHistoryData[currentHistoryIndex].tabTitle,
							inlineTabHistoryData[currentHistoryIndex].tabComponent,
							inlineTabHistoryData[currentHistoryIndex].tabData,
							null,true)"	
					></ion-icon>
					<h1 class="my-auto font-bold text-3xl tracking-widest"
						v-cloak>
						{{inlineTabTitle}}
					</h1>
				</div>
				<span v-on:click="toggleInlineTab(false)">
					<ion-icon name="close-outline" 
						class="border border-gray-300 border-opacity-0 hover:text-white
							hover:border-opacity-100 hover:shadow-xl hover:bg-yellow-900 
							transition-all p-1 rounded-full text-5xl text-gray-700 
							font-bold  cursor-pointer"    
					></ion-icon>
				</span>
			</div>

			<div class="tab-content p-10 h-full overflow-auto small-scroll"
				 ref="bestSellerProductTab"
				 v-if="inlineTabContentComponent === 'featured-product-card'">
				<keep-alive>
					<div class="items-discover grid grids-col-1 gap-10 py-10 mb-10"
						 ref="bestSellerProductTabGrid">
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
								tags : product.tags,
								imagePaths : product.imagesPath,
							}"
						></component>

					</div>    
				</keep-alive>

				<!--LOADER-->
				<div class="pt-10 pb-20">
					<circle-loader
						v-if="addingNewItem">
					</circle-loader>
					<reached-end-message
						v-if="isBestSellersProductReacheadEnd"
						message="Reached End. There are more items to discover!">
					</reached-end-message> 
				</div>
			</div>

			<div class="tab-content p-10 h-full overflow-auto small-scroll"
				 v-if="inlineTabContentComponent === 'discover-product-on-tab'"
				 ref="discoverProductTab"
				 >

			   <keep-alive>
					<div class="items-discover grid grids-col-1 gap-10 py-10 mb-10">

						<component
							:is=" 'discover-product-on-tab' "
							v-bind="{ 
								key : inlineTabDiscoverProduct.id,
								id : inlineTabDiscoverProduct.id,
								name : inlineTabDiscoverProduct.name,
								description : inlineTabDiscoverProduct.description,
								basePrice : inlineTabDiscoverProduct.basePrice,
								discountedPrice : inlineTabDiscoverProduct.discountedPrice,
								discountPercentage : inlineTabDiscoverProduct.discountPercentage,
								quantity : inlineTabDiscoverProduct.availableQuantity,
								sold : inlineTabDiscoverProduct.soldQuantity,
								warranty : inlineTabDiscoverProduct.warrantyDay,
								isAvailable : inlineTabDiscoverProduct.isAvailable,
								imagePaths : inlineTabDiscoverProduct.imagesPath,
								tags : inlineTabDiscoverProduct.tags,
								completeData : inlineTabDiscoverProduct
							}"
						></component>
						<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2
							 auto-rows-max">
						<div v-for="product in productsOnRelatedProduct.product"
							 class="remove-if-empty h-full">	
							<component
								:is=" 'discover-product-card' "
								v-if="product.id !== inlineTabDiscoverProduct.id"
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
									imagePaths : product.imagesPath,
									tags : product.tags,
									isOnTab : true
								}"
								v-on:click="toggleInlineTab(true,' ','discover-product-on-tab',product,
									inlineTabDiscoverProduct,false,product.tags)"
							></component>
						</div>		
						</div>	
					</div>    
				</keep-alive>
				<!--LOADER-->
				<div class="pt-10 pb-20">
					<circle-loader
						v-if="addingNewItem">
					</circle-loader>
				</div>
			</div>

			<div class="tab-content p-10 h-full overflow-auto small-scroll"
				 v-if="inlineTabContentComponent === 'discover-product-card-related-tags' "
				 ref="discoverProductTab"
				 >

					<div class="grid grid-cols-2 md:grid-cols-3 
						lg:grid-cols-4 gap-2">

						<keep-alive>
						<component

							:is=" 'discover-product-card' "
							v-for="product in productsOnRelatedTag.product"
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
								imagePaths : product.imagesPath,
								tags : product.tags,
								isOnTab : true
							}"
							v-on:click="toggleInlineTab(true,' ','discover-product-on-tab',product,
								productsOnRelatedTag.product,false,product.tags)"
						></component>
						</keep-alive>
					</div>

				<!--LOADER-->
				<div class="pt-10 pb-20">
					<circle-loader
						v-if="addingNewItem">
					</circle-loader>
				</div>

			</div>

		</div>
		</transition>
		
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
            tags: null,
            isInlineTabOpen: false,
            inlineTabTitle: null,
            inlineTabContentComponent: null,
			inlineTabHistoryData: Array(),
            addingNewItem : false,
			isAddingHomeItem : false,
            isBestSellerThumbnailCreated : false,
            discoverProduct: Array(),
            inlineTabDiscoverProduct : null,
			productsOnRelatedTag: Array(),
			productsOnRelatedProduct: Array()
        };
    },
	mounted(){
        this.addTagList(),
        this.addBestSellerProduct('/products/show/1?limit=10', true),
        this.addDiscoverProduct('/products/show/2'),
		window.addEventListener('scroll', this.handleScrollDiscover);	
	
    },
	unmounted() {
       window.removeEventListener('scroll', this.handleScrollDiscover); 
    },
	methods:{
			handleScrollBestSellerTab(event){
				console.log('best seller scroll event');
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
            toggleInlineTab(willOpen = true,tabTitle, tabComponentContent = null,
                tabProductContent = null,prevData = null,willBackToHistory = false,
				tagIdsForRelated = []){
					
				if(prevData){
					var currentTabData = Array();
					currentTabData.tabTitle = this.inlineTabTitle;
					currentTabData.tabComponent = this.inlineTabContentComponent;
                    currentTabData.tabData = prevData;
					this.inlineTabHistoryData.push(currentTabData);
					this.scrollToTop();
				}
				if(willBackToHistory){
					this.clearRelatedProductsOfProduct();
					this.inlineTabTitle = null;
					this.inlineTabHistoryData.splice(this.currentHistoryIndex,1);
					this.scrollToTop();
				}
				this.isInlineTabOpen = willOpen;
                if(willOpen){
                    if(tabComponentContent === 'featured-product-card' && this.getItemNextPage('Best Sellers') !== ""){
						this.addBestSellerProduct(this.getItemNextPage('Best Sellers'));
                    }
					
					//get related products of current item
                    if(tabComponentContent === 'discover-product-on-tab'){
                       this.inlineTabDiscoverProduct = tabProductContent;
					   let tagIds = [];
					   tagIdsForRelated.forEach((item,index)=>{
						   tagIds.push(item.id);
					   });
					   if(tagIds.length > 0){
					      this.getRelatedToProducts(tagIds);
					   }
                    }
                }else{
					this.clearHistoryData();
					this.clearRelatedProductsOfTag(); 
                }
				if(tabComponentContent){this.inlineTabContentComponent = tabComponentContent;}
                if(tabTitle){this.inlineTabTitle = tabTitle;}
                
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
				//this.toggleInlineTab(true,"",'discover-product-on-tab',product[0]);
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
            },
			async getRelatedToTag(tagId, tagName,prevData = null){
				this.clearRelatedProductsOfTag();
				this.addingNewItem = true;
				this.toggleInlineTab(true,tagName,'discover-product-card-related-tags',
					this.productsOnRelatedTag,prevData);
				let tagOnProductUrl = '/products-tags/show/' + tagId;
				let response = await $.get(tagOnProductUrl,function(data){return data });
				let listRelated = JSON.parse(response);
				
				let relatedProductId = [];
				//console.log(listRelated);
				listRelated.forEach((item,index)=>{
					relatedProductId.push(item.productId);
				});

				if(relatedProductId){
					let specificProductUrl = '/products/show/null/' + relatedProductId.toString();
					let products = await this.getSpecificProducts(specificProductUrl);
					this.productsOnRelatedTag = products;
				}
			},
			async getRelatedToProducts(tagIds = []){
				
				this.clearRelatedProductsOfProduct();
				this.addingNewItem = true;
				let formmatedTagIds = tagIds.toString();
				let tagOnProductUrl = '/products-tags/show/' + formmatedTagIds;
				let response = await $.get(tagOnProductUrl,function(data){return data });
				let listRelated = JSON.parse(response);
				let relatedProductId = [];
				listRelated.forEach((item, index)=>{
					relatedProductId.push(item.productId);
				});
				let filteredRelatedProductId = remove_duplicates_es6(relatedProductId);
				
				if(filteredRelatedProductId){
					let relatedProductUrl = '/products/show/null/' + filteredRelatedProductId.toString();
					let products = await this.getSpecificProducts(relatedProductUrl);
					this.productsOnRelatedProduct = products;
					//console.log(this.productsOnRelatedProduct);
				}
				
			},
			async getSpecificProducts(url){
				let response = await $.get( url,function(data){return data });
				let products = JSON.parse(response);
				this.addingNewItem = false;
				return products;
			},
			clearRelatedProductsOfProduct(){this.productsOnRelatedProduct = Array();},
			clearRelatedProductsOfTag(){this.productsOnRelatedTag = Array();},
			clearHistoryData(){this.inlineTabHistoryData = Array();},
			scrollToTop(el = '.tab-content'){$(el).scrollTop(0);},
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
			}
			
        },
		computed: {
            currentHistoryIndex(){
				return this.inlineTabHistoryData.length - 1;
			},
			isDiscoverProductReacheadEnd(){
				return this.isItemReachedEnd("Discover");
			},
			isBestSellersProductReacheadEnd(){
				return this.isItemReachedEnd("Best Sellers");
			}
        },
};
</script>

