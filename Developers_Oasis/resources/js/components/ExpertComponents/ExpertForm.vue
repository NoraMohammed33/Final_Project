<template>
    <div>
        <h2>Create Expert</h2>
        <!-- Form fields for dept_id, bio, and user_id -->
        <form @submit.prevent="createExpert">
            <label htmlFor="dept_id">Department ID:</label>
            <input type="text" v-model="deptId" required>

            <label htmlFor="bio">Bio:</label>
            <input type="text" v-model="bio" required>

<!--            <label htmlFor="user_id">User ID:</label>-->
<!--            <input type="text" v-model="user_id" required>-->

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
            user_id: this.user_id,
        };

    },
    props:['user_id'],

    methods: {
        createExpert() {
            axios
                .post("/api/experts", {
                    dept_id: this.deptId,
                    bio: this.bio,
                    user_id: this.userId,
                })
                .then((response) => {
                    // Handle successful creation
                    console.log(response.data);
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
