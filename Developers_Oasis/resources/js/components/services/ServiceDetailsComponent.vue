<template>
    <div class="row justify-content-center">
        <div class="col-6">
            <img :src="'/storage/'+service.image" class="w-100 rounded-3">
        </div>
        <div class="col-4 text-center">
            <h1>expert details</h1>
            <h1>{{ service.expert.user.name }}</h1>
            <div class="mt-auto">
                <router-link to="/payment">
                    <button class="btn btn-primary">Buy Now</button>
                </router-link>
            </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return{
            service: {}
        };
    },
    methods:{
        getService(){
            const serviceId = this.$route.params.id;
            axios.get(`/api/services/${serviceId}`)
                .then(response => {
                    this.service = response.data
                    console.log(this.service.image)
                })
                .catch(error => {
                console.log(error);
            });
        }
    },
    mounted() {
        this.getService()
    },
}


</script>


<style scoped>

</style>
