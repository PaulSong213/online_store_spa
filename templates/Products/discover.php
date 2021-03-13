<?php
//print_r(json_encode($products));
?>

<div class=" mb-10" id="discover">
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
            :product-tags="product.tags"
            :image-paths="product.imagesPath"
            v-on:click="toggleInlineTab(true,'','normal-product-on-tab',product,
				null,false,product.tags.id)"
			
            >
            </normal-product-card>
            
        </div>
    </div>
    
	<!--INLINE TAB -->
	<transition name="slide-fade">
    <div class="fixed bg-white w-full h-full border-2 border-gray-300 bottom-0 left-2/4
         shadow-2xl overflow-hidden max-w-screen-lg h-screen-90 transform -translate-x-1/2"
		 
		 
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
                    v-if="!bestSellerNextPage"
                    message="Reached End. There are more items to discover!">
                </reached-end-message> 
            </div>
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
                            tags : inlineTabNormalProduct.tags
                        }"
                    ></component>
					<component
                        :is=" 'normal-product' "
						v-for="product in productsOnRelatedTags.product"
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
                            tags : product.tags
                        }"
                    ></component>
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
             v-if="inlineTabContentComponent === 'normal-product-card-related-tags' "
             >
           
           <keep-alive>
                <div class="grid grid-cols-2 md:grid-cols-3 
					lg:grid-cols-4 gap-2">
					
                    <component
                        :is=" 'normal-product-card' "
						v-for="product in productsOnRelatedTags.product"
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
                            tags : product.tags
                        }"
						v-on:click="toggleInlineTab(true,' ', 'normal-product-on-tab',
								product,productsOnRelatedTags.product)"
				
                    ></component>
                </div>    
            </keep-alive>
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
                isInlineTabOpen: false,
                inlineTabAnimation: "close-tab",
                inlineTabTitle: null,
                inlineTabContentComponent: null,
				inlineTabHistoryData: Array(),
                addingNewItem : false,
                isBestSellerThumbnailCreated : false,
                normalProduct: Array(),
                inlineTabNormalProduct : null,
				productsOnRelatedTags: Array()
            }
        },
        mounted(){
            this.addTagList(),
            this.addBestSellerProduct('/products/show/1', true),
            this.addNormalProduct()
        },
                                   
        methods:{
			
            toggleInlineTab(willOpen = true,tabTitle, tabComponentContent = null,
                tabProductContent = null,prevData = null,willBackToHistory = false,
				tagIdsForRelated = []){
				if(prevData){
					var currentTabData = Array();
					currentTabData.tabTitle = this.inlineTabTitle;
					currentTabData.tabComponent = this.inlineTabContentComponent;
                    currentTabData.tabData = prevData;
					this.inlineTabHistoryData.push(currentTabData);
				}
				this.isInlineTabOpen = willOpen;
                if(willOpen){
                    this.inlineTabAnimation = "open-tab";
                    if(tabComponentContent === 'featured-product-card'){
                       this.addBestSellerProduct(this.bestSellerNextPage);
                    }
                    if(tabComponentContent === 'normal-product-on-tab'){
                       this.inlineTabNormalProduct = tabProductContent;
					   console.log(tagIdsForRelated);
					   this.getRelatedToProducts(tagIdsForRelated);
                    }
                }else{
					this.inlineTabHistoryData = Array();
                    this.inlineTabAnimation = "close-tab";
                }
				
                if(tabTitle){this.inlineTabTitle = tabTitle;}
                if(tabComponentContent){this.inlineTabContentComponent = tabComponentContent;}
                if(willBackToHistory){this.inlineTabHistoryData.splice(this.currentHistoryIndex,1);}
            },
            async addNormalProduct(page = '/products/show/2'){
                let response = await $.get(page,function(data){return data });
                let data = JSON.parse(response);
                let product = data.product;
                for(var i = 0; i < product.length; i++){
                    this.normalProduct.push(product[i]);
                }
				//this.toggleInlineTab(true,"",'normal-product-on-tab',product[1]);
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
            
			async getRelatedToTag(tagId, tagName){
				
				this.addingNewItem = true;
				this.productsOnRelatedTags = Array();
				this.toggleInlineTab(true,tagName,'normal-product-card-related-tags',this.productsOnRelatedTags);
				let tagOnProductUrl = '/products-tags/show/' + tagId;
				let response = await $.get(tagOnProductUrl,function(data){return data });
				let listRelated = JSON.parse(response);
				let seperator = ",";
				let listProductId = null;
				//console.log(listRelated);
				for(var i = 0; i < listRelated.length; i++){
					listProductId = listProductId + listRelated[i].productId + seperator;
				}
				//Get Full Details of Products
				if(listProductId){
					let specificProductUrl = '/products/show/null/' + listProductId;
					this.getSpecificProducts(specificProductUrl);	
				}
			},
			async getRelatedToProducts(tagIds = []){
				console.log(tagIds);
				let seperator = ",";
				let formmatedTagIds = tagIds.toString();
				let tagOnProductUrl = '/products-tags/show/' + formmatedTagIds;
				let response = await $.get(tagOnProductUrl,function(data){return data });
				let listRelated = JSON.parse(response);
				console.log(listRelated);
				
			},
			async getSpecificProducts(url){
				let response = await $.get( url,function(data){return data });
				let products = JSON.parse(response);
				this.productsOnRelatedTags = products;
				this.addingNewItem = false;
			}
        },
		computed: {
            currentHistoryIndex(){
				return this.inlineTabHistoryData.length - 1;
			}
        },
    })
    vm.component('featured-product-loader',featuredProductLoader),
    vm.component('circle-loader',circleLoader),
    vm.component('reached-end-message',reachedEndMessage),
    vm.component('normal-product-on-tab',{
		
		data(){
			return{
				mainImageIndex: 0
			}
		},
			
        props: ['id','name','basePrice','discountedPrice','discountPercentage','quantity',
            'sold','warranty','isAvailable','tags','description','imagePaths',
            'tags'],
		
        template:
            `
            <div>
                <div class="md:grid md:grid-cols-10 overflow-hidden gap-10 lg:gap-20
					bg-yellow-900 px-4 py-8 h-screen-50">
		
                    <section  class="relative h-4/5 md:h-full  md:col-span-7 
						overflow-hidden flex flex-col justify-center">
							
                        <img :src="imagePaths[mainImageIndex]" class="relative max-h-full block 
							w-auto m-auto self-center bg-yellow-800"/>
                             
                    </section>
                    <section class="small-scroll overflow-x-auto overflow-y-hidden 
						md:overflow-y-auto md:overflow-x-hidden md:px-5 py-3 relative 
						h-1/5 md:h-full md:col-span-3">
        
                        <div class="whitespace-nowrap h-full md:h-auto max-w-xs">
                            
                            <div class="select-none h-full max-w-lg overflow-hidden 
								inline-block md:h-auto md:mx-2 md:block  cursor-pointer
								transition-all md:w-full mb-2 mr-1"
        
                                v-for="(el, index) in imagePaths">
								
								<img :src="imagePaths[index]"
									v-if="mainImageIndex === index"
									v-on:click="mainImageIndex = index"
									class="h-full md:w-full 
									md:h-auto object-cover m-auto transition-all 
									bg-yellow-800"
									style="filter:blur(2px);"/> 
									
                                <img :src="imagePaths[index]"
									v-else
									v-on:click="mainImageIndex = index"
									class="h-full md:w-full 
									md:h-auto object-cover m-auto transition-all 
									bg-yellow-800 transform hover:scale-105"/> 
                                  
                            </div>
                            
                        </div>
                    </section> 
                </div>
                <div class="grid grid-cols-1 md:grid-cols-10  mt-5 gap-10 md:gap-5">
                    <section class="col-span-full md:col-span-7">
                        <div class="bg-yellow-300 p-4 flex justify-start
                             flex-col max-h-full">
                            <div>
                                <h3 class="text-3xl text-left tracking-wider text-gray-800
								 font-normal text-center">{{name}}</h3>
                            </div>
                            <div class="flex justify-center my-3 items-center">
                                <h6 v-if="discountPercentage > 0"
									class="text-lg md:text-2xl text-red-600 line-through
								    decoration-bg-light mb-8">
									{{'$' + basePrice}}</h6>
										
                                <h4 class="text-5xl md:text-6xl mx-5 text-black">
									{{'$' + discountedPrice}}</h4>
										
                                <h6 v-if="discountPercentage > 0"
									class="discount-percentage-tag text-lg md:text-xl
									 mb-8">
									{{discountPercentage + '%'}}</h6>
										
                            </div>

                            <div v-if="isAvailable" 
								class="flex justify-around">
                                <h5  class="btn-on-tab">
									BUY NOW</h5>
										
                                <h5  class="btn-on-tab">
										
                                    <ion-icon name="cart-outline"
									class="text-2xl transform rotate-12">
									
                                    </ion-icon>ADD TO CART
                                </h5>       
                            </div>
							
							<div v-else 
								class="flex flex-col justify-center w-max mx-auto">
                                <h5  class="btn-on-tab">
									<ion-icon name="balloon-outline" 
									class="text-2xl"> 
                                    </ion-icon>		
									ADD TO WISHLIST</h5>
										
                                <h5  class="text-gray-700 tracking-wider text-xl 
									table m-auto">
                                    Item will be available soon
                                </h5>       
                            </div>
											
                        </div>
                    </section> 
                    <section class="col-span-full md:col-span-3 grid grid-cols-2">
                       
					    <h4 class="text-2xl text-gray-600">
							<span class="text-gray-500">
                            Available: </span> {{quantity + ' items'}} 
						</h4>
									
                        <h4 class="text-2xl text-gray-600">
							<span class="text-gray-500">
								<span class="info-title">Warranty: </span>{{warranty}}
								<span v-if="warranty > 1"> days</span>
								<span v-else> day </span> 
							</span>	
						</h4> 
								
                        <h4 class="text-2xl text-gray-600">
						<span class="text-gray-500">
                            Sold: </span> {{sold + ' items'}}
						</h4>
									
                        <h4 class="text-2xl text-gray-600">
							<span class="text-gray-500">
								<span>Tags: </span>
								<span
									v-for="tag in tags">
									<p 
									class="inline">
										{{tag.name + " "}}
									</p>        
								</span>
							</span>				
                        </h4>
                        
                        <h4 class="text-2xl text-gray-600 col-span-full">
						{{description}} </h4>
										
                    </section> 
                </div>    
            </div>
            `
    }),
    vm.component('normal-product-card', {
        props: ['id','name','basePrice','discountedPrice','discountPercentage','quantity',
            'sold','warranty','isAvailable','tags','description','imagePaths'],
        template:
            `
            <div class="overflow-hidden cursor-pointer hover:shadow-lg 
                transition-all flex flex-col justify-between
                bg-yellow-300 p-0  max-w-sm mx-auto">
                                    
                <div class="overflow-hidden h-60 sm:h-72" >
					<img :src="imagePaths[0]" class="relative left-2/4 top-2/4
						m-auto min-h-full min-w-full transform -translate-x-1/2 
						-translate-y-1/2"/> 				
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
                currentImageIndex: 0,
                imageEffect: null,
                isSliderMoved: false
            }
        },
        
        props: ['id','name','basePrice','discountedPrice','discountPercentage','quantity',
            'sold','warranty','isAvailable','description','imagePaths','tags'],
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
                
				<div class="row-start-1 md:row-start-auto sm:col-span-7 md:col-span-5 
					lg:col-span-1 sm:px-20 md:px-0 ">
					<div class="overflow-hidden relative"> 

						<div class="overflow-hidden max-h-80 sm:max-h-96 
							max-w-lg sm:max-w-xl relative mx-auto
							h-screen-40" 
							:class="imageEffect"> 

							<section v-for="(el, index) in imagePaths">
								<img
								v-if="index === currentImageIndex"    
								:src="imagePaths[index]" 
								class="absolute left-2/4 top-2/4 fade-in-out m-auto
								min-h-full min-w-full transform -translate-x-1/2 
								-translate-y-1/2"/>

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
							cursor-pointer opacity-30  hover:opacity-100 
							rounded-sm p-1 bg-gray-800"

							v-if="currentImageIndex !== totalImages"      
							v-on:click="changeSliderImageToNextImage()"></ion-icon>

						<ion-icon name="chevron-back-outline" 
							class="absolute inset-y-2/4 left-0 text-5xl shadow-xl 
								text-red-100 bg-gray-600 cursor-pointer opacity-30 
								hover:opacity-100 select-none block
								 rounded-sm p-1 bg-gray-800"

							v-if="currentImageIndex !== 0"     
							v-on:click="changeSliderImageToNextImage(false)"></ion-icon>
					</div>
					
					<transition name="slide-left">  
					<!-- PREVIEW IMAGES -->						
					<div v-if="isMoreInfoOpened"
						class="grid grid-cols-6 gap-1 p-1">
						<div v-for="(el, index) in imagePaths" >
							<img
							v-if="index === currentImageIndex"
							:src="imagePaths[index]" 
							class="opacity-60 rounded-sm transition-all"
							/>
							<img
							v-else
							v-on:click="currentImageIndex = index"		
							:src="imagePaths[index]" 
							class="hover:opacity-60 rounded-sm transition-all"
							/>		
						</div>
					</div>
					</transition>				
									
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
                                    class="transform rotate-12 mr-1
                                        group-hover:font-black"> 
                                </ion-icon>add to Cart</h5>
                            
                            <h5 v-else 
                                class="group btn-default">
                                <ion-icon name='balloon-outline'
                                    class="transform rotate-12 
                                        group-hover:font-black"> 
                                </ion-icon> add to Wishlist</h5>

                            <h5 class="text-gray-600 cursor-pointer
                                text-xl md:text-xl lg:text-2xl text-center
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
                            class="group btn-default text-xl">
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

                            <h5 
                                class="text-xl text-center">
                                <span class="font-extrabold text-gray-600">
                                Tags: </span>
                                <span
                                v-for="tag in tags">
                                    <p class="inline">
                                        {{tag.name + " "}}
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