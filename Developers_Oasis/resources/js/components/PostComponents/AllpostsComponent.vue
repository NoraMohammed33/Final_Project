<template>
  <div class="posts-container">
    <!-- Add Post Component -->
    <!-- <AddPostComponent @post-saved="handlePostSaved"></AddPostComponent> -->
    <div>
      <div>
        <input
          v-model="searchInput"
          type="text"
          class="form-control"
          placeholder="Search post"
          id="search"
        />
      </div>
      <div class="post-list">
        <div v-for="post in filteredPosts" :key="post.id" class="post-item">
          <v-card class="post-card">
            <v-card-title class="post-title">{{ post.title }}</v-card-title>
            <v-card-text class="post-body">
              <textarea v-model="post.body" class="post-textarea" rows="3" readonly></textarea>
            </v-card-text>
            <v-card-actions>
              <v-btn
                id="explore"
                color="blue"
                class="border rounded-2"
                @click="explorePost(post.id)"
              >Explore</v-btn>
              <div class="ms-auto">
                <!-- Edit Post Icon -->
                <i
                  v-if="currentUser.id === post.user_id"
                  class="fas fa-edit fs-4 text-warning"
                  @click="openUpdateModal(post)"
                  data-bs-toggle="modal"
                  data-bs-target="#update_modal"
                ></i>
                <!-- Delete Post Icon -->
                <i
                  v-if="currentUser.id === post.user_id"
                  class="fas fa-trash fs-4 text-danger ms-4"
                  @click="deletePost(post.id)"
                ></i>
              </div>
            </v-card-actions>
          </v-card>
        </div>
      </div>
    </div>

    <!-- Update Post Modal -->
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
            <button type="button" class="btn btn-primary text-light" @click="updatePost">Update Post</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Post Details Modal -->
    <div class="modal fade" id="post_details_modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered mod" role="document">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <h3 class="modal-title text-center w-100 fw-bold">{{ postDetails.title }}</h3>
          </div>
          <div class="modal-body">
            <p>{{ postDetails.body }}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary text-light" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <div class="pagination text-center">
      <button
        class="btn btn-primary mx-2"
        v-if="posts.current_page > 1"
        @click="changePage(posts.current_page - 1)"
      >Previous</button>
      <button
        class="btn btn-primary"
        v-if="posts.current_page < posts.last_page"
        @click="changePage(posts.current_page + 1)"
      >Next</button>
      <br />
      <br />
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
import AddPostComponent from "./AddPostComponent.vue";
import "@fortawesome/fontawesome-free/css/all.css";

export default {
  data() {
    return {
      posts: [],
      post_title: "",
      post_body: "",
      update_postID: null,
      errors: {},
      postDetails: { title: "", body: "" },
      currentUser: {},
      searchInput: "",
      currentPage: 1
    };
  },
  components: {
    AddPostComponent
  },
  mounted() {
    this.fetchPosts();
  },
  computed: {
    filteredPosts() {
      if (!this.searchInput) {
        return this.posts.data;
      }
      const search = this.searchInput.toLowerCase();
      return this.posts.data.filter(
        post =>
          post.title.toLowerCase().includes(search) ||
          post.body.toLowerCase().includes(search)
      );
    }
  },
  methods: {
    fetchPosts() {
      axios
        .get("/api/posts", {
          params: {
            search: this.searchInput,
            page: this.currentPage
          }
        })
        .then(response => {
          this.posts = response.data.posts;
          this.currentUser = response.data.loggeduser;

          if (this.currentPage !== 1 && this.filteredPosts.length === 0) {
            axios
              .get("/api/posts", {
                params: {
                  search: this.searchInput,
                  page: 1
                }
              })
              .then(response => {
                this.posts = response.data.posts;
              })
              .catch(error => {
                console.log(error);
              });
          }
        })
        .catch(error => {
          console.log(error);
        });
    },

    changePage(page) {
      this.currentPage = page;
      this.fetchPosts();
    },

    handlePostSaved() {
      this.fetchPosts();
    },
    openUpdateModal(post) {
      this.errors = {};
      this.update_postID = post.id;
      this.post_title = post.title;
      this.post_body = post.body;
    },
    updatePost() {
      this.errors = {};
      if (!this.post_title) {
        this.errors.post_title = "Please enter a title.";
      }
      if (!this.post_body) {
        this.errors.post_body = "Please enter a post body.";
      }
      if (Object.keys(this.errors).length === 0) {
        axios
          .put(`/api/posts/${this.update_postID}`, {
            title: this.post_title,
            body: this.post_body
          })
          .then(response => {
            this.fetchPosts();
            Swal.fire({
              title: "Success!",
              text: "Post has been updated successfully.",
              icon: "success",
              showConfirmButton: false,
              timer: 1500
            });
            document.getElementById("dismissUpdate").click();
            this.errors = {};
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    deletePost(postID) {
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
            .delete(`/api/posts/${postID}`)
            .then(response => {
              this.fetchPosts();
              Swal.fire({
                title: "Deleted!",
                text: "Post has been deleted successfully.",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
              });
            })
            .catch(error => {
              console.log(error);
            });
        }
      });
    },
    explorePost(postID) {
      axios
        .get(`/api/posts/${postID}/explore`)
        .then(response => {
          const post = response.data.data.post;
          this.postDetails.body = post.body;
          this.postDetails.title = post.title;
          console.log(post);
          console.log(this.postDetails);
          this.$router.push({ path: `/posts/${post.id}` });
          $("#post_details_modal").modal("show");
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

<style scoped>
.posts-container {
  margin-top: 30px;
  width: 70%;
  margin-left: auto;
  margin-right: auto;
  border: 5px;
}

.post-item {
  margin-bottom: 20px;
}

.post-card {
  width: 100%;
  border: 3px solid #ccc;
  border-radius: 5px;
  padding: 10px;
}

.post-title {
  background-color: #f8f9fa;
  padding: 10px;
  font-size: 18px;
  font-weight: bold;
}

.post-body {
  padding: 10px;
  font-size: 14px;
  background-color: #fff;
}

.post-textarea {
  width: 100%;
  border: none;
  resize: none;
  font-size: 14px;
  font-family: "Segoe UI", Arial, sans-serif;
  color: #333;
}

.modal-content {
  width: 100%;
  border-radius: 0;
}

.modal-header {
  border-bottom: none;
}

.modal-title {
  color: #fff;
}

.modal-body {
  padding: 20px;
}

.modal-footer {
  justify-content: flex-start;
}

.btn-primary {
  background-color: #17a2b8;
  border-color: #17a2b8;
}

.btn-secondary {
  background-color: #6c757d;
  border-color: #6c757d;
}

.mod {
  width: 500px;
}

.fa-edit,
.fa-trash {
  cursor: pointer;
}
#search {
  width: 600px;
  margin-left: 190px;
  padding: 4px;
  border-radius: 5px;
  margin-bottom: 40px;
  margin-top: 40px;
  height: 40px;
  background: #fff;
}
.pagination {
  display: flex;
  justify-content: center;
  margin-top: 20px;
}
</style>
