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
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

    <script>
import axios from "axios";

export default {
  data() {
    return {
      posts: [],
      newPost: {
        title: "",
        body: ""
      }
    };
  },
  created() {
    this.fetchPosts();
  },
  methods: {
    fetchPosts() {
      axios
        .get("http://localhost:8000/api/posts/")
        .then(response => {
          this.posts = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    addPost() {
      axios
        .post("http://localhost:8000/api/posts/", this.newPost)
        .then(response => {
          this.fetchPosts();
          this.newPost.title = "";
          this.newPost.body = "";
        })
        .catch(error => {
          console.log(error);
        });
    },

    mounted() {
      console.log("Component mounted.");
    }
  }
};
</script>

