<template>
    <div>
        <div class="input-container">
            <input v-model="searchQuery" @input="fetchDepartments"  type="text" class="form-control" placeholder="Search Department" id="search">
        </div>

        <div class="d-flex flex-wrap justify-content-center mx-auto px-5">
            <template v-for="department in paginatedDepartments" :key="department.id">
                <v-card class="col-8 col-sm-5 col-md-4 col-lg-3 m-3 rounded-4">
                    <v-card-text>
                        <h2 class="font-weight-bold text-orange mb-2 text-center">{{ department.name }}</h2>
                        <div class="text-grey">{{ department.description }}</div>
                    </v-card-text>

                    <v-card-actions>
                        <v-btn id="explore" color="blue" class="border rounded-2" @click="exploreDepartment(department.id)">Explore</v-btn>

                        <div class="ms-auto">
                            <!-- Edit Department Icon -->
                            <!-- Delete Department Icon -->
                        </div>
                    </v-card-actions>

                    <div v-if="department.experts && department.experts.length">
                        <h4 class="font-weight-bold mt-3">Experts</h4>
                        <div v-for="expert in department.experts" :key="expert.id">
                            <h5>{{ expert.user.name }}</h5>
                            <p>{{ expert.bio }}</p>
                        </div>
                    </div>
                </v-card>
            </template>
        </div>

        <!-- Pagination -->
        <!-- Pagination -->
        <div class="pagination-container">
            <v-btn
                class="pagination-link"
                :disabled="pagination.page === 1"
                @click="changePage(pagination.page - 1)"
            >
                Previous
            </v-btn>
            <v-btn
                v-for="pageNumber in pagination.totalPages"
                :key="pageNumber"
                class="pagination-link"
                :disabled="pageNumber === pagination.page"
                @click="changePage(pageNumber)"
            >
                {{ pageNumber }}
            </v-btn>
            <v-btn
                class="pagination-link"
                :disabled="pagination.page === pagination.totalPages"
                @click="changePage(pagination.page + 1)"
            >
                Next
            </v-btn>
        </div>

        <!-- Update Department Modal -->
        <div
            class="modal fade"
            id="update_modal"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
            tabindex="-1"
            role="dialog"
        >
            <!-- Modal Content -->
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
import AddDepartmentComponent from "../AdminComponents/DeptForm.vue";
import "@fortawesome/fontawesome-free/css/all.css";

export default {
    data() {
        return {
            experts: [],
            departments: [],
            paginatedDepartments: [],
            department_name: "",
            department_description: "",
            update_departmentID: null,
            errors: {},
            searchQuery: "",
            pagination: {
                page: 1,
                totalPages: 0,
            },
            perPage: 5, // Number of departments per page
        };
    },
    components: {
        // AddDepartmentComponent,
    },
    mounted() {
        this.fetchDepartments();
    },
    methods: {
        exploreDepartment(id) {
            // Make an API request to explore the department and its experts
            axios
                .get(`/api/departments/${id}/explore`)
                .then((response) => {
                    const department = response.data.department;
                    const experts = response.data.experts;
                    // Handle the department and experts data
                    this.experts = experts;
                    this.$router.push({path: `/departments/${department.id}`});
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        handleDepartmentSaved() {
            this.fetchDepartments();
        },

        fetchDepartments() {
            const params = {
                search: this.searchQuery,
                page: this.pagination.page,
                limit: this.perPage,
            };

            axios
                .get("/api/departments", {params})
                .then((response) => {
                    this.departments = response.data.data;
                    this.pagination.totalPages = response.data.last_page;
                    this.updatePaginatedDepartments();
                })
                .catch((error) => {
                    console.log(error.response.data);
                });
        },

        updatePaginatedDepartments() {
            const startIndex = (this.pagination.page - 1) * this.perPage;
            const endIndex = startIndex + this.perPage;
            this.paginatedDepartments = this.departments.slice(startIndex, endIndex);
        },

        changePage(pageNumber) {
            this.pagination.page = pageNumber;
            this.updatePaginatedDepartments();
        },
    },
};
</script>

<style scoped>
.input-container {
    position: relative;
    margin-bottom: 10px;
}

.input-field {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.input-field:focus {
    outline: none;
    border-color: #4caf50;
}


.modal-header {
    color: #fff;
}

.modal-footer button {
    padding: 10px 24px;
    border: none;
    border-radius: 4px;
}

.modal-dialog {
    max-width: 500px;
}

.modal-content {
    background-color: #f9f9f9;
}

.modal-title {
    color: #fff;
}

.btn-primary {
    background-color: #4caf50;
    color: #fff;
}

.btn-secondary {
    background-color: #aaa;
    color: #fff;
}

.text-orange {
    color: orange;
}

.text-grey {
    color: grey;
}

.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination-link {
    padding: 10px;
    margin: 0 5px;
    cursor: pointer;
    border-radius: 5px;
}

.pagination-link:hover {
    background-color: #f0f0f0;
}
#search{
width:600px;
padding:4px;
border-radius:5px;
margin-bottom: 40px;
margin-left: 430px;
margin-top: 45px;
height: 45px;
background: #fff;}
</style>
