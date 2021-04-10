<template>
    <transition name="inline-tab-slide-fade">
    <div class="fixed bg-white w-full h-full border-2 border-gray-300 bottom-0 left-2/4
        shadow-2xl overflow-hidden max-w-screen-lg h-screen-90 transform -translate-x-1/2
        z-40"
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
                              @click="toggleInlineTab(true,inlineTabHistoryData[currentHistoryIndex].tabTitle,
                                      inlineTabHistoryData[currentHistoryIndex].tabComponent,
                                      inlineTabHistoryData[currentHistoryIndex].tabData,
                                      null,true)"	
                      ></ion-icon>
                      <h1 class="my-auto font-bold text-3xl tracking-widest"
                              v-cloak>
                              {{inlineTabTitle}}
                      </h1>
              </div>
              <section @click="toggleInlineTab(false)"
                    class="border border-gray-300 border-opacity-0 hover:text-white
                        hover:border-opacity-100 hover:shadow-xl hover:bg-yellow-900 
                        transition-all p-1 rounded-full text-5xl text-gray-700 
                        font-bold  cursor-pointer">
                      <ion-icon name="close-outline"></ion-icon> 
              </section>
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
                               @click="toggleInlineTab(true,' ','discover-product-on-tab',product,
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
                       @click="toggleInlineTab(true,' ','discover-product-on-tab',product,
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

            <div class="tab-content p-10 h-full overflow-auto small-scroll"
                 v-if="inlineTabContentComponent === 'item-not-found-on-tab' "
                 >
                 <item-not-found
                 title="We Cannot Find the URL you requested"
                 message="This may be cause of broken link or the Item you requested
                        is deleted"
                 ></item-not-found>
            </div>   
        
            <div class="tab-content p-10 h-full overflow-auto small-scroll"
                 v-if="inlineTabContentComponent === 'loved-products' "
                 >

               <div class="grid grid-cols-2 md:grid-cols-3 
                       lg:grid-cols-4 gap-2">
                       <keep-alive>
                       <div v-for="product in lovedProducts.product"
                            class="relative  max-w-sm mx-auto">    
                       <add-favorite
                        :product-id="product.id"    
                        ></add-favorite>     
                       <component
                       :is=" 'discover-product-card' "
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
                       @click="toggleInlineTab(true,' ','discover-product-on-tab',product,
                               productsOnRelatedTag.product,false,product.tags)"
                       ></component>
                       </div>    
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
</template>

<script>
    export default {
        data() {
            return {
                isInlineTabOpen: false,
                inlineTabTitle: null,
                inlineTabContentComponent: null,
                inlineTabHistoryData: Array(),
                addingNewItem : false,
                productsOnRelatedTag: Array(),
                productsOnRelatedProduct: Array(),
            }
        },
        props:['bestSellerProducts', 'lovedProducts'],
           
        methods: {
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
                        if(tabComponentContent === 'featured-product-card' && 
                                this.getItemNextPage('Best Sellers') !== ""){
                                this.modifyUrlParameter("?bestseller=1");
                                this.addBestSellerProduct(this.getItemNextPage('Best Sellers'));

                        }

                        //get related products of current item
                        if(tabComponentContent === 'discover-product-on-tab'){
                           this.modifyUrlParameter("?product=" + tabProductContent.id); 
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
                        this.modifyUrlParameter();
                        this.$root.$refs.currentRoute.closeLovedItemTab();
                    }
                    if(tabComponentContent){this.inlineTabContentComponent = tabComponentContent;}
                    if(tabTitle){this.inlineTabTitle = tabTitle;}
                    
            },
            clearHistoryData(){this.inlineTabHistoryData = Array();},
            clearRelatedProductsOfProduct(){this.productsOnRelatedProduct = Array();},
            clearRelatedProductsOfTag(){this.productsOnRelatedTag = Array();},
            modifyUrlParameter(param = ""){
                const newUrl = location.pathname + param;
                window.history.pushState({"html": "","pageTitle":""},"", newUrl);
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
            scrollToTop(el = '.tab-content'){$(el).scrollTop(0);},
        },
        computed: {
            currentHistoryIndex(){
                return this.inlineTabHistoryData.length - 1;
            },
        }
    };
</script>

