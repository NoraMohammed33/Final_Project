<template>
    <div>

        <v-row>
            <table class="min-w-full">
                <thead>
                <tr>
                    <th
                        class="
                        w-100
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


                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                </tr>
                </thead>

                <tbody class="bg-white">
                <tr v-for="post in posts.data" :key="post">
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


                </tr>
                </tbody>
            </table>
        </v-row>
    </div>
</template>

<script  >
import { ref } from "vue";
import axios from "axios";
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
                    this.posts = response.data["posts"];
                    // console.log(this.posts.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
