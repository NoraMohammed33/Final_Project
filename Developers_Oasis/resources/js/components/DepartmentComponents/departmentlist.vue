<template>
    <div>
        <h2>Expert List</h2>
        <div v-for="expert in experts" :key="expert.id">
            <v-card class="mx-auto" max-width="400">
                <v-img class="align-end text-white" height="200" :src="expert.imageUrl" cover>
                    <v-card-title>{{ expert.name }}</v-card-title>
                </v-img>

                <v-card-subtitle class="pt-4">
                    Expert ID: {{ expert.id }}
                </v-card-subtitle>

                <v-card-text>
                    <div>{{ expert.bio }}</div>

                    <div>Department: {{ expert.department }}</div>
                </v-card-text>

                <v-card-actions>
                    <v-btn color="orange" @click="shareExpert(expert)">
                        Share
                    </v-btn>

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
            experts: [],
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
            this.$router.push(`/expert/${expert.id}`);
        },
    },
};
</script>

