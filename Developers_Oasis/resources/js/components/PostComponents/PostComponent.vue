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
              @click="deletePost()"
            >Delete Your post</button>
            <button type="button" class="btn btn-warning btn-sm">Edit Your post</button>
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

export default {
  data() {
    return {
      posts: [],
      comments: [],
      commentCount: 0,
      user_id: this.user_id,
      newCommentBody: "",
      post_id: 7
    };
  },
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
    deletePost() {
      axios
        .delete(`http://localhost:8000/api/posts/7`)
        .then(response => {
          console.log("post deleted");
        })
        .catch(error => {
          console.log(error);
        });
    },
    deleteComment(commentId) {
      axios
        .delete(`http://localhost:8000/api/posts/${this.post_id}/comments/${commentId}`)
        .then(response => {
          this.fetchComments();
          console.log("comment deleted");
        })
        .catch(error => {
          console.log(error);
        });
    },
    editComment(comment) {
      this.editMode = true;
      this.editedComment = Object.assign({}, comment);
    },
    updateComment() {
      const updatedComment = { ...this.editedComment };
      for (let key in updatedComment)
        if (!updatedComment[key]) delete updatedComment[key];
      axios
        .put(
          `/api/posts/${this.post_id}/comments/${this.editedComment.id}`,
          updatedComment
        )
        .then(response => {
          this.fetchComments();
          this.editMode = false;
          this.editedComment = {};
          toastr["success"]("Updated Successfully!");
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


