<template>
    <div class="con">
    <form @submit.prevent="addPost" class="container ">
        <div class="col-lg-7 col-md-8 col-sm-10 rounded-5" id="c">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-left" id="h">Add New Post</h3>
                </div>
                <div class="col-md-6">
                    <span class="glyphicon glyphicon-pencil " id="gg"></span>
                </div>
            </div>
            <hr />
            <div class="row">
                <label for="title" class="label col-md-2 col-sm-12 control-label" id="l">Title</label>
                <div class="col-md-10 col-sm-12">
                    <input type="text" id="title" v-model="newPost.title" class="form-control" required />
                </div>
            </div>
            <hr />
            <div class="row">
                <label for="body" class="label col-md-2 col-sm-12 control-label" id="l">Body</label>
                <div class="col-md-10 col-sm-12">
                    <textarea id="body" v-model="newPost.body" class="form-control" required></textarea>
                </div>
            </div>
            <hr />
            <div class="row">
                <label for="dep_id" class="label col-md-2 col-sm-12 control-label" id="l">Department</label>
                <div class="col-md-10 col-sm-12">
                    <select class="form-control" v-model="newPost.dep_id" name="dep_id" id="dep_id">
                        <option v-for="department in departments.data" :key="department.id" :value="department.id">
                            {{ department.name }}
                        </option>
                    </select>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center">
                    <button class="btn  btn-rounded" id="button" type="submit">Add Your Post</button>
                </div>
            </div>
        </div>
    </form>
    </div>
</template>
  <script>
import axios from "axios";

export default {
  data() {
    return {
        departments: [],
        newPost: {
        title: "",
        body: "",
        dep_id: ""
    }
    };
    },
    methods: {
        addPost() {
          axios
              .post("http://localhost:8000/api/posts/", this.newPost)
              .then(response => {
                  console.log(response.data);
                  const postId = response.data.id;
                  // this.resetForm();
                  this.$router.push("/posts"); // Redirect to /posts route
                  $("#post_details_modal").modal("show");
              })
              .catch(error => {
                  console.log(error);
              });
      },
    resetForm() {
      this.newPost = {
        title: "",
        body: "",
        dep_id: null
      };
    }
  },
  mounted() {
    axios
      .get(`http://localhost:8000/api/departments`)
      .then(response => {
        this.departments = response.data;
        // console.log(this.departments);
      })
      .catch(error => {
        console.log(error);
      });
  }
};
</script>

<style scoped>
.con{
        background: url(../Z3BcMC.jpg);

}
.container {
    display: flex;
    justify-content: center;
    align-items: center;
}

#h {
    font-size: 25px;
    color: white;
}

#c {
    /* box-shadow: -1px 1px 60px 10px black; */
    background: rgba(42, 52, 56, 0.4);
    text-align: center;
    display: inline-block;
    vertical-align: middle;
    margin-bottom: 10px;
    padding: 20px;
    width: 100%;
    max-width: 800px;
}

#l {
    font-weight: normal;
    margin-top: 15px;
    color: white;
    font-size: 18px;
}

#title {
    width: 100%;
    height: 40px;
}

#body {
    width: 100%;
    height: 250px;
    border-radius: 7px;
    position: relative;
    margin-bottom: 10px;
}

#dep_id {
    width: 100%;
    height: 40px;
}

#button {
    /* width: 100%; */
    height: 40px;
    padding-right: 9px;
    cursor: pointer;
    margin-top: 10px;
    background: rgb(152, 191, 211);
}
#button:hover{
    scale: 1.1;
}
</style>
