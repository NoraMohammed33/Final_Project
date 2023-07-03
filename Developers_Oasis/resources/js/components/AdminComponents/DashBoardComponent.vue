<template>


<v-container class="d-flex justify-content-center py-5">
    <v-row>

      <adminheader-component class="col-3"></adminheader-component>

<router-view class="col-4 py-5 mx-3"></router-view>
    </v-row>
</v-container>

<!--    <footer class="text-center bg-black fixed-bottom">all copy rights saved</footer>-->
</template>
<script>

import {defineComponent} from "vue";
import AdminheaderComponent from "./AdminHeaderComponent.vue";
import ServicesComponent from "../services/ServicesComponent.vue";
import AllpostsComponent from '../PostComponents/AllpostsComponent.vue';
import departmentlist from '../DepartmentComponents/departmentlist.vue';
import AllExpertsTable from "../AdminComponents/AllExpertsTable.vue";
import ExpertForm from "./ExpertForm.vue";

export default defineComponent({
    components: {AdminheaderComponent,
        ServicesComponent,AllpostsComponent,
        departmentlist,AllExpertsTable,ExpertForm

    }
})
</script>

