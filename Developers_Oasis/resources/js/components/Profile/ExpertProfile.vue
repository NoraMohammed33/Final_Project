<template>
    <div className="expert-profile">
        <h2>Expert Profile</h2>
        <div className="expert-info">
            <p><strong>Bio:</strong> {{ expert.bio }}</p>
            <!-- Display other expert-specific information -->
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
                    this.expert = response.data;
                })
                .catch((error) => {
                    console.log(error);
                    this.error = true;
                });
        },
    },
};
</script>

<style scoped>
.expert-profile {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: 100vh;
}

.expert-info {
    margin-top: 20px;

}

.expert-info p {
    margin-bottom: 10px;
}

.expert-info strong {
    font-weight: bold;
}
</style>
