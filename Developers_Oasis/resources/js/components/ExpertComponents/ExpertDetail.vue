<template>
    <v-card class="mx-auto" max-width="344">
        <v-img src="'public/images/'+expert.user.image" height="200px" cover></v-img>

        <v-card-title>
            {{ expert.name }}
        </v-card-title>

        <v-card-subtitle>
            {{ expert.name }}
        </v-card-subtitle>

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
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            show: false,
            expert: {},
        };
    },
    mounted() {
        this.fetchExpert();
    },
    methods: {
        fetchExpert() {
            const expertId = this.$route.params.id;
            axios
                .get(`/api/expert/${expertId}`)
                .then((response) => {
                    this.expert = response.data.expert;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style>
/* Styles */
</style>
