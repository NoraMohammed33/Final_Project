<template>
    <div>
        <h2>Expert Detail</h2>
        <div>
            <p><strong>Department ID:</strong> {{ expert.dept_id }}</p>
            <p><strong>Bio:</strong> {{ expert.bio }}</p>
            <p><strong>User ID:</strong> {{ expert.user_id }}</p>
            <p><strong>Created At:</strong> {{ expert.created_at }}</p>
            <p><strong>Updated At:</strong> {{ expert.updated_at }}</p>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
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
                .get(`/api/experts/${expertId}`)
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
/* Component styles go here */
</style>
