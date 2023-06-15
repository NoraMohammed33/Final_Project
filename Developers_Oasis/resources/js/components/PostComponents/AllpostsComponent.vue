<template>
  <div class="posts">
    <div v-for="post in posts.data" :key="post.id" class="post">
      <h2>{{ post.title }}</h2>
      <p>{{ post.body }}</p>
        <p>Posted by: {{ post.user.name }}</p>
    </div>
  </div>
</template>

      <script>
import axios from "axios";

export default {
  data() {
    return {
      posts: []
    };
  },
  mounted() {
    this.fetchPosts();
  },
  methods: {
    fetchPosts() {
      axios
        .get("http://localhost:8000/api/posts")
        .then(response => {
          this.posts = response.data;
          console.log(response.data);
        })
        .catch(error => {
          console.error(error);
        });
    }
  }
};
</script>

    <style>
</style>
