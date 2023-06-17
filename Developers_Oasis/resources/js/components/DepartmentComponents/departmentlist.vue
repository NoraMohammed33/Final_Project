<template>
    <div>
        <!-- Add Department Component -->
        <AddDepartmentComponent @department-saved="handleDepartmentSaved"></AddDepartmentComponent>

        <div class="d-flex flex-wrap justify-content-center mx-auto px-5">
            <template v-for="department in departments.data" :key="department.id">
                <v-card class="col-8 col-sm-5 col-md-4 col-lg-3 m-3 rounded-4">
                    <v-card-text>
                        <h2 class="font-weight-bold text-orange mb-2">{{ department.name }}</h2>
                        <div class="text-grey">{{ department.description }}</div>
                    </v-card-text>

                    <v-card-actions>
                        <v-btn id="explore" color="blue" class="border rounded-2" @click="exploreDepartment(department.id)">Explore</v-btn>

                        <div class="ms-auto">
                            <!-- Edit Department Icon -->
                            <i
                                class="fas fa-edit fs-4 text-warning"
                                @click="openUpdateModal(department)"
                                data-bs-toggle="modal"
                                data-bs-target="#update_modal"
                            ></i>
                            <!-- Delete Department Icon -->
                            <i class="fas fa-trash fs-4 text-danger ms-4" @click="deleteDepartment(department.id)"></i>
                        </div>
                    </v-card-actions>
                    <div v-if="department.experts && department.experts.length > 0">
                        <h4 class="font-weight-bold mt-3">Experts</h4>
                        <div v-for="expert in department.experts" :key="expert.id">
                            <h5>{{ expert.user.name }}</h5>
                            <p>{{ expert.bio }}</p>
                        </div>
                    </div>
                </v-card>
            </template>
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
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
import AddDepartmentComponent from "./AddDepartmentComponent.vue";
import "@fortawesome/fontawesome-free/css/all.css";

export default {
    data() {
        return {
            experts:[],
            departments: [],
            department_name: "",
            department_description: "",
            update_departmentID: null,
            errors: {},
        };
    },
    components: {
        AddDepartmentComponent,
    },
    mounted() {
        this.fetchAllDepartments();
    },
    methods: {
        exploreDepartment(id) {
            // Make an API request to explore the department and its experts
            axios
                .get(`/api/departments/${id}/explore`)
                .then(response => {
                    const department = response.data.department;
                    const experts = response.data.experts;
                    // Handle the department and experts data
                    this.experts = experts;
                    this.$router.push({ path: `/departments/${department.id}` });
                    console.log(department);
                    console.log(experts);
                })
                .catch(error => {
                    console.error(error);
                });
        },
        handleDepartmentSaved() {
            this.fetchAllDepartments();
        },
        fetchAllDepartments() {
            axios
                .get("api/departments")
                .then((response) => {
                    this.departments = response.data;
                })
                .catch((error) => {
                    console.log(error.response.data);
                });
        },
        updateDepartment() {
            const requestData = {
                name: this.department_name,
                description: this.department_description,
            };
            this.errors = {};
            if (this.validateForm()) {
                axios
                    .put("api/departments/" + this.update_departmentID, requestData)
                    .then(() => {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Department updated successfully",
                            confirmButtonColor: "#5cb85c",
                        });
                        this.fetchAllDepartments();
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
                        .delete("api/departments/" + departmentID)
                        .then(() => {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: "Department deleted successfully",
                                confirmButtonColor: "#5cb85c",
                            });
                            console.log(departmentID);
                            this.fetchAllDepartments();
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
    },

};
</script>

<style>
.image-container {
    position: relative;
}

.hover-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(60, 100, 120, 0.8);
    color: white;
    opacity: 0;
    transition: opacity 0.3s;
}

.image-container:hover .hover-overlay {
    opacity: 1;
}
i:hover{
    scale: 1.2;
    transition: 5ms;
    cursor: pointer;
}
#explore:hover{
    background-color: #e2e8f0;

}
</style>
