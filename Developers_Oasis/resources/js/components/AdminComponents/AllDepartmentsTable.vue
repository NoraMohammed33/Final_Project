<template>
    <v-container>
        <v-row>

    <DeptForm @department-saved="handleDepartmentSaved"></DeptForm>

        </v-row>

    <v-row>
                    <table class="min-w-full w-100">
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
                    bg-gray-50
                  "
                            >
                                description
                            </th>


                            <th class="px-6 py-3  bg-gray-50"></th>
                            <th class="px-6 py-3  bg-gray-50"></th>

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


                            <i class="fas fa-edit fs-4 text-warning"></i>
                            <i class="fas fa-trash fs-4 text-danger ms-4 me-5" @click="deleteDepartment(dept.id)"></i>
                        </tr>
                        </tbody>
                    </table>
    </v-row>
    </v-container>

    <div>

    </div>

</template>

<script  >
import { ref } from "vue";
import axios from "axios";
import Swal from "sweetalert2";
import DeptForm from "./DeptForm.vue";
import "@fortawesome/fontawesome-free/css/all.css";
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
        deleteDepartment(departmentID) {
            Swal.fire({
                icon: "warning",
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: "#d9534f",
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete("http://localhost:8000/api/departments/" + departmentID)
                        .then(() => {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: "Department deleted successfully",
                                confirmButtonColor: "#5cb85c",
                            });
                            this.fetchAllDepartments();
                        })
                        .catch((error) => {
                            console.log(error.response.data);
                        });
                }
            });
        },
        handleDepartmentSaved() {
            this.fetchDepartments();
        },
},
};
</script>
