 <template>
  <div class="user-profile">
    <div v-if="user">
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
                      src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp"
                      alt="Generic placeholder image"
                      class="img-fluid img-thumbnail mt-4 mb-2"
                      style="width: 150px; z-index: 1"
                    />
                    <!-- <button type="button" class="btn btn-outline-dark" style="z-index: 1;" >Edit profile</button> -->
                  </div>
                  <div class="ms-3" style="margin-top: 130px;">
                    <h5>{{ user.name }}</h5>
                  </div>
                </div>
                <div class="card-body p-4 text-black">
                  <div class="mb-5">
                    <p class="lead fw-normal mb-1">About</p>
                    <p>
                      <strong>Email:</strong>
                      {{ user.email }}
                    </p>
                  </div>
                  <div class="contracts" v-if="contracts && contracts.length > 0">
                    <h3>Contracts:</h3>
                    <ul>
                      <li v-for="contract in contracts" :key="contract.id">
                        <p>
                          <strong>Service Title:</strong>
                          {{ contract.service_id.title }}
                        </p>
                        <p>
                          <strong>Expert Name:</strong>
                          {{ contract.service_id.expert_id }}
                        </p>
                        <p>
                          <strong>Service Price:</strong>
                          {{ contract.service_id.price }}$
                        </p>
                      </li>
                    </ul>
                  </div>
                  <div class="ratings" v-if="service_ratings && service_ratings.length > 0">
                    <h3>Ratings:</h3>
                    <ul>
                      <li v-for="ratings in service_ratings" :key="ratings.id">
                        <p>
                          <strong>Service Title:</strong>
                          {{ service_ratings.service_id.title }} {{ service_ratings.rating }}
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
    </div>
    <div class="error-message" v-else>Oops! Something went wrong. Please try again later.</div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      user: null,
      error: false,
      contracts: [],
      services: [] // Add the "services" property
    };
  },
  mounted() {
    this.fetchUser();
    this.fetchContracts();
    this.fetchServices(); // Call the method to fetch services
  },
  methods: {
    fetchUser() {
      axios
        .get("/api/user/profile")
        .then(response => {
          this.user = response.data;
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
    },
    fetchServices() {
      axios
        .get("/api/services")
        .then(response => {
          this.services = response.data.data;
        })
        .catch(error => {
          console.log(error);
          this.error = true;
        });
    },
    getContractDetails(contractId) {
      const contract = this.contracts.find(c => c.id === contractId);
      return contract ? contract.charge_id : "N/A";
    }
  }
};
</script>




<style scoped>
.error-message {
  color: red;
  margin-top: 20px;
}
</style>
