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
            src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
            cover
        >
            <v-card-title>{{service.title}}</v-card-title>
        </v-img>

        <v-card-subtitle class="pt-4">
            {{service.price}} USD
        </v-card-subtitle>

        <v-card-text>
            <div>{{ service.description }}</div>
        </v-card-text>

        <v-card-actions>
            <v-btn color="blue">
                Explore
            </v-btn>

            <v-btn color="orange">
                Update
            </v-btn>

            <v-btn color="red" class="ms-auto" @click=deleteService(service.id)>
                Delete
            </v-btn>
        </v-card-actions>
    </v-card>
</div>
    </div>

</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
import AddServiceComponent from "./AddServiceComponent.vue";
export default {
    data(){
        return{
            services:[],
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
        deleteService(s_id) {
            Swal.fire({
                title: 'Confirm Delete',
                text: 'Are you sure you want to delete?',
                icon: 'warning',
                buttons: ['Cancel', 'Delete'],
                dangerMode: true,
            }).then((confirmed) => {
                if (confirmed) {
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
                        text: 'Item deleted successfully!',
                    });
                    this.services = this.services.filter(service => service.id !== s_id);
                })
                .catch((error) => {
                    console.error(error);
                });
        }
    }}

</script>

<style scoped>

</style>
