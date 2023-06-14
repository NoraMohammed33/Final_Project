<template>
    <div>
        <h2>Create Expert</h2>
        <!-- Form fields for dept_id, bio, and user_id -->
        <form @submit="createExpert">
            <label for="dept_id">Department ID:</label>
            <input type="text" v-model="deptId" required>

            <label for="bio">Bio:</label>
            <input type="text" v-model="bio" required>

            <label for="user_id">User ID:</label>
            <input type="text" v-model="userId" required>

            <button type="submit">Create Expert</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            deptId: '',
            bio: '',
            userId: '',
        };
    },
    methods: {
        createExpert() {
            axios
                .post("/api/addexpert", {
                    dept_id: this.deptId,
                    bio: this.bio,
                    user_id: this.userId,
                })
                .then((response) => {
                    this.experts = response.data;
                    // Handle successful creation
                })
                .catch((error) => {
                    // Handle error
                    console.log(error);
                });
        },
    },
};
</script>

<style>
/* Component styles go here */
</style>
