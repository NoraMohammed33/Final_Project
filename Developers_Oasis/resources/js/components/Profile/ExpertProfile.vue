<template>
  <div class="expert-profile">
    <AddServiceComponent></AddServiceComponent>
    <template v-if="expert">
      <section class="h-100 gradient-custom-2">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">
              <div class="card">
                <div
                  class="rounded-top text-white d-flex flex-row"
                  style="background-color: #000; height:200px;"
                >
                  <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                    <img
                        :src="(expert.user.image && expert.user.image.startsWith('https')) ? expert.user.image : (expert.user.image ?'/storage/' + expert.user.image : '/images/users/default.jpg')"
                      alt="Generic placeholder image"
                      class="img-fluid img-thumbnail mt-4 mb-2"
                      style="width: 150px; z-index: 1"
                    />
                  </div>
                  <div class="ms-3" style="margin-top: 130px;">
                    <h5>{{ expert.user.name }}</h5>
                      <router-link :to="'/chat'">
                          <v-btn class="bg-blue mt-2 ms-auto">
                              <i class="fa-brands fa-facebook-messenger"></i> Send Message
                          </v-btn>
                      </router-link>
                  </div>
                </div>
                <div class="card-body p-4 text-black">
                  <div class="mb-5">
                    <p class="lead fw-normal mb-1">About</p>
                    <p>
                      <strong>Email:</strong>
                      {{ expert.user.email }}
                    </p>
                    <p>
                      <strong>Bio:</strong>
                      {{ expert.bio }}
                    </p>
                    <h3 class="card header">Department</h3>
                    <h4>the Department is <span style="color: coral;">{{ expert.department.name }} </span> </h4>
                  </div>
                  <div class="services-contracts-wrapper">
  <div class="services-wrapper">
    <div class="card">
      <div class="card-header">Services</div>
      <div class="card-body">
        <ul>
          <li v-for="service in services" :key="service.id">
            <p>{{ service.title }} - ${{ service.price }}</p>
            Rating: {{ calculateAverageRating(service.ratings) }}
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="contracts-wrapper">
    <div class="card">
      <div class="card-header">Contracts</div>
      <div class="card-body" >
        <ul>
          <li v-for="contract in contracts" :key="contract.id">
            <div v-if="contract.expert_id === expert.id">
            <p><strong>Service Title:</strong> {{ contract.service.title }}</p>
            <p><strong>User Name:</strong> {{ contract.user.name }}</p>
            <p><strong>Service Price:</strong> {{ contract.service.price }}$</p>
          </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>


                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </template>
    <template v-else>
      <p v-if="error">Failed to fetch expert data.</p>
      <p v-else>Loading expert profile...</p>
    </template>
  </div>
</template>

  <script>
import axios from "axios";
import AddServiceComponent from "@/components/services/AddServiceComponent.vue";
import rating from "primevue/rating/Rating.vue";

export default {
  computed: {
    rating() {
      return rating;
    }
  },
  components: {
    AddServiceComponent
  },
  data() {
    return {
      expert: null,
      error: false,
      contracts: [],
      services: []
    };
  },
  mounted() {
    this.fetchExpert();
    this.fetchContracts();
  },
  methods: {
    fetchExpert() {
      const expertId = this.$route.params.id;
      axios
        .get(`/api/experts/${expertId}`)
        .then(response => {
          this.expert = response.data.expert;
        })
        .catch(error => {
          console.log(error);
          this.error = true;
        });
    },
    fetchContracts() {
      axios
        .get("/api/contracts")
        .then(response => {
          this.contracts = response.data.contracts;
          this.services = response.data.services;
        })
        .catch(error => {
          console.log(error);
          this.error = true;
        });
    },
    calculateAverageRating(ratings) {
      if (ratings.length === 0) {
        return 0; // Return 0 if there are no ratings
      }

      const sum = ratings.reduce((accumulator, rating) => {
        const value = parseFloat(rating.rating); // Use 'rate' instead of 'value'
        if (isNaN(value)) {
          return accumulator; // Skip invalid rating values
        }
        return accumulator + value;
      }, 0);

      const average = sum / ratings.length;

      // Check if the result is NaN or the sum is zero and return "-" instead
      if (isNaN(average) || sum === 0) {
        return "-"; // Return "-" if the average is not calculable or the sum is zero
      }

      return average.toFixed(2);
    }
  }
};
</script>

<style scoped>
.services-contracts-wrapper {
  display: flex;
}

.services-wrapper {
  flex: 1;
  padding-right: 20px;
}

.contracts-wrapper {
  flex: 1;
  padding-left: 20px;
}
</style>

