<template>
<section class="bg-red-700
         rounded-md p-5 flex justify-between
         align-center py-12" >
    
    <div class="flex space-x-2 w-full">
        <img src="/img/logos/main-logo-white-min.png" alt="logo" 
             class="w-16"/>
        <h1 class="text-gray-100 text-2xl my-auto">PAUL SHOP</h1>
    </div>
    <div class="links flex justify-center space-x-8 align-center w-full">
        <a href="/pages/home" class="nav-link">HOME</a>
        <a href="/pages/home" class="nav-link">SALE</a>
        <a href="/pages/home" class="nav-link">BEST SELLER</a>
    </div>
    <div class="actions flex space-x-8 justify-end w-full">
        <ion-icon name="logo-facebook" class="nav-social"></ion-icon>
        <ion-icon name="logo-instagram" class="nav-social"></ion-icon>
        <ion-icon name="mail" class="nav-social"></ion-icon>
    </div>
</section>
<section class="flex justify-between align-center bg-white shadow-xl rounded-b-md
         p-4">
    <div class="flex space-x-8  w-full">
        <h2 class="block my-auto rounded-full py-2 px-8 bg-red-600 text-gray-100
            text-base tracking-wider cursor-pointer hover:bg-transparent
            border border-red-800 border-opacity-0 transition-all
            hover:text-red-600 hover:border-opacity-100 hover:font-bold
            active:bg-red-800 active:text-gray-100 select-none hover:font-bold table my-auto">
            SIGN UP
        </h2>
               
        <h2 class="block my-auto rounded-full py-2 px-8 text-red-600 font-bold
            text-base tracking-wider bg-transparent border border-red-800
            cursor-pointer transition-all select-none hover:bg-red-800
            hover:text-gray-100 active:bg-transparent active:text-red-600
            hover:font-normal table my-auto">
            SIGN IN
        </h2>
    </div>
    <div class="w-full p-2 flex space-x-2">
        
        <input type="search" class="w-full rounded-md border border-red-700
               outline-none px-4 py-2 text-gray-800 text-base focus:ring-2
               focus:ring-red-600 focus:border-transparent">
        <ion-icon name="search-outline" class="text-red-900 text-3xl 
                  cursor-pointer m-auto" ></ion-icon>
                 
    </div>
    <div class="w-full flex space-x-8 justify-end">
        <div class="my-auto">
            <div class="rounded-full bg-yellow-600 z-20 px-2 py-1 w-max" 
                 style="margin-bottom: -20%;margin-left: -50%;min-height: 1rem">
                <h1 class="text-gray-100 text-base table m-auto leading-4 select-none">
                   0
                </h1>
            </div>
            
            <span title="Your Cart"
                  class="nav-action">
                <ion-icon name="cart"></ion-icon> 
            </span>
        </div>
        <div class="my-auto">
            <div class="rounded-xl bg-yellow-600 z-20 px-2 py-1 w-max" 
                 style="margin-bottom: -20%;margin-left: -50%;min-height: 1rem">
                <h1 class="text-gray-100 text-base table m-auto  leading-4 select-none">
                    {{$store.state.lovedProductIds.length}}
                </h1>
            </div>
            <span title="Loved Product"
                  class="nav-action"
                  v-on:click="openLovedItemTab()">
                <ion-icon name="heart"></ion-icon> 
            </span>
        </div>
    </div>
</section>
</template>


<script>
    export default {
        data() {
            return {
                
            }
        },
        methods: {
            openLovedItemTab() {
                this.$store.commit('openLovedItemTab');
            }
        },
        mounted(){
            this.$store.commit('getLovedItemsOnCookie');
        },
         watch: {
            isLovedProductTabOpen(isCurrentlyOpened){
                if(isCurrentlyOpened){
                   this.openFavoriteProducts();
                }
            }
        }
   };
</script>
