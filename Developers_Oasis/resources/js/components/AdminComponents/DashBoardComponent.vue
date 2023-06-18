<template>
<!--   <v-container class="fs-4 my-5">-->
<!--<adminheader-component></adminheader-component>-->
<!--   </v-container>-->



<v-container class="d-flex justify-content-center py-5">
<router-view></router-view>
</v-container>

    <footer class="text-center bg-black fixed-bottom">all copy rights saved</footer>
</template>
<script>

import {defineComponent} from "vue";
import AdminheaderComponent from "./AdminHeaderComponent.vue";
import ServicesComponent from "../services/ServicesComponent.vue";
import AllpostsComponent from '../PostComponents/AllpostsComponent.vue';
import departmentlist from '../DepartmentComponents/departmentlist.vue';
import ExpertList from "../ExpertComponents/ExpertList.vue";

export default defineComponent({
    components: {AdminheaderComponent,
        ServicesComponent,AllpostsComponent,
        departmentlist,ExpertList

    }
})
</script>

