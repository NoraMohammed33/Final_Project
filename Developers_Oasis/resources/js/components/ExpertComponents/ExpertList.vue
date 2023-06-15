<template>
    <div class="expert-list">
        <h2>Expert List</h2>
        <div class="expert-card-container">
            <v-card v-for="expert in experts" :key="expert.id" class="expert-card">
                <v-img class="align-end text-white" height="200" :src="'public/images/'+expert.user.image" cover>
                    <v-card-title>{{ expert.name }}</v-card-title>
                </v-img>
                <v-card-subtitle class="pt-4">
                    Expert ID: {{ expert.id }}
                </v-card-subtitle>

                <v-card-text>
                    <div>{{ expert.bio }}</div>
                    <div>Department: {{ expert.user.name }}</div>
                </v-card-text>

                <router-link :to="`/expert/${expert.id}`">
                    View Details
                </router-link>

                <v-card-actions>
                    <v-btn color="orange" @click="exploreExpert(expert)">
                        Explore
                    </v-btn>
                </v-card-actions>
            </v-card>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            experts: [], // Add back the experts data property
        };
    },
    mounted() {
        this.fetchExperts();
    },
    methods: {
        fetchExperts() {
            axios
                .get("/api/experts")
                .then((response) => {
                    this.experts = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        exploreExpert(expert) {
            // Assuming you want to navigate to the expert's detail page
            // Use the router to navigate to the expert detail route
            this.$router.push({ path: `/expert/${expert.id}` });
        },
    },
};
</script>

<style>
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
