<template>
    <div>
        <div class="d-flex justify-content-center mx-auto px-5">
            <div class="input-container">
                <input
                    type="text" class="form-control" placeholder="Search Service" id="search"
                    v-model="searchQuery"
                    @input="fetchAllServices"
                />
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-center mt-5 px-5">
    <template v-for="service in services" :key="service.id">
        <v-card class="col-9 col-sm-5 col-md-5 col-lg-4 col-xl-3 mx-3 my-3 rounded-3">
            <div class="image-container">
                <v-img class="img-service" cover :src="'storage/' + service.image" style="width: 100%; height: 140px;"></v-img>
            </div>

            <v-card-text class="mt-2">
                <h2 class="font-weight-bold text-orange mb-2">{{ service.title }}</h2>
                <div class=" text-grey">{{ service.description }}</div>
                <div class="font-weight-bold">
                    ${{ service.price }}
                </div>
            </v-card-text>

            <v-card-actions class="bg-blue-grey-darken-3 text-light">
                <div class="d-flex w-100 flex-column flex-sm-row align-items-sm-baseline  align-items-center justify-content-between justify-content-sm-evenly">
                <router-link :to="`/services/${service.id}`">
                    <v-btn id="explore" color="blue" class="border rounded-2">Explore</v-btn>
                </router-link>
<!--                <div class="ms-auto text-light">-->
<!--                    <i class="fas fa-edit fs-4 text-warning" @click="openUpdateModal(service)"-->
<!--                       data-bs-toggle="modal"-->
<!--                       data-bs-target="#update_modal">-->
<!--                    </i>-->
<!--                    <i class="fas fa-trash fs-4 text-danger ms-4" @click="deleteService(service.id)"></i>-->
<!--                </div>-->
                <div class="w-sm-100 w-md-auto">
                    <star-rating
                        v-model:rating="service.average_rating"
                        :star-size="24"
                        :active-color="'#ffd055'"
                        :inactive-color="'#d8d8d8'"
                        read-only="true"
                    ></star-rating>
                </div>
                <div class="fs-5 fs-sm-6">
                    <i class="fa-solid fa-user mx-1"></i>
                    <span class="text-light font-weight-bold me-1">({{ service.contracts_count }})</span>
                </div>
                </div>

            </v-card-actions>
        </v-card>
    </template>
        </div>
<!--    <div class="card">-->
<!--        <Paginator :rows="6" :totalRecords="services.length" :rowsPerPageOptions="[10, 20, 30]"></Paginator>-->
<!--    </div>-->
    <div class="modal fade" id="update_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered mod" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h3 class="modal-title text-center w-100 fw-bold">Update Service</h3>
                </div>
                <div class="modal-body">
                    <input type="text" v-model="service_title" class="form-control my-3 border" name="service_title" placeholder="Service Title" >
                    <div v-if="errors.service_title" class="text-danger">{{ errors.service_title }}</div>
                    <textarea type="text" v-model="service_description" class="form-control my-3" maxlength="200" name="service_title" placeholder="Service Description" ></textarea>
                    <div v-if="errors.service_description" class="text-danger">{{ errors.service_description }}</div>
                    <div class="col-md-10">
                        <select class="form-control" v-model="dept_id" name="dept_id" id="dept_id">
                            <option
                                v-for="department in departments.data"
                                :key="department.id"
                                :value="department.id"
                            >{{ department.name }}</option>
                        </select>
                    </div>
                    <div v-if="errors.dept_id" class="text-danger">{{ errors.dept_id }}</div>
                    <input type="number" v-model="service_price" class="form-control my-3 w-25" name="service_price" min="1">
                    <div v-if="errors.service_price" class="text-danger">{{ errors.service_price }}</div>
                    <input type="file" ref="service_name" class="form-control my-3 w-50" name="service_image" @change="previewImage">
                    <div v-if="errors.imagePreview" class="text-danger">{{ errors.imagePreview }}</div>
                    <div class="d-flex justify-content-center p-1">
                        <img v-if="imagePreview" :src="imagePreview" alt="Image Preview" class="img-fluid rounded-2" style="width: 70%;height: 210px">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="dismissUpdate" data-bs-dismiss="modal" class="btn btn-secondary text-light">Cancel</button>
                    <button type="button" class="btn btn-primary text-light" @click="updateService">Update Service</button>
                </div>
            </div>

        </div>

    </div>

</div>


</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
import AddServiceComponent from "./AddServiceComponent.vue";
import '@fortawesome/fontawesome-free/css/all.css';
import { showToast } from "../../toast";

