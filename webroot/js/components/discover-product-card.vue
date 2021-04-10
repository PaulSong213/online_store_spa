<template>
	
    <div class="overflow-hidden cursor-pointer hover:shadow-lg 
        transition-all flex flex-col justify-between
        bg-yellow-300 p-0  max-w-sm mx-auto h-full  z-10"
		ref="discoverProductCard">
								
        <div class="overflow-hidden h-60 sm:h-72">
            
            <img 
               v-if="isOnScreen"
               :src="imagePaths[0]" class="relative left-2/4 top-2/4
               m-auto min-h-full min-w-full transform -translate-x-1/2 
               -translate-y-1/2 select-none"/> 				
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
	
</template>
<script>

export default {
    data() {
        return {
            isOnScreen : false,
	}
    },
    props: ['id','name','basePrice','discountedPrice','discountPercentage','quantity',
        'sold','warranty','isAvailable','tags','description','imagePaths','isOnTab'],
    unmounted() {
        if(this.currentScrollElement){
            this.currentScrollElement.removeEventListener('scroll', this.checkVisibilityScroll);
        }
    },
    mounted(){
        if(this.currentScrollElement){
            this.currentScrollElement.addEventListener('scroll', this.checkVisibilityScroll);
        }
        this.checkVisibilityScroll();
    },

    computed: {
        currentScrollElement(){
            let element = window;
            if(this.isOnTab){element = this.$root.$refs.currentRoute.$refs.inlineTab.$refs.discoverProductTab;}
            return element;
        }	
    },
    methods: {
        checkVisibilityScroll(event){
           
                if(!this.isOnScreen){
                    this.isOnScreen = this.isElementInViewport(this.$refs.discoverProductCard); 
                    //console.log('isOnSCreen :' + this.isElementInViewport(this.$refs.discoverProductCard));
                }else{
                    this.currentScrollElement.removeEventListener('scroll', this.checkVisibilityScroll);
            }
        },
        isElementInViewport(el) {
            var rect = el.getBoundingClientRect();
            let advanceGap = 250;
            //console.log(rect.top >= 0);
            //console.log(rect.left >= 0);
            //console.log(rect.bottom <= (window.innerHeight + advanceGap || document.documentElement.clientHeight + advanceGap));
            //console.log(rect.right <= (window.innerWidth || document.documentElement.clientWidth));
            return (
              rect.top >= 0 &&
              rect.left >= 0 &&
              rect.bottom <= (window.innerHeight + advanceGap || document.documentElement.clientHeight + advanceGap) &&
              rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        },
},	
};
</script>

