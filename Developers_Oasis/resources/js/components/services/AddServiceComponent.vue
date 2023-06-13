<template>
    <div class="d-flex justify-content-center">
        <v-col cols="auto" data-bs-toggle="modal" data-bs-target="#mymodal">
            <v-btn color="green" density="comfortable">Add New Service</v-btn>
        </v-col>
    </div>
    <div  class="modal fade" id="mymodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered mod" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h3 class="modal-title text-center w-100 fw-bold">Add New Service</h3>
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
                    <button type="button" id="dismiss" data-bs-dismiss="modal" class="btn btn-secondary text-light" @click="emptyForm">Cancel</button>
                    <button type="button" class="btn btn-primary text-light" id="dismissBtn" @click="saveService">Save Service</button>
                </div>
            </div>

        </div>

    </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
export default {
    data (){
        return{
            service_title:'',
            service_description:'',
            service_price:'',
            imagePreview: '',
            errors:{}
        }
    },
    methods:{
        saveService(){
            this.errors={}
            if(this.validateForm()) {
                const formData = new FormData();
                formData.append('title', this.service_title);
                formData.append('description', this.service_description);
                formData.append('price', this.service_price);
                formData.append('image', this.$refs.service_name.files[0]);
                axios.post('api/services', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                    }).then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Service saved successfully!'
                    });
                    this.$emit('service-saved')
                    const close = document.getElementById('dismiss')
                    close.click()
                    this.emptyForm()


                }).catch(error => {
                    console.log(error.response.data)
                })
            }
        },
        previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = () => {
                this.imagePreview = reader.result;
            };
            reader.readAsDataURL(file);
        },
        emptyForm(){
            this.service_title=''
            this.service_description=''
            this.service_price=''
            this.imagePreview=''
            this.errors={}
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
    },
    emits: ['service-saved'],

}
</script>

<style scoped>

</style>
