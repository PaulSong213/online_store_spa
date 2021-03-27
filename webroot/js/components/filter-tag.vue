<template>
	<h5 class="select-none btn-default bg-transparent inline px-3 
        py-1 text-xl mx-2 shadow-none"
        :id="tagId">{{tagName}}
	</h5>
	
</template>

<script>
export default {
    data() {
        return {
        };
    },
	 props: ['tagName','tagId'],
	
};
</script>

