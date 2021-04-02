<template>
<vueper-slides
    v-if="heroImages.length > 1"
    class="bg-gradient-to-r from-red-900 via-red-700 to-red-900
        rounded-md overflow-hidden"
    lazy lazy-load-on-drag
    autoplay
    :pause-on-hover="true"
    :dragging-distance="50"
    :breakpoints="breakpoints"
    :gap="1"
    :arrows="false"
    :slide-ratio="2/5"
    >
    <vueper-slide v-for="(slide, i) in heroImages"
      :key="i"
      :image="slide.imagePath"
      :content="slide.content"
     />
</vueper-slides>
</template>

<style>
    .vueperslides__bullet:hover{
        background-color: transparent;
    }
    .vueperslides__bullet:focus{
        background-color: transparent;
    }
</style>
<script>



export default {
    name: 'App',
    data() {
        return {
            heroImages: Array(),
            pauseOnHover: true,
            autoPlaying: true,
            internalAutoPlaying: false,
            breakpoints: {
                1200: {
                  slideRatio: 2 / 5
                },
                750: {
                   slideRatio: 3 / 5
                },
                600: {
                  slideRatio: 4/5,
                },
                
            },
        }
    },
    mounted(){
        this.getHeroImages()
    },
    methods: {
        async getHeroImages(url = "/thumbnails/show/1"){
            let response = await $.get(url,function(data){return data });
            let data = JSON.parse(response);
            
            if(data.length > 0){
                let images = data[0].images;
                for(var i = 0; i <  images.length; i++){
                    let heroImage = {imagePath: images[i].filePath, content: ""}
                    this.heroImages.push(heroImage);
                }
            }
        }
    }
};
</script>