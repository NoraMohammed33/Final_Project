<template>
    <div className="expert-profile">
<!--        <h2>{{ expert.user.name }}</h2>-->
        <div class="expert-info">
            <div class="expert-image">
<!--                <img :src="expert.user.image" alt="User Image">-->
            </div>
            <div class="expert-details">
<!--                <p><strong>Email:</strong> {{ expert.user.email }}</p>-->
                <p><strong>Bio:</strong> {{ expert.bio }}</p>

            </div>
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
