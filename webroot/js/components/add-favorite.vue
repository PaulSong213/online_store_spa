<template>
    <div>
        
        <span v-if="isAdded"
            title="Remove Product from 'Loved'"
            @click="toggleAdd()"
            class="text-red-600 text-3xl font-bold stroke-1
              cursor-pointer  active:text-red-500 
               absolute right-2 z-20"
            >
            <ion-icon name="heart"></ion-icon> 
        </span>
        <span v-else
            title="Add Product to 'Loved'"
            @click="toggleAdd()"
            class="text-gray-300 text-3xl font-bold stroke-1
              cursor-pointer hover:text-red-600 active:text-red-500 
               absolute right-2 z-20 "
            >
            <ion-icon name="heart"></ion-icon> 
        </span>
        
        
    </div>
    
</template>

<script>
    export default {
        data() {
            return {
                isAdded: false
            }
        },
        props: ['productId'],
        methods: {
            toggleAdd(){
                this.isAdded = !this.isAdded;
                console.log(this.isAdded);
                let prevCookieLovedId = JSON.parse(getCookie(this.offlineLovedProductCookie));
                if(this.isAdded){
                    prevCookieLovedId.push(this.productId);
                }else{
                    let index = prevCookieLovedId.indexOf(this.productId);
                    if (index > -1) {
                      prevCookieLovedId.splice(index, 1);
                    }
                }
                setCookie(this.offlineLovedProductCookie,JSON.stringify(prevCookieLovedId),14);
                this.recheckCookieLovedItem();
            },
            recheckCookieLovedItem() {
                this.$store.commit('getLovedItemsOnCookie');
            },
            checkInitinialAddValue(){
                this.isAdded = this.lovedProductIds.indexOf(this.productId) !== -1;
            }
        },
        computed: {
            lovedProductIds(){
                return this.$store.state.lovedProductIds;
            },
            offlineLovedProductCookie(){
                return this.$store.state.offlineLovedProductCookie;
            }
        },
        mounted(){
            this.checkInitinialAddValue()
        }
    };
</script>

