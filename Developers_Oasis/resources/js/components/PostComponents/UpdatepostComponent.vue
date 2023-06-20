<template>
  <div class="container">
    <form @submit.prevent="updatePost">
      <h3>Edit Post</h3>
      <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" id="title" v-model="post.title" class="form-control" required />
      </div>
      <div class="form-group">
        <label for="body">Body:</label>
        <textarea id="body" v-model="post.body" class="form-control" required></textarea>
      </div>
      <div>
        <label for="dep_id">Department Name:</label>
        <select class="form-control" v-model="post.dep_id" name="dep_id" id="dep_id">
          <option
            v-for="department in departments.data"
            :key="department.id"
            :value="department.id"
          >{{ department.name }}</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</template>

  <script>
import axios from "axios";

export default {
  data() {
    return {
      departments: [],
      post: {
        title: "",
        body: "",
        user_id: this.user_id,
        dep_id: ""
      }
    };
  },
  props: ["user_id", "post_id"],
  methods: {
    updatePost() {
      axios
        .put(`http://localhost:8000/api/posts/${this.post_id}`, this.post)
        .then(response => {
          console.log(response.data);

        })
        .catch(error => {
          console.error(error);
                });
    },
    resetForm() {
      this.post = {
        id: null,
        title: "",
        body: "",
        dep_id: null
      };

      //   window.location.href = '/addpost';
    //   this.$router.push({ name: "/post", params: { id: post.id } });
    }
  },
  mounted() {
    axios
      .get(`http://localhost:8000/api/departments`)
      .then(response => {
        this.departments = response.data;
      })
      .catch(error => {
        console.log(error);
      });

    axios
      .get(`http://localhost:8000/api/posts/${this.post_id}`)
      .then(response => {
        this.post = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  }
};
</script>
