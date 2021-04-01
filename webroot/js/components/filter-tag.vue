<template>
    <div class="relative">
        
        <ion-icon name="chevron-forward-outline" 
            class="absolute inset-y-2/4 -right-5 top-1/4 text-6xl shadow-xl 
            text-gray-700  select-none block 
            cursor-pointer opacity-50  hover:opacity-100 
            hover:bg-gray-500 rounded-sm"
            v-on:click="tagsContainerScrollToLeft()"
        ></ion-icon>
        
        <ion-icon name="chevron-back-outline" 
            class="absolute inset-y-2/4 -left-5 top-1/4 text-6xl shadow-xl 
            text-gray-700  select-none block 
            cursor-pointer opacity-50  hover:opacity-100 
            hover:bg-gray-500 rounded-sm"
           v-on:click="tagsContainerScrollToLeft(false)"
        ></ion-icon>
        
        <div class=" w-full h-32 overflow-y-visible overflow-x-auto whitespace-nowrap
            small-scroll pb-2 px-8"
            ref="tagsContainer"
            style="scroll-behavior: smooth;">
            
        <div class="p-2  w-40 h-full min-h-full inline-block mr-4 
            bg-white hover:bg-yellow-300 select-none cursor-pointer  
            rounded-md border border-2 border-gray-400 hover:border-opacity-0
            active:bg-red-900 active:text-gray-100"
            v-for="tag in tags"
            v-on:click="this.$parent.getRelatedToTag(tag.id, tag.name)" 
            >
            <img :src="tag.logo_path" alt="tag logo" class="h-10 block mx-auto" /> 

            <h5 class="text-xl  text-center block my-5 font-black"
                style="color: inherit"
            >{{tag.name}}
            </h5>
        </div>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tagsContainerPrevScrollLeft: 0,
            scrollSpeed: 100
        };
    },
    props: ['tags'],
    
    methods: {
        tagsContainerScrollToLeft(toLeft = true){
            const container =  this.$refs.tagsContainer;
            let newVerticalScroll = 0;
            let scrollLength = container.offsetWidth * 0.8;
            if(toLeft){
                newVerticalScroll = container.scrollLeft + scrollLength;
            }else{
                newVerticalScroll = container.scrollLeft - scrollLength;
            }
            container.scrollTo(newVerticalScroll,0);
        }
    },
	
};
</script>