export default {

    data() {
        return {
            services: [],
            service_title: '',
            service_description: '',
            service_price: '',
            imagePreview: '',
            update_serviceID: null,
            errors: {},
            searchQuery: "",
            departments:[],
            dept_id:'',
        };
    },
    components:{
        AddServiceComponent,
    },
    mounted() {
        this.fetchAllServices()
        this.fetchAllDepartments()
    },
    // debounceSearch: _.debounce(function() {
    //     this.fetchAllServices();
    // }, 500),
    methods: {
        showSuccess() {
            const {showSuccessToast} = showToast();
            showSuccessToast("Service Deleted Successfully");
        },
        showError() {
            const {showErrorToast} = showToast();
            showErrorToast("Service Not Deleted Successfully");
        },
        handleServiceSaved() {
            this.fetchAllServices()
        },
        fetchAllServices() {
            const params = {
                search: this.searchQuery,
            };

            axios
                .get("api/services", {params})
                .then((response) => {
                    console.log(response.data);
                    this.services = response.data.services;
                })
                .catch((error) => {
                    console.log(error.response.data);
                });
        },


        updateService() {
            const requestData = {
                title: this.service_title,
                description: this.service_description,
                price: this.service_price,
                dept_id: this.dept_id
            };
            if (this.$refs.service_name.files[0]) {
                requestData.image = this.$refs.service_name.files[0];
            }
            this.errors = {}
            if (this.validateForm()) {
                axios.put('api/services/' + this.update_serviceID, requestData)
                    .then(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Service updated successfully!'
                        });
                        const close = document.getElementById('dismissUpdate')
                        close.click()
                        this.fetchAllServices()
                        this.emptyForm()

                    }).catch(error => {
                    console.log(error)
                })
            }
        },
        deleteService(s_id) {
            Swal.fire({
                title: 'Confirm Delete',
                text: 'Are you sure you want to delete?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                dangerMode: true,
                allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    this.deleteItem(s_id);
                }

            });
        },
        deleteItem(s_id) {
            axios.delete('api/services/' + s_id)
                .then(() => {
                    this.showSuccess()
                    this.services = this.services.filter(service => service.id !== s_id);
                })
                .catch((error) => {
                    this.showError()
                    console.error(error);
                });
        },
        openUpdateModal(service) {
            this.service_title = service.title
            this.service_description = service.description
            this.service_price = service.price
            this.imagePreview = 'storage/' + service.image
            this.update_serviceID = service.id
            this.dept_id = service.dept_id
        },
        previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = () => {
                this.imagePreview = reader.result;
            };
            reader.readAsDataURL(file);
        },
        validateForm() {
            let isValid = true;
            if (!this.service_title.trim()) {
                this.errors.service_title = 'Please enter a title';
                isValid = false;
            }
            if (!this.service_description.trim()) {
                this.errors.service_description = 'Please enter a description';
                isValid = false;
            }
            if (!this.service_price || this.service_price <= 0) {
                this.errors.service_price = 'Please enter a valid price';
                isValid = false;
            }
            if (!this.dept_id) {
                this.errors.dept_id = 'Please Select Department';
                isValid = false;
            }
            if (!this.imagePreview) {
                this.errors.imagePreview = 'Please upload image';
                isValid = false;
            }
            return isValid;
        },
        fetchAllDepartments() {
            axios
                .get(`http://localhost:8000/api/departments`)
                .then(response => {
                    this.departments = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
    }
}

</script>

<style scoped>
.img-service:hover{
    transform: scale(1.18);
    transition: 0.5s;
    z-index:2;
}
#explore:hover{
    background-color: #e2e8f0;
}
.input-container {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
}

.input-field {
    padding: 0.5rem;
    border: 1px solid #d8d8d8;
    border-radius: 4px;
    font-size: 1rem;
    width: 100%;
    max-width: 600px; /* Adjust the maximum width as needed */
}

.input-field:focus {
    outline: none;
    border-color: #4a9eff;
    box-shadow: 0 0 0 3px rgba(74, 158, 255, 0.3);
}

.fa-search {
    margin-left: -30px;
    color: #a0a0a0;
}

/* Styles for the service cards container */
.d-flex.flex-wrap.justify-content-center.mx-auto.px-5 {
    /* Adjust the styles as needed */
}
#search{
width:600px;
padding:4px;
margin-right: 50px;
border-radius:5px;
margin-bottom: 40px;
height: 45px;
background: #fff;}

</style>
