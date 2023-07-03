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



                            <td>
                                <i class="fas fa-trash fs-4 text-danger ms-4 me-5" @click="deleteService(service.id)"></i>
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
import Swal from "sweetalert2";
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


        deleteService(serviceID) {
            Swal.fire({
                icon: "warning",
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: "#d9534f",
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete("http://localhost:8000/api/experts/" + serviceID)
                        .then(() => {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: "service deleted successfully",
                                confirmButtonColor: "#5cb85c",
                            });
                            this.fetchServices();
                        })
                        .catch((error) => {
                            console.log(error.response.data);
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
