<template>
    <div class="d-flex justify-content-center">
        <v-card  class="w-50">
            <v-card-title>Create User and Expert</v-card-title>
            <v-card-text>
                <v-form @submit.prevent="createUser">
                    <v-text-field v-model="user.name" label="Name" required></v-text-field>
                    <v-text-field v-model="user.email" label="Email" type="email" required></v-text-field>
                    <v-text-field v-model="user.password" label="Password" type="password" required></v-text-field>
<!--                    <v-select v-model="expert.dept_id" :items="departments" label="Department" required>-->
<!--                    </v-select>-->
                    <label>department</label>
                    <select class="form-control mb-2" v-model="user.dept_id" >

                        <option

                            v-for="department in departments.data"
                            :key="department.id"
                            :value="department.id"
                        >{{ department.name }}</option>
                    </select>
                    <v-textarea v-model="user.bio" label="Bio" required></v-textarea>
                    <v-btn color="green" type="submit">Create User and Expert</v-btn>
                </v-form>
            </v-card-text>
        </v-card>
    </div>
</template>
<script>
import axios from 'axios';
import Swal from "sweetalert2";

export default {
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: '',
                // user_id:'',
                dept_id: '',
                bio: '',
            },
            expert: {
            },
            departments: [], // Fetch the departments from the API and populate this array
        };
    },
    methods: {
        createUser() {
            axios.post('http://localhost:8000/api/experts', this.user, {
                headers: {
                    "Content-Type": 'multipart/form-data'
                },
            })
                .then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'expert saved successfully!'
                    });
                    this.$emit('expert-saved')
                    const close = document.getElementById('dismiss')
                    close.click()
                    this.emptyForm()
                        // .then(response => {
                        //     // Success: Handle any additional logic or redirects here
                        //     console.log('User and expert created successfully');
                        // })
                        .catch(error => {
                            // Error: Handle the error response
                            console.error(error);
                        });
                })
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
