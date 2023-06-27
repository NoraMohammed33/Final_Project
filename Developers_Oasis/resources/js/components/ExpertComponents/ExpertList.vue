<template>
    <div class="expert-list">

        <v-container>
            <router-link :to="'/admin/dashboard/addexpert'">
                <v-btn color="green">add new expert</v-btn>
            </router-link>
        </v-container>


        <h2>Expert List</h2>
        <v-row class="search-container justify-center">
            <v-col cols="12" sm="6" md="4" lg="3" xl="2" class="text-center">
                <v-text-field
                    v-model="searchInput"
                    outlined
                    dense
                    placeholder="Search experts"
                ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="4" lg="3" xl="2">
                <v-btn color="primary" @click="fetchExperts">Search</v-btn>
            </v-col>
        </v-row>

        <div class="expert-card-container">
            <v-card
                v-for="expert in filteredExperts"
                :key="expert.id"
                class="expert-card"
            >
                <v-img class="align-end text-white" height="200" :src="'public/images/' + expert.user.image" cover>
                </v-img>
                <v-card-title>{{ expert.user.name }}</v-card-title>
                <v-card-subtitle class="pt-4">
                    {{ expert.user.email }}
                </v-card-subtitle>
                <v-card-subtitle class="pt-4">
                    <div>Department: {{ expert.department.name }}</div>
                </v-card-subtitle>

                <v-card-text>
                    <div>Bio: {{ expert.bio }}</div>
                </v-card-text>

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
            experts: [],
            searchInput: "", // Search input property
        };
    },
    mounted() {
        this.fetchExperts();
    },
    computed: {
        // Computed property to filter experts based on search input
        filteredExperts() {
            if (!this.searchInput) {
                return this.experts;
            }
            const search = this.searchInput.toLowerCase();
            return this.experts.filter(
                (expert) =>
                    expert.user.name.toLowerCase().includes(search) ||
                    expert.user.email.toLowerCase().includes(search) ||
                    expert.department.name.toLowerCase().includes(search)
            );
        },
    },
    methods: {
        fetchExperts() {
            axios
                .get("/api/experts?include=department")
                .then((response) => {
                    this.experts = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        exploreExpert(expert) {
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

.search-container {
    margin-bottom: 20px;
}
</style>
