<template>
  <div class="expert-list">
    <div>
      <h3>Meet Our Creative Team</h3>
    </div>
    <br />
    <v-row class="search-container justify-center">
      <v-col>
        <input
          v-model="searchInput"
          type="text"
          class="form-control"
          placeholder="Search about creative Expert"
          id="search"
        />
      </v-col>
    </v-row>
    <div class="container">
      <div class="d-flex flex-wrap justify-center">
        <!-- Updated class to center align the cards -->
        <div
          class="expert-card-container card-container"
          v-for="expert in filteredExperts"
          :key="expert.id">
          <div class="bg-white rounded shadow-sm py-5 px-10" style="width: 250px;">
            <!-- <v-img class="align-end text-white" height="200" :src="'public/images/' + expert.user.image" cover>
                </v-img> -->
            <img
                :src="(expert.user.image && expert.user.image.startsWith('https')) ? expert.user.image : (expert.user.image ?'/storage/' + expert.user.image : '/images/users/default.jpg')"
              alt
              width="150"
              class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm"
            />
            <h4 class="mb-0">{{ expert.user.name }}</h4>
            <br>
          <div>
            <span class="small text-uppercase text-muted"></span>
            <div>Department: {{ expert.department.name }}</div>
            <br>
            </div>
            <v-btn color="orange" @click="exploreExpert(expert)">Explore</v-btn>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      experts: [],
      searchInput: "" // Search input property
    };
  },
  mounted() {
    this.fetchExperts();
  },
  computed: {
    // Computed property to filter experts based on search input
    filteredExperts() {
      if (!this.searchInput) {
        return this.experts;
      }
      const search = this.searchInput.toLowerCase();
      return this.experts.filter(
        expert =>
          expert.user.name.toLowerCase().includes(search) ||
          expert.user.email.toLowerCase().includes(search) ||
          expert.department.name.toLowerCase().includes(search)
      );
    }
  },
  methods: {
    fetchExperts() {
      axios
        .get("/api/experts?include=department")
        .then(response => {
          this.experts = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    exploreExpert(expert) {
      this.$router.push({ path: `/expert/${expert.id}` });
    }
  }
};
</script>


<style scoped>
.card-container {
  margin: 20px;
}
#search {
  width: 600px;
  padding: 4px;
  border-radius: 5px;
  margin-bottom: 10px;
  margin-top: 5px;
  height: 45px;
  background: #fff;
}
h3 {
   margin-top: 12px;
  text-align: center;
  color: #fc9f0b;
}
.expert-list {
  display: flex;
  flex-direction: column;
  align-items: center;
}
</style>
