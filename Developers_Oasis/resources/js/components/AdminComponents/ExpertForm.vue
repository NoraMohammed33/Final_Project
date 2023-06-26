<template>
    <v-container class="d-flex justify-content-center">
        <v-card  class="w-50">
            <v-card-title>Create User and Expert</v-card-title>
            <v-card-text>
                <v-form @submit.prevent="createUser">
                    <v-text-field v-model="user.name" label="Name" required></v-text-field>
                    <v-text-field v-model="user.email" label="Email" type="email" required></v-text-field>
                    <v-text-field v-model="user.password" label="Password" type="password" required></v-text-field>
<!--                    <v-select v-model="expert.dept_id" :items="departments" label="Department" required>-->
<!--                    </v-select>-->
                    <select class="form-control" v-model="expert.dep_id" name="dep_id" id="dep_id" placeholder="select dept">

                        <option

                            v-for="department in departments.data"
                            :key="department.id"
                            :value="department.id"
                        >{{ department.name }}</option>
                    </select>
                    <v-textarea v-model="expert.bio" label="Bio" required></v-textarea>
                    <v-btn color="green" type="submit">Create User and Expert</v-btn>
                </v-form>
            </v-card-text>
        </v-card>
    </v-container>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: '',
            },
            expert: {
                dept_id: '',
                bio: '',
            },
            departments: [], // Fetch the departments from the API and populate this array
        };
    },
    methods: {
        createUser() {
            axios.post('/api/users', this.user,{
                headers: {
                    "Content-Type": "application/json"
                },
            })
                // .then(response => {
                //     this.expert.user_id = response.data.id;
                //     return axios.post('/api/experts', this.expert);
                //
                // })
                .then(response => {
                    // Success: Handle any additional logic or redirects here
                    console.log('User and expert created successfully');
                })
                .catch(error => {
                    // Error: Handle the error response
                    console.error(error);
                });
        },
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
