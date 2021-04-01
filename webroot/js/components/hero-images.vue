<template>
  <carousel :items-to-show="1" :wrap-around="true"
    class="h-screen-60 rounded-md" :current-slide="0">
    <slide v-for="image in heroImages" class="bg-red-900 h-screen-50 "
           >
        <img :src="image" alt="thumbnail" 
            class="min-h-full w-full object-cover ">
    </slide>

    <template #addons>
      
      <pagination />
      
    </template>
  </carousel>
</template>

<script>
// If you are using PurgeCSS, make sure to whitelist the carousel CSS classes
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination } from 'vue3-carousel';

export default {
    name: 'App',
    components: {
      Carousel,
      Slide,
      Pagination,

    },
    data() {
        return {
            heroImages: Array(),
            currentSlide: 0,
        }
    },
    mounted(){
        this.getHeroImages();
    },
    methods: {
        async getHeroImages(url = "/thumbnails/show/1"){
            let response = await $.get(url,function(data){return data });
            let data = JSON.parse(response);
            
            if(data.length > 0){
                let images = data[0].images;
                for(var i = 0; i <  images.length; i++){
                    this.heroImages[i] =  images[i].filePath;
                }
            }
        }
    }
};
</script>