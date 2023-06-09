<template>
   <div class="container">
      <div class="row justify-content-center">
        <div class="card my-3">
          <h5 class="card-header">Post Details</h5>
          <div class="card-body">
            <div class="mb-3">
              <h6 class="font-weight-bold">Title:</h6>
              <p>perspiciatis quidem vel magni.</p>
            </div>
            <div class="mb-3">
              <h6 class="font-weight-bold">Body:</h6>
              <p>
                perspiciatis quidem vel magni. Fugiat sed ipsa tempore,
                excepturi eligendi
              </p>
            </div>

            <div class="card mt-4">
              <h5 class="card-header">Comments</h5>
              <div class="card-body">
                <form
                  action="{{ route('comments.store', ['user_id' => $post->user_id, 'commentable_id' => $post->id, 'commentable_type' => get_class($post)]) }}"
                  method="POST"
                >
                  <div class="form-group">
                    <textarea
                      name="body"
                      id="body"
                      cols="15"
                      rows="4"
                      class="form-control"
                      placeholder="Your comment here"
                    ></textarea>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                      Add Comment
                    </button>
                  </div>
                </form>

                <div class="mt-4">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div
                        class="d-flex justify-content-between align-items-center"
                      >
                        <h6 class="font-weight-bold mb-0">Comment:</h6>
                        <div>
                          <a href="#" class="btn btn-warning btn-sm mr-2"
                            >Edit</a
                          >
                          <form method="POST" style="display: inline">
                            <button
                              type="submit"
                              class="btn btn-danger btn-sm"
                              onclick="return confirm('Are you sure you want to delete this comment?');"
                            >
                              Delete
                            </button>
                          </form>
                        </div>
                      </div>
                      <p class="mt-3">
                        Lorem, ipsum dolor sit amet consectetur adipisicing
                        elit, rem aut, ipsum eveniet ullam similique minima
                        sapiente!
                      </p>
                      <p class="font-weight-bold">Created At:</p>
                    </div>
                  </div>
                  <div>No comments yet</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
