<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card my-3" v-for="post in posts" :key="post.id">
        <h5 class="card-header">{{ post.title }}</h5>
        <div class="card-body">
          <div class="mb-3">
            <p>{{ post.body }}</p>
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
                        <span style="font-size: 1rem; font-weight: bold">Created by:</span>
                        {{ comment.user_id.name }}
                      </div>
                    </div>
                  </div>

                  <div class="ms-auto">
                    <!-- Edit Post Icon -->
                    <i
                      class="fas fa-edit fs-4 text-warning"
                      @click="openUpdateModal(comment)"
                      data-bs-toggle="modal"
                      data-bs-target="#update_modal"
                    ></i>
                    <!-- Delete Post Icon -->
                    <i class="fas fa-trash fs-4 text-danger ms-4" @click="deleteComment(comment.id)"></i>
                  </div>
                  <div class="modal fade" id="update_modal" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered mod" role="document">
                      <div class="modal-content">
                        <div class="modal-header bg-warning">
                          <h3 class="modal-title text-center w-100 fw-bold">Update comment</h3>
                        </div>
                        <div v-if="errors.comment_body"  class="text-danger" >{{ errors.comment_body }}</div>
                        <textarea type="text" v-model="comment_body" class="form-control my-3" maxlength="200" name="post_title" placeholder="comment Body"></textarea>
                        <div class="modal-footer">
                          <button type="button" id="dismissUpdate" data-bs-dismiss="modal" class="btn btn-secondary text-light">Cancel</button>
                          <button type="button" class="btn btn-primary text-light" @click="updateComment">Update comment</button>
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
    </div>
  </div>
</template>

  <script>
import axios from "axios";

export default {
  data() {
    return {
      posts: [],
      comments: [],
      commentCount: 0,
      user_id: this.user_id,
      newCommentBody: "",
      update_commentID: null,
      errors: {},
      comment_body: "",
      commentDetails: { body: "" },
      post_id: this.$route.params.id
    };
  },
  created() {
    this.fetchPosts();
  },
  methods: {
    fetchPosts() {
      axios
        .get(`http://localhost:8000/api/posts/${this.post_id}`)
        .then(response => {
          this.posts = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    fetchComments() {
      axios
        .get(`http://127.0.0.1:8000/api/comments/${this.post_id}`)
        .then(response => {
          this.comments = response.data;
          //   console.log(response.data);
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
        alert("Please enter the body of the comment");
        return false;
      }
      axios
        .post(`http://localhost:8000/api/posts/7/comments`, data)
        .then(res => {
          alert("Your comment has been added");
          this.newCommentBody = "";
        })
        .catch(() => {
          alert("Something went wrong!");
          //   console.log(data);
        });
    },
    setupTimer() {
      this.timer = setInterval(() => {
        this.fetchComments();
      }, 1000);
    },

    openUpdateModal(comment) {
      this.update_commentID = comment.id;
      this.comment_body = comment.body;
    },
    updateComment() {
      this.errors = {};
      if (!this.comment_body) {
        this.errors.comment_body = "Please enter a comment body.";
      }
      if (Object.keys(this.errors).length === 0) {
        axios
          .put(`/api/comments/${this.post_id}/${this.update_commentID}`, {
            body: this.comment_body
          })
          .then(response => {
            this.fetchComments();
            $("#update_modal").modal("hide");
            Swal.fire({
              title: "Success!",
              text: "Comment has been updated successfully.",
              icon: "success",
              showConfirmButton: false,
              timer: 1500
            });
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    deleteComment(commentID) {
      Swal.fire({
        title: "Are you sure?",
        text: "This action cannot be undone.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.isConfirmed) {
          axios
         .delete(`/api/comments/${commentID}`)
         .then(response => {
              this.fetchComments();
              Swal.fire({
                title: "Deleted!",
                text: "comment has been deleted successfully.",
                icon: "success",
                showConfirmButton: false,
                timer: 15000
              });
            })
            .catch(error => {
              console.log(error);
            });
        }
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
