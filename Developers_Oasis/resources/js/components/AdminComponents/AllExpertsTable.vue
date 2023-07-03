<template>
    <v-container>
        <v-row>

        <router-link :to="'/admin/dashboard/addexpert'" class="mb-3">
            <v-btn color="green">
                add new expert
            </v-btn>
        </router-link>
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
                                            class="w-25 h-10 rounded-full"
<<<<<<< HEAD
                                        :src="'/images/'+i.user.image"
=======

                                            :src="'/images/'+i.user.image"
>>>>>>> ef92ed972a047c820c7e01622e9168241d5b1969
                                        alt=""
                                        />
<!--                                        :src="user.image ? '/storage/' + user.image : '/images/users/default.jpg'"  alt="Generic placeholder image"-->

                                    </div>

                                    <div class="ml-4">
                                        <div class="text-sm font-medium leading-5 text-gray-900">
                                            {{ i.user.name }}
                                        </div>
                                        <a class="text-sm leading-5 text-gray-500">
                                            {{ i.user.email }}
                                        </a>
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

                           <td>
                            <i class="fas fa-trash fs-4 text-danger ms-4 me-5" @click="deleteExpert(i.id)"></i>
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
import ExpertForm from './ExpertForm.vue'
import "@fortawesome/fontawesome-free/css/all.css";
export default {
data() {
    return {
experts:[]
    };
},
    components:{
    ExpertForm
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
        deleteExpert(expertID) {
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
                        .delete("http://localhost:8000/api/experts/" + expertID)
                        .then(() => {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: "expert deleted successfully",
                                confirmButtonColor: "#5cb85c",
                            });
                            this.fetchExperts();
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
