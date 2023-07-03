<template>
  <div class="expert-profile">
    <AddServiceComponent></AddServiceComponent>
    <template v-if="expert">
      <section class="h-100 gradient-custom-2">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">
              <router-link :to="'/chat'">
                <div class="btn btn-success mt-2">chat</div>
              </router-link>
              <div class="card">
                <div
                  class="rounded-top text-white d-flex flex-row"
                  style="background-color: #000; height:200px;"
                >
                  <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                    <img
                      :src="'/storage/' + expert.user.image"
                      alt="Generic placeholder image"
                      class="img-fluid img-thumbnail mt-4 mb-2"
                      style="width: 150px; z-index: 1"
                    />
                  </div>
                  <div class="ms-3" style="margin-top: 130px;">
                    <h5>{{ expert.user.name }}</h5>
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
                    <h3 class="card header" >Department</h3>
                    <p>{{ expert.department.name }}</p>
                  </div>
                  <div class="services-contracts-container d-flex">
                    <div class="services-container">
                      <h3 class="card header">Services</h3>
                      <ul>
                        <li v-for="service in expert.services" :key="service.id">
                          <p>{{ service.title }} - ${{ service.price }}</p>
                          Rating: {{ service.rating }}
                        </li>
                      </ul>
                    </div>
                    <div class="contracts-container">
                      <h3 class="card header">Contracts</h3>
                      <ul>
                        <li v-for="contract in contracts" :key="contract.id">
                          <p>
                            <strong>Service Title:</strong>
                            {{ contract.service_id.title }}
                          </p>
                          <p>
                            <strong>Service Price:</strong>
                            {{ contract.service_id.price }}$
                          </p>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="ratings" v-if="service_ratings && service_ratings.length > 0">
                    <h3>Ratings:</h3>
                    <ul>
                      <li v-for="rating in service_ratings" :key="rating.id">
                        <p>
                          <strong>Service Title:</strong>
                          {{ rating.service.title }} - {{ rating.rating }}
                        </p>
                      </li>
                    </ul>
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

export default {
  components: {
    AddServiceComponent
  },
  data() {
    return {
      expert: null,
      error: false,
      contracts: []
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

<style scoped>
.services-contracts-container {
  display: flex;
  margin: 5px;
}

.services-container {
  flex: 1;
  margin:5px;
}

.contracts-container {
  flex: 1;
  margin: 5px;
}
.card header{
    color: aqua;
}
</style>

