<template>
  <div class="container">
    <form @submit.prevent="addPost">
      <h3>Add Post</h3>
      <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" id="title" v-model="newPost.title" class="form-control" required />
      </div>
      <div class="form-group">
        <label for="body">Body:</label>
        <textarea id="body" v-model="newPost.body" class="form-control" required></textarea>
      </div>
      <div class="form-group">
        <label for="dep_id">Department ID:</label>
        <input type="number" id="dep_id" v-model="newPost.dep_id" class="form-control" required />
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

        <script>
import axios from "axios";

export default {
  data() {
    return {
      departments: [],
      newPost: {
        title: "",
        body: "",
        user_id: this.user_id,
        dep_id: null
      }
    };
  },
  props: ["user_id"],
  methods: {
    addPost() {
      axios
        .post("http://localhost:8000/api/posts/", this.newPost)
        .then(response => {
          console.log(response.data);
          this.resetForm();
        })
        .catch(error => {
          console.error(error);
        });
    },
    resetForm() {
      this.newPost = {
        title: "",
        body: "",
        user_id: null,
        dep_id: null
      };
    }
  },
  mounted() {
    axios
      .get(`http://localhost:8000/api/departments`)
      .then(response => {
        this.departments = response.data;
        console.log(this.departments);
      })
      .catch(error => {
        console.log(error);
      });
  }
};
</script>
