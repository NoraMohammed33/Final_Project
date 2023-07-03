<template>
  <section v-if="expert && expert.user" class="section about-section gray-bg" id="about">
    <div class="container">
      <div class="row align-items-center flex-row-reverse">
        <div class="col-lg-6">
          <div class="about-text go-to">
            <h3 class="dark-color">About {{ expert.user.name }}</h3>
            <h4>
              expert in
              <h3 style="color:coral">{{ expert.department.name }}</h3>
            </h4>
            <p>{{ expert.bio }} I design and develop services for customers of all sizes, specializing in creating stylish, modern websites, web services, and online stores. My passion is to design digital user experiences through the bold interface and meaningful interactions.</p>
            <br />
            <div class="row about-list">
              <div class="col-md-6">
                <div class="media">
                  <h4>
                    <label>Freelance</label>
                  </h4>
                  <p>Available</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="media">
                  <h4>
                    <label>E-mail</label>
                  </h4>
                  <p>{{ expert.user.email }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="about-avatar">
            <img :src="'/storage/' + expert.user.image" title alt />
          </div>

            <router-link :to="'/chat'">
            <div class="btn btn-success mt-2">
                chat <span class="text-warning">" {{ expert.user.name }} "</span>
            </div>
            </router-link>

        </div>
      </div>
      <div class="counter">
        <div class="row">
          <ul>
            <li v-for="service in expert.services" :key="service.id">
              <p>{{ service.title }} - ${{ service.price }}</p>
              Rating: {{ service.rating }}
            </li>
          </ul>
        </div>
      </div>
      <div class="contracts" v-if="expert.contracts && expert.contracts.length > 0">
        <h3>Contracts:</h3>
        <ul>
          <li v-for="contract in expert.contracts" :key="contract.id">
            <p>
              <strong>Service Title:</strong>
              {{ contract.service.title }}
            </p>
            <p>
              <strong>User Name:</strong>
              {{ contract.service.user.name }}
            </p>
            <p>
              <strong>Service Price:</strong>
              {{ contract.service.price }}$
            </p>
          </li>
        </ul>
      </div>
      <div class="ratings" v-if="expert.service_ratings && expert.service_ratings.length > 0">
        <h2>services:</h2>
        <ul>
          <li v-for="rating in expert.service_ratings" :key="rating.id">
            <p>
              <strong>Service Title:</strong>
              {{ rating.service.title }} - Service Rating{{ rating.rating }}
            </p>
            <h1>hebba</h1>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <div v-else-if="error">Failed to fetch expert details.</div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      show: false,
      expert: {},
      error: false
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
        .get(`/api/experts/${expertId}?include=user,department`)
        .then(response => {
          console.log(response.data); // Check the response data in the browser console
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
          this.contracts = response.data.data;
        })
        .catch(error => {
          console.log(error);
          this.error = true;
        });
    }
  }
};
</script>

<style>
/* Styles */
.expert-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: flex-start;
}

.expert-card-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 0 -10px;
}

.expert-card {
  width: calc(33.33% - 20px);
  margin: 10px;
}
</style>
