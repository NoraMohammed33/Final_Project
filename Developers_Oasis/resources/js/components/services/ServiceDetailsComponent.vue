<template>
    <div class="container">
        <div v-if="successMessage" class="alert alert-success">
            {{ successMessage }}
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img :src="'/storage/'+service.image" class="w-100 rounded-3">
            </div>
            <div class="col-md-4 text-center border rounded-3 mt-5 mt-md-0 shadow-lg mx-auto">
                <h5 class="text-center py-2 border-b">Service Details</h5>
                <h4 class="text-start">{{service.title}}</h4>
                <p class="text-start ">{{service.description}}</p>
                <h4 class="text-start ">{{service.price}} USD</h4>

                <h5 class="text-center py-2 border-b border-t mt-5">About Expert</h5>
                <div class="row justify-content-evenly align-items-baseline">
                    <img
                        :src="'/storage/' + service.expert.user.image"
                        alt="Generic placeholder image"
                        class="img-fluid img-thumbnail mt-4 mb-2 col-2"
                        style="width: 150px; z-index: 1"
                    />
                    <div class="col-5">
                        <h4>{{ service.expert.user.name }}</h4>
                        <p>{{ service.expert.bio}}</p>
                    </div>
                    <div class="w-100">
                        <v-btn class="mt-5 bg-orange w-100 fs-4 text-white " @click="paypalPayment"><i class="fa-brands fs-2 mx-1 text-blue-darken-4 fa-paypal"></i>PayPal Payment</v-btn>
                    </div>
                </div>


            </div>
        </div>
        <div v-if="service.hasRated && service.loggedUser.id !== service.expert.user.id" class="text-center fs-4 mx-auto text-light rounded-3 w-50 bg-success mt-5">
            <p>You have already submitted a rating for this service.</p>
        </div>
        <div v-else-if="service.loggedUser.id !== service.expert.user.id" class="w-50 mx-auto mt-5 text-center">
            <form @submit.prevent="submitRating">
                <div class="mb-3">
                    <textarea type="email" placeholder="Type your feedback here" v-model="comment" name="comment" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"/>
                </div>
                <div class="d-flex justify-content-center my-3">
                    <star-rating
                        v-model:rating="rating"
                        :star-size="26"
                        clearable="true"
                        :active-color="'#ffd055'"
                        :inactive-color="'#d8d8d8'"
                        animate="true"
                    ></star-rating>
                </div>
                <v-btn type="submit" :disabled="rating === 0" class="bg-success text-white">Submit your feedback</v-btn>
            </form>
        </div>
        <div v-if="service.ratings.length>0" class="mt-5">
            <h4>Ratings and Comments</h4>
            <ul>
                <li v-for="rating in service.ratings" class="border mt-5 p-3 rounded-3 shadow-lg">
                    <div> <star-rating
                        v-model:rating="rating.rating"
                        :star-size="24"
                        :active-color="'#ffd055'"
                        :inactive-color="'#d8d8d8'"
                        read-only="true"
                    ></star-rating></div>
                    <div v-if="rating.comment" class="my-1"><strong>Comment:</strong> {{ rating.comment }}</div>
                    <div><strong>User:</strong> {{ rating.user.name }}</div>
                </li>
            </ul>
        </div>
        <div v-else class="text-center mt-5 fs-3 text-danger font-weight-bold">There is no ratings for this service right now! </div>

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
                this.getService()
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
li{
    list-style-type:none;
}

</style>
