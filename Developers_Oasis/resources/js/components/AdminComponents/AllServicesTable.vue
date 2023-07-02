<template>
    <div>
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
                                description
                            </th>


                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                        </thead>

                        <tbody class="bg-white">
                        <tr v-for="service in services" :key="service">
                            <td
                                class="px-6 py-4 border-b border-gray-200 whitespace-nowrap"
                            >
                                <div class="flex items-center">


                                    <div class="ml-4">
                                        <div class="text-sm font-medium leading-5 text-gray-900">
                                            {{service.title}}
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
                  >{{service.description}}</span
                  >
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
        services:[]
    };
}
,
mounted() {
    this.fetchServices();
},
    methods: {
        fetchServices() {
            axios
                .get("http://localhost:8000/api/services")
                .then((response) => {
                    this.services = response.data["services"];
                    console.log(this.services)
                })
                .catch((error) => {
                    console.log(error);
                });
        },
},
};
</script>
