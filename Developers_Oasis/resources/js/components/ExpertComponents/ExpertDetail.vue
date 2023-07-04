<template>
  <section v-if="expert && expert.user" class="section about-section gray-bg" id="about">
    <div class="container">
      <div class="row align-items-center flex-row-reverse">
        <div class="col-lg-6">
          <div class="about-text go-to">
            <h3 class="dark-color">About  <span style="color:coral">{{ expert.user.name }} </span> </h3>
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
            <img
              width="300"
              class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm"
              :src="'/storage/' + expert.user.image"
              title
              alt
            />
          </div>
          <br />

          <router-link :to="'/chat'">
            <div class="btn btn-success mx-15">
              chat
              <span class="text-warning">" {{ expert.user.name }} "</span>
            </div>
          </router-link>
        </div>
      </div>
      <br >
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ expert.user.name }} Services</h5>
              <div class="row">
                <div class="col-md-6" v-for="service in expert.services" :key="service.id">
                  <div class="card-item">
                    <p>{{ service.title }}</p>
                    <p class="price">${{ service.price }}</p>
                    <v-img cover :src="'storage/' + service.image"></v-img>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6" v-if="contracts">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Contracts</h5>
              <ul>
                <li v-for="contract in expert.contracts" :key="contract.id">
                  <div class="card-item">
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
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
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
     contracts: {},
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
.card {
  background-color: #f5f5f5;
  border-radius: 4px;
  padding: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.card-item {
  background-color: white;
  border-radius: 4px;
  padding: 10px;
  margin-bottom: 10px;
}

.price {
  color: #ff0000;
}
</style>
