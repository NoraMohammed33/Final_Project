<template>
  <div class="posts-container">
    <h2 class="section-title">All Posts</h2>
    <div class="post-list">
      <div v-for="post in posts.data" :key="post.id" class="post-item">
        <v-card-text class="pt-2">
          <h3 class="post-title">{{ post.title }}</h3>
          <div class="post-body">
            <textarea v-model="post.body" class="post-textarea" rows="3" readonly></textarea>
          </div>
        </v-card-text>
        <v-card-actions>
          <v-btn id="explore" color="blue" class="border rounded-2">Explore</v-btn>
          <div class="ms-auto">
            <i
              class="fas fa-edit fs-4 text-warning"
              @click="openUpdateModal(post)"
              data-bs-toggle="modal"
              data-bs-target="#update_modal"
            ></i>
            <i class="fas fa-trash fs-4 text-danger ms-4" @click="deletePost(post.id)"></i>
          </div>
        </v-card-actions>
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
                  @click="updatePost"
                >Update Post</button>
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

export default {
  data() {
    return {
      posts: [],
      post_title: "",
      post_body: "",
      update_postID: null,
      errors: {}
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
          //   console.log(response.data);
        })
        .catch(error => {
          console.error(error);
        });
    },
    openUpdateModal(post) {
      this.update_postID = post.id;
      Swal.fire({
        title: "Update Post",
        html: `
            <input
              type="text"
              v-model="posts.find(p => p.id === updatePostId).title"
              class="swal2-input"
              placeholder="Post Title"
            />
            <textarea
              v-model="posts.find(p => p.id === updatePostId).body"
              class="swal2-textarea"
              placeholder="Post Body"
            ></textarea>
          `,
        showCancelButton: true,
        confirmButtonText: "Update",
        cancelButtonText: "Cancel",
        preConfirm: () => {
          this.updatePost();
        }
      });
    },
    updatePost() {
      const requestData = {
        title: this.post_title,
        body: this.post_body
      };
      this.errors = {};
      if (this.validateForm()) {
        axios
          .put(
            "http://localhost:8000/api/posts" + this.update_postID,
            requestData
          )
          .then(() => {
            Swal.fire({
              icon: "success",
              title: "Success",
              text: "Service updated successfully!"
            });
            const close = document.getElementById("dismissUpdate");
            close.click();
            this.fetchposts();
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
        .delete("http://localhost:8000/api/posts/" + post_id)
        .then(() => {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: "Post deleted successfully!"
          });
          this.posts = this.posts.filter(post => post.id !== post_id);
        //   console.log(post.id);
        })
        .catch(error => {
          console.error(error);
        });
    },

    openUpdateModal(post) {
      this.post_title = post.title;
      this.post_body = post.body;
    },
    validateForm() {
      let isValid = true;
      if (!this.post_title.trim()) {
        this.errors.post_title = "Please Enter The Title";
        isValid = false;
      }
      if (!this.post_body.trim()) {
        this.errors.post_body = "Please Enter a Post Body";
        isValid = false;
      }
      return isValid;
    }
  }
};
</script>

<style scoped>
.posts-container {
  width: 70%;
  margin: 0 auto;
  padding: 20px;
}

.section-title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

.post-list {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.post-item {
  border: 1px solid #ccc;
  padding: 20px;
  background-color: #f9f9f9;
}

.post-title {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

.post-body {
  margin-bottom: 10px;
}

.post-textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  resize: none;
}

.post-actions {
  display: flex;
  gap: 10px;
}

.action-button {
  padding: 8px 16px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.action-button:hover {
  background-color: #0056b3;
}
</style>

