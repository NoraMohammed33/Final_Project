<template>
    <div>
        <user-profile :user="user" v-if="user && !expert"></user-profile>
        <expert-profile :expert="expert" v-if="expert"></expert-profile>
    </div>
</template>

<script>
import UserProfile from './UserProfile.vue';
import ExpertProfile from './ExpertProfile.vue';
import axios from "axios";

export default {
    components: {
        UserProfile,
        ExpertProfile,
    },
    data() {
        return {
            user: null,
            expert: null,
        };
    },
    mounted() {
        // Fetch user and expert data
        // ...
        this.fetchUser()
        this.fetchExpert()
    },
    methods:{
        fetchExpert() {
            const expertId = this.$route.params.id;
            axios
                .get(`/api/experts/${expertId}`)
                .then((response) => {
                    this.expert = response.data;
                })
                .catch((error) => {
                    console.log(error);
                    this.error = true;
                });
        },
    },
    fetchUser() {
        const userID = this.$route.params.id;
        axios
            .get(`/api/users/${userID}`)
            .then((response) => {
                this.user = response.data;
            })
            .catch((error) => {
                console.log(error);

                this.error = true;
            });
    },

};
</script>
