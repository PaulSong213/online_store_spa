<template>
<div>
    <div class="lg:grid lg:grid-cols-10 overflow-hidden gap-10 lg:gap-20
        bg-yellow-900 px-4 py-8 h-screen-50">
	
        <section  class="h-full  lg:col-span-7 
	overflow-hidden flex flex-col sm:flex-row space-y-4
	sm:space-y-0 sm:space-x-2 max-w-4xl mx-auto">
				
	<div class="h-5/6 sm:h-full sm:w-5/6 p-2 relative overflow-hidden
            max-w-2xl m-auto">
                <img :src="imagePaths[mainImageIndex]" 
		class="relative left-2/4 top-2/4  m-auto min-h-full min-w-full 
                    transform -translate-x-1/2 -translate-y-1/2 select-none 
                    object-cover"/>
        </div>
        <div class="h-1/6 sm:h-full  sm:w-1/6 overflow-x-auto
		max-w-full">
        
		<div class="whitespace-nowrap h-full overflow-y-hidden
                    sm:overflow-x-hidden sm:overflow-y-auto 
                    py-2 mx-auto small-scroll"
                    style="max-width: 80vw">

                    <div class="select-none cursor-pointer transition-all  
                        inline-block sm:block overflow-hidden
                        h-full sm:h-24 md:h-28 sm:w-full 
                        mx-2 sm:mx-0 sm:mb-2"
                        style="max-width: 10rem"
                        v-for="(el, index) in imagePaths">

                        <img :src="imagePaths[index]"
                            v-if="mainImageIndex === index"
                            v-on:click="mainImageIndex = index"
                            class="h-full w-20 sm:w-28 sm:w-full 
                             object-cover m-auto transition-all 
                            bg-yellow-800 select-none"
                            style="filter:blur(2px);"/> 

                        <img :src="imagePaths[index]"
                            v-else
                            v-cloak
                            v-on:click="mainImageIndex = index"
                            class="h-full w-20 sm:w-28 sm:w-full select-none
                             object-cover m-auto transition-all 
                            bg-yellow-800 transform hover:scale-105
                            max-w-xs"/> 

                    </div>
		</div>
			
        </div>
			
        </section>
        <section class="small-scroll lg:h-full lg:col-span-3 pr-6
            hidden  lg:block max-h-full relativer overflow-auto">
		<h4 class="text-xl text-gray-300 text-justify">
		{{description}} </h4>	
       </section> 
        </div>
        <div class="grid grid-cols-1 md:grid-cols-10  mt-5 gap-10 md:gap-5">
            <section class="col-span-full md:col-span-7">
                <div class="bg-yellow-300 p-4 flex justify-start
                     flex-col max-h-full">
                    <div>
                        <h3 class="text-2xl  lg:text-3xl text-left tracking-wider text-gray-800
                            font-normal text-center">{{name}}</h3>
                    </div>
                    <div class="flex justify-center my-3 items-center">
                        <h6 v-if="discountPercentage > 0"
			class="text-base line-through lg:text-xl text-red-600 
                            decoration-bg-light mb-8">
                            {{'$' + basePrice}}</h6>
								
                        <h4 class="text-4xl  lg:text-5xl mx-5 text-black">
                            {{'$' + discountedPrice}}</h4>
                        <h6 v-if="discountPercentage > 0"
                            class="discount-percentage-tag text-base lg:text-xl
				mb-8 px-2 py-1 md:px-4 md:py-2">			 
                            {{discountPercentage + '%'}}</h6>
                    </div>

                    <div v-if="isAvailable" 
			class="flex justify-around">
                        <h5  class="btn-on-tab text-base lg:text-md
                            py-5 px-6 w-max">BUY NOW</h5>
							
								
                        <h5  class="btn-on-tab text-base  lg:text-md
                            py-5 px-6 w-max">
                            <ion-icon name="cart-outline"
                            class="text-base  lg:text-md transform rotate-12">
                            </ion-icon>ADD TO CART
                        </h5>       
                    </div>
					
			<div v-else 
                            class="flex flex-col justify-center mx-auto">
                            <h5  class="btn-on-tab text-base  lg:text-md
				text-center w-max  py-5 px-6">
				<ion-icon name="balloon-outline" 
				class="text-base  lg:text-md"> 
                            </ion-icon>		
                            ADD TO WISHLIST</h5>
								
                        <h5  class="text-gray-700 tracking-wider text-base 
                             text-center">
                            Item will be available soon
                        </h5>       
                    </div>
									
                </div>
            </section> 
            <section class="col-span-full md:col-span-3 grid grid-cols-2 
				md:block">
               
                    <h4 class="text-base md:text-md lg:text-lg text-gray-600">
                    <span class="text-gray-500">
                    Available: </span> {{quantity + ' items'}} 
                    </h4>
							
                <h4 class="text-base md:text-md lg:text-lg text-gray-600">
                    <span class="text-gray-500">
                            <span class="info-title">Warranty: </span>{{warranty}}
                            <span v-if="warranty > 1"> days</span>
                            <span v-else> day </span> 
                    </span>	
		</h4> 
						
                <h4 class="text-base md:text-md lg:text-lg text-gray-600">
                    <span class="text-gray-500">
                    Sold: </span> {{sold + ' items'}}
		</h4>
							
                <h4 class="text-base md:text-md  lg:textlgd text-gray-600">
                    <span class="text-gray-500">
                        <span>Tags: </span>
                        <span
                            v-for="(item, index) in tags">
                            <p
                            v-on:click="this.$root.getRelatedToTag(item.id, item.name,completeData)"	
                            class="inline-block hover:underline hover:text-blue-500
                                    cursor-pointer active:text-purple-900 select-none">
                                    {{ item.name}}

                            </p>
                            <span v-if="index != tags.length-1"
                                    class="select-none"> | </span>		
                        </span>
                    </span>				
                </h4>
		<div class="col-span-full lg:hidden overflow-hidden">					
                    <div class="max-h-96 small-scroll overflow-auto w-10/12
                            md:w-full">
                            <h4 class="text-base text-gray-600">
                            {{description}} </h4>
                    </div>
		</div>					
            </section> 
        </div>    
    </div>
	
</template>
<script>

export default {
    data(){
	return{
            mainImageIndex: 0
	}
	},
	 props: ['id','name','basePrice','discountedPrice','discountPercentage','quantity',
        'sold','warranty','isAvailable','tags','description','imagePaths',
        'tags','completeData'],
};
</script>

