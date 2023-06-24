<template>
    <div class="user-profile">
        <div class="card">
            <h2>{{ user.name }}</h2>
            <div class="user-info">
                <div class="user-image">
                    <img :src="user.image" alt="User Image">
                </div>
                <div class="user-details">
                    <p><strong>Email:</strong> {{ user.email }}</p>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import axios from "axios";

export default {
    data() {
        return {
            user: {},
        };
    },
    mounted() {
        this.fetchUser();
    },
    methods: {
        fetchUser() {
            axios
                .get(`/api/user/profile`)
                .then((response) => {
                    this.user = response.data;
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
.user-profile {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: 100vh;
}

.user-info {
    margin-top: 20px;
}

.user-info p {
    margin-bottom: 10px;
}

.user-info strong {
    font-weight: bold;

}
</style>
