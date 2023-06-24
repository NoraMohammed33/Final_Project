<template>
    <div>
        <h1>Create User</h1>
        <form @submit.prevent="createUser">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" v-model="user.name" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" v-model="user.email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" v-model="user.password" required>
            </div>
            <div>
                <label for="dept_id">Department:</label>
                <select id="dept_id" v-model="expert.dept_id" required>
                    <option v-for="department in departments" :value="department.id" :key="department.id">{{ department.name }}</option>
                </select>
            </div>
            <div>
                <label for="bio">Bio:</label>
                <textarea id="bio" v-model="expert.bio" required></textarea>
            </div>
            <button type="submit">Create User and Expert</button>
        </form>
    </div>
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
            axios.post('/api/users', this.user)
                .then(response => {
                    this.expert.user_id = response.data.id;
                    return axios.post('/api/experts', this.expert);
                })
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
        // Fetch the departments from the API and populate the departments array
        axios.get('/api/departments')
            .then(response => {
                this.departments = response.data;
            })
            .catch(error => {
                console.error(error);
            });
    },
};
</script>
