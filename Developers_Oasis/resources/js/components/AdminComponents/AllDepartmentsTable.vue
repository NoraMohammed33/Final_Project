<template>
    <div>
<v-row>
    <DeptForm @department-saved="handleDepartmentSaved"></DeptForm>

</v-row>
    <v-row>
                    <table class="min-w-full">
                        <thead>
                        <tr>
                            <th
                                class="
                    px-6
                    py-3
                    text-xs
                    font-medium
                    leading-4
                    tracking-wider
                    text-left text-gray-500
                    uppercase
                    border-b border-gray-200
                    bg-gray-50
                  "
                            >
                                Name
                            </th>
                            <th
                                class="
                    px-6
                    py-3
                    text-xs
                    font-medium
                    leading-4
                    tracking-wider
                    text-left text-gray-500
                    uppercase
                    border-b border-gray-200
                    bg-gray-50
                  "
                            >
                                description
                            </th>


                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>

                        </tr>
                        </thead>

                        <tbody class="bg-white">



                        <tr v-for="dept in departments.data" :key="dept">
                            <router-link :to="'/departments/'+dept.id">
                            <td
                                class="px-6 py-4 "
                            >
                               {{dept.name}}
                            </td>
                            </router-link>
                            <td
                                class="
                    px-6
                    py-4
                    text-sm
                    leading-5
                    text-gray-500

                  "
                            >
                                {{ dept.description }}
                            </td>


                            <td class="">
                                <img style="width:20px" src="../../../../public/images/edit-svgrepo-com.png"/>
                            </td>
                            <td>
                                <img style="width:20px" src="../../../../public/images/delete-2-svgrepo-com.png"/>
                            </td>

                        </tr>
                        </tbody>
                    </table>
    </v-row>
    </div>

    <div>

    </div>

</template>

<script  >
import { ref } from "vue";
import axios from "axios";
import DeptForm from "./DeptForm.vue";
export default {

data() {
    return {
departments:[],
        errors: {},
    }
},
    components: {DeptForm}
,
mounted() {
    this.fetchDepartments();
},
    methods: {
        fetchDepartments() {
            axios
                .get("/api/departments")
                .then((response) => {
                    this.departments = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        handleDepartmentSaved() {
            this.fetchDepartments();
        },
},
};
</script>
