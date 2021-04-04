<template>
    <vueper-slides
        v-if="formmatedTags.length > 1"
        class="no-shadow py-2"
        lazy lazy-load-on-drag
        :slide-ratio="1 / 14"
        :gap="1"
        slide-multiple
        :visible-slides="10.5"
        :bullets="false"
        :dragging-distance="50"
        :breakpoints="breakpoints"
        :arrows="false"
        >
        <vueper-slide v-for="tag in formmatedTags"
                      :key="tag.id" 
                      :content=" tag.content "
                      v-on:click="this.$parent.getRelatedToTag(tag.id, tag.name)" 
                      class="mr-4 bg-white hover:bg-yellow-300 select-none cursor-pointer  
                        rounded-md border border-2 border-gray-400 hover:border-opacity-0
                        active:bg-red-900 text-gray-600 active:text-gray-100"/>
        
    </vueper-slides>
    
</template>
<style>
    .vueperslides__arrow{
        color: #666666;
    }
    .vueperslides__arrow:hover{
        background-color: transparent;
        color: #660000;
    }
    .vueperslides__arrow:focus{
        background-color: transparent;
        color: #666666;
    }
    
    .vueperslide__content-wrapper:not(.vueperslide__content-wrapper--outside-top):not
    (.vueperslide__content-wrapper--outside-bottom) {
        paddding: 4px;
    }
    
</style>
<script>
export default {
    data() {
        return {
            isAtLargeScreen: screen.width > 1023,
            formmatedTags: Array(),
            breakpoints: {
                1200: {
                  slideRatio: 1 / 14,
                  visibleSlides: 8.5
                },
                900: {
                  slideRatio: 1 / 13,
                  visibleSlides: 6.5
                },
                600: {
                  slideRatio: 1 / 12,
                  visibleSlides: 4.5,
                },
                
            },
        };
    },
    props: ['tags'],
    watch: { 
      	tags(tagList, oldVal) { 
          for(var i = 0; i < tagList.length; i++){
              let htmlContent = `
                    <div class="">
                    <img src=" ` + tagList[i].logo_path +` " alt="tag logo"
                        class="h-10 mx-auto hidden lg:block"
                        v-if="isAtLargeScreen"
                        />
                    <h3 class="text-base md:text-xl  text-cen col-span-7ter block my-5 
                        line-clamp-2"
                        style="color:inherit"> 
                        ` + tagList[i].name + ` </h3>
                    </div>    
                `;
              
              let buttonContent = {id:tagList[i].id,name:tagList[i].name,content:htmlContent};
              this.formmatedTags.push(buttonContent);
          }
          
        }
    },
    methods: {
        
    },
	
};
</script>

