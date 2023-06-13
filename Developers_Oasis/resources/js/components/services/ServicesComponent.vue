<template>
    <div>
        <AddServiceComponent @service-saved="handleServiceSaved"></AddServiceComponent>

<div class="d-flex flex-wrap justify-content-center mx-auto">
    <v-card
        class="col-md-4 col-lg-3 m-3"
        v-for="service in services"
        :key="service.id"
    >
        <v-img
            class="align-end text-white"
            height="200"
            :src=  "'storage/'+service.image"
            cover
        >
            <v-card-title>{{service.title}}</v-card-title>
        </v-img>

        <v-card-subtitle class="pt-4">
            {{service.price}} USD
        </v-card-subtitle>

        <v-card-text>
            <div>{{service.expert.user.name}}</div>
        </v-card-text>

        <v-card-actions>
            <v-btn color="blue">
                Explore
            </v-btn>

            <v-btn color="orange" @click="openUpdateModal(service)" data-bs-toggle="modal" data-bs-target="#update_modal">
                Update
            </v-btn>

            <v-btn color="red" class="ms-auto" @click=deleteService(service.id)>
                Delete
            </v-btn>
        </v-card-actions>
    </v-card>
    <div class="modal fade" id="update_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered mod" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-center w-100 fw-bold">Add New Service</h5>
                </div>
                <div class="modal-body">
                    <input type="text" v-model="service_title" class="form-control my-3 border" name="service_title" placeholder="Service Title" >
                    <div v-if="errors.service_title" class="text-danger">{{ errors.service_title }}</div>
                    <textarea type="text" v-model="service_description" class="form-control my-3" maxlength="200" name="service_title" placeholder="Service Description" ></textarea>
                    <div v-if="errors.service_description" class="text-danger">{{ errors.service_description }}</div>
                    <input type="number" v-model="service_price" class="form-control my-3 w-25" name="service_price" min="1">
                    <div v-if="errors.service_price" class="text-danger">{{ errors.service_price }}</div>
                    <input type="file" ref="service_name" class="form-control my-3 w-50" name="service_image" @change="previewImage">
                    <div v-if="errors.imagePreview" class="text-danger">{{ errors.imagePreview }}</div>
                    <img v-if="imagePreview" :src="imagePreview" alt="Image Preview" class="img-fluid" style="width: 60%;height: 210px">
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-secondary text-light">Cancel</button>
                    <button type="button" data-bs-dismiss="modal" class="btn btn-primary text-light" @click="updateService">Update Service</button>
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
import AddServiceComponent from "./AddServiceComponent.vue";
import {el} from "vuetify/locale";

export default {

    data(){
        return{
            services:[],
            service_title:'',
            service_description:'',
            service_price:'',
            imagePreview: '',
            update_serviceID:null,
            errors:{}
        }
    },
    components:{
        AddServiceComponent,
    },
    mounted() {
        this.fetchAllServices()
    },
    methods: {
        handleServiceSaved(){
            this.fetchAllServices()
        },
        fetchAllServices() {
            axios.get('api/services')
                .then(response => {
                    this.services = response.data
                }).catch(error => {
                console.log(error.response.data)
            })

        },
        updateService(){
            const requestData = {
                title: this.service_title,
                description: this.service_description,
                price: this.service_price
            };
            if (this.$refs.service_name.files[0]) {
                requestData.image = this.$refs.service_name.files[0];
            }
            this.errors={}
            if(this.validateForm()) {
                axios.put('api/services/'+this.update_serviceID, requestData)
                .then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Service updated successfully!'
                    });
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
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Service deleted successfully!',
                    });
                    this.services = this.services.filter(service => service.id !== s_id);
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        openUpdateModal(service){
            this.service_title = service.title
            this.service_description = service.description
            this.service_price = service.price
            this.imagePreview = 'storage/'+service.image
            this.update_serviceID = service.id
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
            if (!this.imagePreview) {
                this.errors.imagePreview = 'Please upload image';
                isValid = false;
            }
            return isValid;
        },
    }}

</script>

<style scoped>

</style>
