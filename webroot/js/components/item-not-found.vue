<template>
    <div>
        <h2 class="text-center text-2xl md:text-3xl">{{title}}</h2>
        <div>
            <img src="/img/not-found.png" alt="not found image"
                class="w-2/6 block mx-auto max-w-xs"/>
        </div>
        <h2 class="text-center text-base md:text-xl">{{message}}</h2>
    </div>
</template>

<script>
    export default {
        data() {
            return {
            }
        },
        props: ['title','message'],
    };
</script>

