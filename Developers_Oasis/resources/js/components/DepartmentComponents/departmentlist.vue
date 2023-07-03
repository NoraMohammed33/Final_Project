<template>
  <div>
    <div class="input-container">
      <input
        v-model="searchQuery"
        @input="fetchDepartments"
        type="text"
        class="form-control"
        placeholder="Search Department"
        id="search"
      />
    </div>

    <div class="d-flex flex-wrap justify-content-center mx-auto px-5">
      <template v-for="department in filteredDepartments" :key="department.id">
        <v-card class="col-8 col-sm-5 col-md-4 col-lg-3 m-3 rounded-4">
          <v-card-text>
            <h2 class="font-weight-bold text-orange mb-2 text-center">{{ department.name }}</h2>
            <div class="text-grey">{{ department.description }}</div>
          </v-card-text>

          <v-card-actions>
            <v-btn
              id="explore"
              color="blue"
              class="border rounded-2"
              @click="exploreDepartment(department.id)"
            >Explore</v-btn>

            <div class="ms-auto">
              <!-- Edit Department Icon -->
              <!-- Delete Department Icon -->
            </div>
          </v-card-actions>

          <div v-if="department.experts && department.experts.length">
            <h4 class="font-weight-bold mt-3">Experts</h4>
            <div v-for="expert in department.experts" :key="expert.id">
              <h5>{{ expert.user.name }}</h5>
              <p>{{ expert.bio }}</p>
            </div>
          </div>
        </v-card>
      </template>
    </div>

    <!-- Pagination -->
<div class="pagination-container text-center">
  <button
    class="btn btn-primary mx-2"
    v-if="departments.current_page > 1"
    @click="changePage(departments.current_page - 1)"
  >Previous</button>
  <button
    class="btn btn-primary"
    v-if="departments.current_page < departments.last_page"
    @click="changePage(departments.current_page + 1)"
  >Next</button>
  <br />
  <br />
</div>


    <!-- Update Department Modal -->
    <div
      class="modal fade"
      id="update_modal"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabindex="-1"
      role="dialog"
    >
      <!-- Modal Content -->
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
import AddDepartmentComponent from "../AdminComponents/DeptForm.vue";
import "@fortawesome/fontawesome-free/css/all.css";

export default {
  data() {
    return {
      experts: [],
      departments: [],
      department_name: "",
      department_description: "",
      update_departmentID: null,
      errors: {},
      searchQuery: "",
      currentPage: 1
    };
  },
  components: {},
  mounted() {
    this.fetchDepartments();
  },
  computed: {
    filteredDepartments() {
      if (!this.searchQuery) {
        return this.departments.data;
      }
      const search = this.searchQuery.toLowerCase();
      return this.departments.data.filter(
        department =>
          department.name.toLowerCase().includes(search) ||
          department.description.toLowerCase().includes(search)
      );
    }
  },
  methods: {
    exploreDepartment(id) {
      axios
        .get(`/api/departments/${id}/explore`)
        .then(response => {
          const department = response.data.department;
          const experts = response.data.experts;
          this.experts = experts;
          this.$router.push({ path: `/departments/${department.id}` });
        })
        .catch(error => {
          console.error(error);
        });
    },
    handleDepartmentSaved() {
      this.fetchDepartments();
    },
    fetchDepartments() {
      axios
        .get("/api/departments", {
          params: {
            search: this.searchQuery,
            page: this.currentPage
          }
        })
        .then(response => {
          this.departments = response.data;
        })
        .catch(error => {
          console.log(error.response.data);
        });
    },

    changePage(page) {
      this.currentPage = page;
      this.fetchDepartments();
    }
  }
};
</script>

<style scoped>
.input-container {
  position: relative;
  margin-bottom: 10px;
}

.input-field {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.input-field:focus {
  outline: none;
  border-color: #4caf50;
}

.modal-header {
  color: #fff;
}

.modal-footer button {
  padding: 10px 24px;
  border: none;
  border-radius: 4px;
}

.modal-dialog {
  max-width: 500px;
}

.modal-content {
  background-color: #f9f9f9;
}

.modal-title {
  color: #fff;
}

/* .btn-primary {
  background-color: #4caf50;
  color: #fff;
} */

/* .btn-secondary {
  background-color: #aaa;
  color: #fff;
} */

.text-orange {
  color: orange;
}

.text-grey {
  color: grey;
}

#search {
  width: 600px;
  padding: 4px;
  border-radius: 5px;
  margin-bottom: 40px;
  margin-left: 430px;
  margin-top: 45px;
  height: 45px;
  background: #fff;
}
.pagination-container {
  display: flex;
  justify-content: center;
  margin-top: 20px;
}

</style>
