<template>
<!--   <v-container class="fs-4 my-5">-->
<!--<adminheader-component></adminheader-component>-->
<!--   </v-container>-->



<v-container class="d-flex justify-content-center py-5">
<main-component></main-component>
</v-container>

    <footer class="text-center bg-black fixed-bottom">all copy rights saved</footer>
</template>
<script>

import {defineComponent} from "vue";
import AdminheaderComponent from "./AdminHeaderComponent.vue";

export default defineComponent({
    components: {AdminheaderComponent}
})
</script>

