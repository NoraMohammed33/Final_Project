<template>
    <div class="user-profile">
        <h2>User Profile</h2>
        <div class="user-info">
            <p><strong>Name:</strong> {{ user.name }}</p>
            <p><strong>Email:</strong> {{ user.email }}</p>
            <!-- Display other user-specific information -->
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
