<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card my-3" v-for="post in posts" :key="post.id">
        <h5 class="card-header">{{ post.title }}</h5>
        <div class="card-body">
          <div class="mb-3">
            <h6 class="font-weight-bold">Title:</h6>
            <p>{{ post.title }}</p>
          </div>
          <div class="mb-3">
            <h6 class="font-weight-bold">Body:</h6>
            <p>{{ post.body }}</p>
            <button
              type="button"
              class="btn btn-danger btn-sm"
              @click="deletePost(post.id)"
            >Delete Your post</button>
            <button type="button" class="btn btn-warning btn-sm">Edit Your post</button>
          </div>
          <div class="card mt-4">
            <h5 class="card-header">Comments</h5>
            <div class="card-body">
              <form @submit.prevent="addComment(post.id)">
                <div class="form-group">
                  <textarea
                    v-model="newCommentBody"
                    name="body"
                    id="body"
                    cols="15"
                    rows="4"
                    class="form-control"
                    placeholder="Your comment here"
                  ></textarea>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Add Comment</button>
                </div>
              </form>
              <!-- v-if="post.comments.length > 0"
              -->
              <div>
                <div class="card" v-for="comment in post.comments" :key="comment.id">
                  <div class="card-header">{{ comment.user.name }}:</div>

                  <div class="card-body">
                    <div>
                      <span style="font-size: 1.2rem; font-weight: bold">Comment:</span>
                      {{ comment.body }}
                    </div>
                    <div>
                      <span style="font-size: 1rem; font-weight: bold">Created At:</span>
                      {{ comment.created_at }}
                      <td>
                        <a :href="`/comments/edit/${comment.id}`" class="btn btn-warning">Edit</a>
                      </td>
                      <form
                        :action="`/comments/destroy/${comment.id}`"
                        method="POST"
                        style="display: inline;"
                      >
                        <button
                          type="submit"
                          class="btn btn-danger"
                          @click="deleteComment(comment.id)"
                        >Delete</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div>No comments yet</div>
            </div>
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
      posts: [],
      newCommentBody: ""
    };
  },
  created() {
    this.fetchPosts();
  },
  methods: {
    fetchPosts(id) {
      axios
        .get(`http://localhost:8000/api/posts/7`)
        .then(response => {
          this.posts = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    deletePost(id) {
      axios
        .delete(`http://localhost:8000/api/posts/7`)
        .then(response => {
          this.fetchPosts();
        })
        .catch(error => {
          console.log(error);
        });
    },
    deleteComment(commentId) {
      axios
        .delete(`http://localhost:8000/api/comments/${commentId}`)
        .then(response => {
          this.fetchPosts();
        })
        .catch(error => {
          console.log(error);
        });
    },
    addComment(postId) {
      axios
        .post(`http://localhost:8000/api/posts/${postId}/comments`, {
          body: this.newCommentBody
        })
        .then(response => {
          this.newCommentBody = "";
          this.fetchPosts();
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>

        <style>
</style>

