<template>
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
					h-screen-40">  
					
					<section v-for="(el, index) in imagePaths">
						<transition name="fade">
						<img
						v-if="index === currentImageIndex"    
						:src="imagePaths[index]" 
						class="absolute left-2/4 top-2/4  m-auto
						min-h-full min-w-full transform -translate-x-1/2 
						-translate-y-1/2 select-none"/>
						
						<img
						v-else-if="isSliderMoved"   
						:src="imagePaths[index]" 
						class="absolute left-2/4 top-2/4  m-auto
						min-h-full min-w-full hidden select-none"/>
						</transition>	
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
					class="opacity-60 rounded-sm transition-all select-none
					min-h-full min-w-full"
					/>
					<img
					v-else
					v-on:click="currentImageIndex = index"		
					:src="imagePaths[index]" 
					class="hover:opacity-60 rounded-sm transition-all select-none
					min-h-full min-w-full"
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
							v-for="(item, index) in tags">
                            <p
							v-on:click="this.$root.getRelatedToTag(item.id, item.name)"	
							class="inline-block hover:underline hover:text-blue-500
								cursor-pointer active:text-purple-900 select-none">
								{{ item.name}}
							</p>
							<span v-if="index != tags.length-1"
								class="select-none"> | </span>		
                        </span>
									
                    </h5>
                    </div>
                </section>
            </section>                    
            </transition>
            
        </div>
    </div>   
	
	
</template>
<script>

export default {
    data() {
        return {
			isMoreInfoOpened: false,
            currentImageIndex: 0,
            isSliderMoved: false		
		}
    },
	 props: ['id','name','basePrice','discountedPrice','discountPercentage','quantity',
        'sold','warranty','isAvailable','description','imagePaths','tags'],
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
        }
    },
    computed: {
        totalImages(){
            return  this.imagePaths.length - 1;
        }
    },
};
</script>
