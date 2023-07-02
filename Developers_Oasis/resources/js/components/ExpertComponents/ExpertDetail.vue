<template>
    <div>
        <div v-if="expert.user" class="expert-card-container">
            <v-card>
                <v-img class="align-end text-white" height="200" :src="'public/images/' + expert.user.image" cover></v-img>
                <v-card-title>{{ expert.user.name }}</v-card-title>
                <v-card-subtitle class="pt-4">{{ expert.user.email }}</v-card-subtitle>
                <v-card-subtitle class="pt-4">Department: {{ expert.department.name }}</v-card-subtitle>
                <v-card-text>
                    <div>Bio: {{ expert.bio }}</div>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn :icon="show ? 'mdi-chevron-up' : 'mdi-chevron-down'" @click="show = !show"></v-btn>
                </v-card-actions>
                <v-expand-transition>
                    <div v-show="show">
                        <h2>Details</h2>
                        <div>
                            <p><strong>Department ID:</strong> {{ expert.dept_id }}</p>
                            <p><strong>Bio:</strong> {{ expert.bio }}</p>
                            <p><strong>User ID:</strong> {{ expert.user_id }}</p>
                            <p><strong>Created At:</strong> {{ expert.created_at }}</p>
                            <p><strong>Updated At:</strong> {{ expert.updated_at }}</p>
                        </div>
                    </div>
                </v-expand-transition>
            </v-card>
        </div>
        <div v-else>
            User not found.
        </div>
        <div v-if="error">
            Failed to fetch expert details.
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            show: false,
            expert: {},
            error: false,
        };
    },
    mounted() {
        this.fetchExpert();
    },
    methods: {
        fetchExpert() {
            const expertId = this.$route.params.id;
            axios
                .get(`/api/experts/${expertId}?include=user,department`)
                .then(response => {
                    console.log(response.data); // Check the response data in the browser console
                    this.expert = response.data.expert;
                })
                .catch(error => {
                    console.log(error);
                    this.error = true;
                });
        },
    },
};
</script>

<style>
/* Styles */
.expert-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: flex-start;
}

.expert-card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin: 0 -10px;
}

.expert-card {
    width: calc(33.33% - 20px);
    margin: 10px;
}
</style>
