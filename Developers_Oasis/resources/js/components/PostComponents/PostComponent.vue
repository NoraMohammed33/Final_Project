<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card my-3" v-for="post in posts" :key="post.id">
        <h5 class="card-header">{{ post.title }}</h5>
        <div class="card-body">
          <div class="mb-3">
            <p>{{ post.body }}</p>
            <button
              type="button"
              class="btn btn-danger btn-sm"
              @click="deletePost()"
            >Delete Your post</button>
            <!-- edit post  -->
            <div
              class="modal fade"
              id="update_modal"
              data-bs-backdrop="static"
              data-bs-keyboard="false"
              tabindex="-1"
              role="dialog"
            >
              <div class="modal-dialog modal-dialog-centered mod" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-warning">
                    <h3 class="modal-title text-center w-100 fw-bold">Update post</h3>
                  </div>
                  <div class="modal-body">
                    <input
                      type="text"
                      v-model="post_title"
                      class="form-control my-3 border"
                      name="post_title"
                      placeholder="Post Title"
                    />
                    <div v-if="errors.post_title" class="text-danger">{{ errors.post_title }}</div>
                    <textarea
                      type="text"
                      v-model="post_body"
                      class="form-control my-3"
                      maxlength="200"
                      name="post_title"
                      placeholder="Post Body"
                    ></textarea>
                    <div v-if="errors.post_body" class="text-danger">{{ errors.post_body }}</div>
                  </div>
                  <div class="modal-footer">
                    <button
                      type="button"
                      id="dismissUpdate"
                      data-bs-dismiss="modal"
                      class="btn btn-secondary text-light"
                    >Cancel</button>
                    <button
                      type="button"
                      class="btn btn-primary text-light"
                      @click="updateService"
                    >Update Service</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end edit  -->
          </div>
          <div class="card mt-4">
            <h5 class="card-header">Comments</h5>
            <div class="card-body">
              <form @submit.prevent="addNewComment()">
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
              <div>
                <div class="card" v-for="comment in comments.data" :key="comment.id">
                  <div>
                    <div class="card-header"></div>
                    <div class="card-body">
                      <div>
                        <span style="font-size: 1.2rem; font-weight: bold">Comment:</span>
                        {{ comment.body }}
                      </div>
                      <div>
                        <span style="font-size: 1rem; font-weight: bold">Created At:</span>
                        {{ comment.created_at }}
                      </div>
                      <button
                        type="submit"
                        class="btn btn-danger"
                        @click="deleteComment(comment.id)"
                      >Delete</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

  <script>
import axios from "axios";
import Swal from "sweetalert2";
import "@fortawesome/fontawesome-free/css/all.css";

export default {
  data() {
    return {
      posts: [],
      comments: [],
      commentCount: 0,
      user_id: this.user_id,
      newCommentBody: "",
      post_id: 9,
      post_title: "",
      post_body: "",
      update_postID: null,
      errors: {}
    };
  },
  props: ["user_id"],
  created() {
    this.fetchPosts();
  },
  methods: {
    fetchPosts() {
      axios
        .get(`http://localhost:8000/api/posts/5`)
        .then(response => {
          this.posts = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    addNewComment() {
      const data = {
        body: this.newCommentBody,
        post_id: this.post_id,
        user_id: 1,
        commentable_type: "Post",
        commentable_id: this.post_id
      };

      if (this.newCommentBody == "") {
        alert("fehler");
        return false;
      }
      axios
        .post(`http://localhost:8000/api/posts/${this.post_id}/comments`, data)
        .then(res => {
          alert("Your comment has been added");
          this.newCommentBody = "";
        })
        .catch(() => {
          alert("Something went wrong!");
          console.log(data);
        });
    },
    setupTimer() {
      this.timer = setInterval(() => {
        this.fetchComments();
      }, 2000);
    },
    //=======================update post===========================
    updatePost() {
      const requestData = {
        title: this.post_title,
        body: this.post_body,
        user_id: this.user_id
      };
      this.errors = {};
      if (this.validateForm()) {
        axios
          .put("api/posts/" + this.post_id, requestData)
          .then(() => {
            Swal.fire({
              icon: "success",
              title: "Success",
              text: "Post updated successfully!"
            });
            const close = document.getElementById("dismissUpdate");
            close.click();
            this.fetchPosts();
            this.emptyForm();
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    deletePost(post_id) {
      Swal.fire({
        title: "Confirm Delete",
        text: "Are you sure you want to delete?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
        dangerMode: true,
        allowOutsideClick: false
      }).then(result => {
        if (result.isConfirmed) {
          this.deleteItem(post_id);
        }
      });
    },
    deleteItem(post_id) {
      axios
        .delete("api/posts/" + post_id)
        .then(() => {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: "Post deleted successfully!"
          });
          this.posts = this.posts.filter(post => post.id !== post_id);
        })
        .catch(error => {
          console.error(error);
        });
    },
    openUpdateModal(post) {
      this.post_title = post.title;
      this.post_body = post.body;
      this.update_postID = post.id;
    },
    //========================comments==========================

    deleteComment(comment_id) {
      Swal.fire({
        title: "Confirm Delete",
        text: "Are you sure you want to delete?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
        dangerMode: true,
        allowOutsideClick: false
      }).then(result => {
        if (result.isConfirmed) {
          this.deleteItem(comment_id);
        }
      });
    },
    deleteItem(comment_id) {
      axios
        .delete("api/posts/" + comment_id)
        .then(() => {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: "comment deleted successfully!"
          });
          this.posts = this.posts.filter(comment => comment.id !== comment_id);
        })
        .catch(error => {
          console.error(error);
        });
    },

    fetchComments() {
      axios
        .get(`http://127.0.0.1:8000/api/comments/7`)
        .then(response => {
          this.comments = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  mounted() {
    this.fetchComments();
    this.setupTimer();
  }
};
</script>


    <style>
</style>


