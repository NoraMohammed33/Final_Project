<template>
    <div class="container">
        <div v-if="successMessage" class="alert alert-success">
            {{ successMessage }}
        </div>
        <div class="row justify-content-center">
            <div class="col-6">
                <img :src="'/storage/'+service.image" class="w-100 rounded-3">
            </div>
            <div class="col-4 text-center">
                <h1>expert details</h1>
                <h1>{{ service.expert.user.name }}</h1>
                <h1>{{ service.expert.bio}}</h1>
                <div class="mt-auto">
                        <button class="btn btn-primary" @click="paypalPayment">Pay Via PayPal</button>
                </div>
            </div>
        </div>
        <div v-if="service.hasRated && service.loggedUser.id !== service.expert.user.id" class="text-center fs-4 mx-auto text-light rounded-3 w-50 bg-success mt-5">
            <p>You have already submitted a rating for this service.</p>
        </div>
        <div v-else-if="service.loggedUser.id !== service.expert.user.id" class=" w-50 mx-auto mt-5 text-center">
            <form @submit.prevent="submitRating">
                <div class="mb-3">
                    <textarea type="email" placeholder="Type your feedback here" v-model="comment" name="comment" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"/>
                </div>
                <div>
                    <star-rating
                        v-model:rating="rating"
                        :star-size="24"
                        clearable="true"
                        :active-color="'#ffd055'"
                        :inactive-color="'#d8d8d8'"
                        animate="true"
                    ></star-rating>
                </div>
                <button type="submit" :disabled="rating === 0" class="btn btn-primary text-white">Submit your feedback</button>
            </form>
        </div>
        <div v-if="service.ratings.length>0">
            <h2>Ratings and Comments</h2>
            <ul>
                <li v-for="rating in service.ratings">
                    <div> <star-rating
                        v-model:rating="rating.rating"
                        :star-size="24"
                        :active-color="'#ffd055'"
                        :inactive-color="'#d8d8d8'"
                        read-only="true"
                    ></star-rating></div>
                    <div v-if="rating.comment">Comment: {{ rating.comment }}</div>
                    <div>User: {{ rating.user.name }}</div>
                </li>
            </ul>
        </div>
        <div v-else>no ratings</div>

    </div>
</template>

<script>
import axios from 'axios';
import { showToast } from "../../toast";

export default {
    data(){
        return{
            service: {},
            rating :0,
            comment:'',
            serviceId : this.$route.params.id,
            showSuccessMessage: false,
            successMessage: null,
        };
    },
    methods:{
        paypalPayment() {
            axios.post('http://localhost:8000/api/pay', {
                amount:this.service.price,
                service_id:this.serviceId
            })
                .then((response) => {
                    window.location.href = response.data.redirect_url;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        showSuccess(){
            const { showSuccessToast } = showToast();
            showSuccessToast("Your Feedback Submitted");
        },
        showError() {
            const { showErrorToast } = showToast();
            showErrorToast("Your Feedback Not Submitted");
        },
      getService(){
            axios.get(`/api/services/${this.serviceId}`)
                .then(response => {
                    this.service = response.data.service
                })
                .catch(error => {
                console.log(error);
            });
        },
      submitRating(){
        const ratingData = {
            service_id: this.serviceId,
            rating: this.rating,
            comment: this.comment
        }

        axios.post('/api/service-ratings',ratingData)
            .then(response=>{
                console.log(response)
                this.showSuccess()
            })
            .catch(error=>{
                this.showError()
                console.log(error.response.text)
            })
      },
     },
    created() {
        this.getService()
    },
}


</script>


<style scoped>

</style>
