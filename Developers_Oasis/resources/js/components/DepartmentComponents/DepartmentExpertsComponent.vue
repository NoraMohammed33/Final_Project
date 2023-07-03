<template>
  <div v-if="experts && experts.length > 0" class="text-center">
    <h3 style="margin-top:25px" class="text-center">
      Explore our amazing
      <span style="color: coral">{{ experts[0].department.name }}</span> experts
    </h3>
    <br />
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4" v-for="expert in experts" :key="expert.id">
          <div class="bg-white rounded shadow-sm py-5 px-10" style="width: 300px;">
            <img
                :src="'/storage/' + expert.user.image"
              alt
              width="150"
              class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm"
            />
            <h4>{{ expert.user.name }}</h4>
            <br />
            <div>
              <strong>Department:</strong>
              {{ expert.department.name }}
            </div>
            <div>
              <strong>Email:</strong>
              {{ expert.user.email }}
            </div>
            <br />
            <v-btn color="orange" @click="exploreExpert(expert)">Explore</v-btn>
            <!-- <v-btn color="orange" @click="chatExpert(expert)">Chat Me</v-btn> -->
            <br />
          </div>
        </div>
      </div>
    </div>
  </div>
  <div v-else class="text-center">Sorry, there are no experts in this department.</div>
</template>

  <script>
export default {
  data() {
    return {
      experts: [],
      departments: []
    };
  },
  mounted() {
    try {
      const departmentId = this.$route.params.id;
      this.exploreDepartment(departmentId);
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    exploreDepartment(id) {
      axios
        .get(`/api/departments/${id}/explore`)
        .then(response => {
          const department = response.data.departments;
          const expert = response.data.experts;
          this.experts = expert;
          this.departments = department;
        })
        .catch(error => {
          console.error(error);
          // Handle error and show appropriate message
          this.experts = []; // Clear the experts array
        });
    },

    exploreExpert(expert) {
      this.$router.push({ path: `/expert/${expert.id}` });
    }
  }
};
</script>

  <style scoped>
</style>
