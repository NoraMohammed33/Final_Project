<template>
    <div>
<v-row>

    <v-btn color="green">
       <router-link :to="'/admin/dashboard/addexpert'" >add expert</router-link>
    </v-btn>
</v-row>
    <v-row>
                    <table class="min-w-full">
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
                                Name
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
                                department
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
                                bio
                            </th>

                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                        </thead>

                        <tbody class="bg-white">
                        <tr v-for="i in experts" :key="i">
                            <td
                                class="px-6 py-4 border-b border-gray-200 whitespace-nowrap"
                            >
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img
                                            class="w-10 h-10 rounded-full"
                                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                            alt=""
                                        />
                                    </div>

                                    <div class="ml-4">
                                        <div class="text-sm font-medium leading-5 text-gray-900">
                                            {{ i.user.name }}
                                        </div>
                                        <div class="text-sm leading-5 text-gray-500">
                                            {{ i.user.email }}
                                        </div>
                                    </div>
                                </div>
                            </td>



                            <td
                                class="px-6 py-4 border-b border-gray-200 whitespace-nowrap"
                            >
                  <span
                      class="
                      inline-flex
                      px-2
                      text-xs
                      font-semibold
                      leading-5
                      text-green-800
                      bg-green-100
                      rounded-full
                    "
                  >{{i.department.name}}</span
                  >
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
                                {{ i.bio }}
                            </td>

                            <td
                                class="
                    px-6
                    py-4
                    text-sm
                    font-medium
                    leading-5
                    text-right
                    border-b border-gray-200
                    whitespace-nowrap
                  "
                            >

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
experts:[]
    };
}
,
mounted() {
    this.fetchExperts();
},
    methods: {
        fetchExperts() {
            axios
                .get("http://localhost:8000/api/experts?include=department")
                .then((response) => {
                    this.experts = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
},
};
</script>
