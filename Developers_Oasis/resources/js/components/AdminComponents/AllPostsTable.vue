<template>
    <v-container>

        <v-row>
            <table class="w-75">
                <thead>
                <tr>
                    <th
                        class="

                    px-6
                    py-3
                    text-xs
                    font-medium
                    leading-4
                    tracking-wider
                    text-left text-gray-500
                    uppercase
                    border-b border-gray-200
                    bg-gray-50
                  "
                    >
                        title
                    </th>
                    <th
                        class="
                    px-6
                    py-3
                    text-xs
                    font-medium
                    leading-4
                    tracking-wider
                    text-left text-gray-500
                    uppercase
                    border-b border-gray-200
                    bg-gray-50
                  "
                    >
                        body
                    </th>


                    <th class="px-6 py-3 bg-gray   px-6
                    py-3
                    text-xs
                    font-medium
                    leading-4
                    tracking-wider
                    text-left text-gray-500
                    uppercase
                    border-b border-gray-200
                    bg-gray-50">created by</th>
                    <th class="px-6 py-3 bg-gray   px-6
                    py-3
                    text-xs
                    font-medium
                    leading-4
                    tracking-wider
                    text-left text-gray-500
                    uppercase
                    border-b border-gray-200
                    bg-gray-50">department</th>
                </tr>
                </thead>

                <tbody class="bg-white">
                <tr v-for="post in posts" :key="post">
                    <td
                        class="px-6 py-4 border-b border-gray-200 whitespace-nowrap"
                    >
                        {{post.title}}
                    </td>

                    <td
                        class="
                    px-6
                    py-4
                    text-sm
                    leading-5
                    text-gray-500
                    border-b border-gray-200
                    whitespace-nowrap
                  "
                    >
                        {{ post.body }}
                    </td>


<!--                    <td>-->
<!--                        <i class="fas fa-trash fs-4 text-danger ms-4 me-5" @click="deletePost(post.id)"></i>-->
<!--                    </td>-->
                    <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                        {{post.user.name}}
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                        {{post.department.name}}
                    </td>
                </tr>
                </tbody>
            </table>
        </v-row>
    </v-container>
</template>

<script  >
import { ref } from "vue";
import axios from "axios";
import Swal from "sweetalert2";
import "@fortawesome/fontawesome-free/css/all.css";
export default {

    data() {
        return {
            posts:[],
        }
    },
    components: {}
    ,
    mounted() {
        this.fetchPosts();
    },
    methods: {
        fetchPosts() {
            axios
                .get("http://localhost:8000/api/posts")
                .then((response) => {
                    this.posts = response.data["posts_admin"];
                    console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
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
                        .delete(`http://localhost:8000/api/posts/${postID}`)
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
    },
};
</script>
<style scoped>
i:hover{
    scale: 1.2;
    transition: 5ms;
    cursor: pointer;
}
</style>
