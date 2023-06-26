<template>
    <div class="expert-profile">
        <template v-if="expert">
            <h2>{{ expert.user.name }}</h2>
            <div class="expert-info">
                <div class="expert-image">
                    <img :src="expert.user.image" alt="User Image">
                </div>
                <div class="expert-details">
                    <p><strong>Email:</strong> {{ expert.user.email }}</p>
                    <p><strong>Bio:</strong> {{ expert.bio }}</p>
                    <h3>Department:</h3>
                    <p>{{ expert.department.name }}</p>
                    <h3>Services</h3>
                    <ul>
                        <li v-for="service in expert.services" :key="service.id">
                            {{ service.title }} - ${{ service.price }}
                        </li>
                    </ul>
                </div>
            </div>
        </template>
        <template v-else>
            <p v-if="error">Failed to fetch expert data.</p>
            <p v-else>Loading expert profile...</p>
        </template>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            expert: null,
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
                .get(`/api/experts/${expertId}`)
                .then((response) => {
                    this.expert = response.data.expert;
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
