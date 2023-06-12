<template>
    <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#mymodal">+ Add</button>
    </div>
    <div class="modal fade" id="mymodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered mod" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center w-100 fw-bold">Add New Service</h5>
                </div>
                <div class="modal-body">
                    <input type="text" v-model="service_title" class="form-control my-3 border" name="service_title" placeholder="Service Title" >
                    <div v-if="errors.length>0" class="alert alert-danger">
                        {{errors['title']}}
                    </div>
                    <textarea type="text" v-model="service_description" class="form-control my-3" name="service_title" placeholder="Service Description" ></textarea>
                    <input type="number" v-model="service_price" class="form-control my-3 w-25" name="service_price" min="1">
<!--                    <input type="file" class="form-control my-3 w-50" name="service_image">-->
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
                    <button type="button" data-bs-dismiss="modal" class="btn btn-primary" @click="saveService">Save Service</button>
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
            errors:[]
        }
    },
    methods:{
        saveService(){
            axios.post('api/services',{
                title:this.service_title,
                description:this.service_description,
                price:this.service_price
            }).then(response=>{
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Service saved successfully!'
                    });
                    this.$emit('service-saved')
                    this.service_title = ''
                    this.service_description = ''
                    this.service_price = ''
            }).catch(error=>{
                if (error.response.status === 422) {
                    this.errors = error.response.data;
                }
            })

        }
    },
    emits: ['service-saved'],
    computed: {
        isFormEmpty() {
            return (
                this.service_title === '' ||
                this.service_description === '' ||
                this.service_price === ''
            );
        },
    }
}
</script>

<style scoped>

</style>
