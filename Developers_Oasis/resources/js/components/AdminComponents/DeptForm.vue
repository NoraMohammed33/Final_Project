<template>
    <div class="d-flex justify-content-center">
        <v-col cols="auto" class="ms-auto" data-bs-toggle="modal" data-bs-target="#mymodal">
            <v-btn color="green" density="comfortable">
                <i class="fas fa-plus fs-5 me-1"></i>
                Add New Department
            </v-btn>
        </v-col>
    </div>

    <div class="modal fade" id="mymodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered mod" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h3 class="modal-title text-center w-100 fw-bold">Add New Department</h3>
                </div>
                <div class="modal-body">
                    <input type="text" v-model="department_name" class="form-control my-3 border" name="department_name" placeholder="Department Name">
                    <div v-if="errors.department_name" class="text-danger">{{ errors.department_name }}</div>
                    <textarea type="text" v-model="department_description" class="form-control my-3" maxlength="200" name="department_description" placeholder="Department Description"></textarea>
                    <div v-if="errors.department_description" class="text-danger">{{ errors.department_description }}</div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="dismiss" data-bs-dismiss="modal" class="btn btn-secondary text-light" @click="emptyForm">Cancel</button>
                    <button type="button" class="btn btn-primary text-light" id="dismissBtn" @click="saveDepartment()">Save Department</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
    data() {
        return {
            department_name: "",
            department_description: "",
            errors: {},
        };
    },
    methods: {
        saveDepartment() {
            this.errors = {};
            if (this.validateForm()) {
                const formData = new FormData();
                formData.append("name", this.department_name);
                formData.append("description", this.department_description);

                axios
                    .post("http://localhost:8000/api/departments", formData, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    })
                    .then(() => {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Department saved successfully!",
                        });
                        this.$emit("department-saved");
                        const close = document.getElementById("dismiss");
                        close.click();
                        this.emptyForm();
                    })
                    .catch((error) => {
                        console.log(error.response.data);
                    });
            }
        },
        emptyForm() {
            this.department_name = "";
            this.department_description = "";
            this.errors = {};
        },
        validateForm() {
            let isValid = true;
            if (!this.department_name.trim()) {
                this.errors.department_name = "Please enter a name";
                isValid = false;
            }
            if (!this.department_description.trim()) {
                this.errors.department_description = "Please enter a description";
                isValid = false;
            }
            return isValid;
        },
    },
    emits: ["department-saved"],
};
</script>

<style scoped>
</style>
