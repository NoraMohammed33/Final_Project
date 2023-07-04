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
                            <td
                                class="px-6 py-4 "
                            >
                            <router-link :to="'/departments/'+dept.id"
                                         style="text-decoration:none" class="fs-4 fw-bold text-dark" >
                               {{dept.name}}
                            </router-link>
                            </td>
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

                            <!-- Edit Department Icon -->
                            <i
                                class="fas fa-edit fs-4 text-warning mt-3"
                                @click="openUpdateModal(dept)"
                                data-bs-toggle="modal"
                                data-bs-target="#update_modal"
                            ></i>
                            <i class="fas fa-trash fs-4 text-danger ms-4 me-5" @click="deleteDepartment(dept.id)"></i>
                        </tr>
                        </tbody>
                    </table>


        <!-- Update Department Modal -->
        <div
            class="modal fade"
            id="update_modal"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
            tabindex="-1"
            role="dialog"
        >
            <div class="modal-dialog modal-dialog-centered mod" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h3 class="modal-title text-center w-100 fw-bold">Update Department</h3>
                    </div>
                    <div class="modal-body">
                        <input type="text" v-model="department_name" class="form-control my-3 border" name="department_name" placeholder="Department Name">
                        <div v-if="errors.name" class="text-danger">{{ errors.name }}</div>
                        <textarea type="text" v-model="department_description" class="form-control my-3" name="department_description" placeholder="Department Description"></textarea>
                        <div v-if="errors.description" class="text-danger">{{ errors.description }}</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="dismissUpdate" data-bs-dismiss="modal" class="btn btn-secondary text-light">Cancel</button>
                        <button type="button" class="btn btn-primary text-light" @click="updateDepartment">Update Department</button>
                    </div>
                </div>
            </div>
        </div>

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
        departments: [],
        department_name: "",
        department_description: "",
        update_departmentID: null,
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
        },  updateDepartment() {
            const requestData = {
                name: this.department_name,
                description: this.department_description,
            };
            this.errors = {};
            if (this.validateForm()) {
                axios
                    .put("http://localhost:8000/api/departments/" + this.update_departmentID, requestData)
                    .then(() => {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Department updated successfully",
                            confirmButtonColor: "#5cb85c",
                        });
                        this.fetchDepartments();
                        $("#update_modal").modal("hide");
                    })
                    .catch((error) => {
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors;
                        } else {
                            console.log(error.response.data);
                        }
                    });
            }
        },
        openUpdateModal(department) {
            this.update_departmentID = department.id;
            this.department_name = department.name;
            this.department_description = department.description;
            this.errors = {};
            $("#update_modal").modal("show");
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
                            this.fetchDepartments();
                        })
                        .catch((error) => {
                            console.log(error.response.data);
                        });
                }
            });
        },
        validateForm() {
            this.errors = {};
            let isValid = true;
            if (!this.department_name) {
                this.errors.name = "Name is required";
                isValid = false;
            }
            if (!this.department_description) {
                this.errors.description = "Description is required";
                isValid = false;
            }
            return isValid;
        },

        handleDepartmentSaved() {
            this.fetchDepartments();
        },
},

};
</script>

<style scoped>
i:hover{
    scale: 1.2;
    transition: 5ms;
    cursor: pointer;
}
</style>
