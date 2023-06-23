<template>
  <form @submit.prevent="addPost" class="container">
    <div>
      <div class="col-md-7" id="c">
        <div class="raw">
          <div class="col-md-6">
            <h3 class="text-left" id="h">Add New Post</h3>
          </div>
          <div class="col-md-6">
            <span class="glyphicon glyphicon-pencil " id="gg"></span>
          </div>
        </div>
        <hr />
        <div class="row">
          <label for="title" class="label col-md-2 control-label" id="l">Title</label>
          <div class="col-md-10">
            <input type="text" id="title" v-model="newPost.title" class="form-control" required />
          </div>
        </div>
        <hr />
        <div class="row">
          <label for="body" class="label col-md-2 control-label" id="l">Body</label>
          <div class="col-md-10">
            <textarea id="body" v-model="newPost.body" class="form-control" required></textarea>
          </div>
        </div>
        <hr />
        <div class="row">
          <label for="dep_id" class="label col-md-2 control-label" id="l">Department</label>
          <div class="col-md-10">
            <select class="form-control"  v-model="newPost.dep_id" name="dep_id" id="dep_id">
              <option
                v-for="department in departments.data"
                :key="department.id"
                :value="department.id"
              >{{ department.name }}</option>
            </select>
          </div>
        </div>
        <hr />
        <div class="row">
          <button class="btn btn-info" id="buttun" type="submit"> Add You Post</button>
          &nbsp; &nbsp; &nbsp;
        </div>
      </div>
    </div>
  </form>
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
            this.resetForm();
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
        console.log(this.departments);
      })
      .catch(error => {
        console.log(error);
      });
  }
};
</script>
<style scoped>
*{
    margin:2px;
    padding:2px;

  }
  body{
      font-family:  'Times New Roman', Times, serif;
  }
  h1{
      font-size: 50px;
      color: white;
  }
  #hh{
    margin-top: 250px;
    font-size: 25px;
    color: white;
  }
  #h{
    font-size: 25px;
    color: white;
  }
#c{
    margin-top: 30px;
    box-shadow: -1px 1px 60px 10px black;
    background: rgb(0,0,0,0.4);
    text-align: center;
    display: inline-block;
    vertical-align: middle;
    margin-left:350px;
    margin-bottom: 10px;
}

#l{
    font-weight: normal;
    margin-top: 15px;
    color: white;
    font-size: 18px;
}
#title{
    width: 700px;
    height:40px ;
}
#body{
    width: 700px;
    height:70px;
    border-radius: 7px;
    position: relative;
    margin-bottom: 10px;
}
#dep_id{
    width: 700px;
    height:40px ;
}
#buttun{
    width: 700px;
    height:40px ;
    padding-right: 9px;
    cursor: pointer;
    margin:10px;
}

</style>
