<template>
    <ul class="navbar-nav">
        <li class="nav-item">
            <router-link to="/home" class="nav-link">
                Home
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/services" class="nav-link">
                Services
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/posts" class="nav-link">
                Posts
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/experts" class="nav-link">
                Experts
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/departments" class="nav-link">
                Departments
            </router-link>
        </li>
        <!-- <li class="nav-item">
            <router-link to="/addpost" class="nav-link">
                Ask me
            </router-link>
        </li> -->
        <li class="nav-item" v-if="user && !expert">
            <router-link :to="'/user/profile/' + user.id" class="nav-link">
                Profile
            </router-link>
        </li>
        <li class="nav-item" v-if="expert">
            <router-link :to="'/expert/profile/' + expert.id" class="nav-link">
                Profile
            </router-link>
        </li>
    </ul>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const user = ref(null);
const expert = ref(null);

axios
    .get('/api/user/profile')
    .then(response => {
        user.value = response.data;
    })
    .catch(error => {
        console.error(error);
    });

axios
    .get('/api/expert/profile')
    .then(response => {
        expert.value = response.data;
    })
    .catch(error => {
        console.error(error);
    });
</script>

<style scoped>
/* @media (max-width: 576px) {
    .navbar-nav {
        flex-direction: column;
        align-items: flex-start;
    }

    .nav-item {
        margin-bottom: 10px;
    }
} */
ul li .nav-link{
    font-size: 1.1rem;
    margin: 0 .4rem;
    color: var(--black);
    
}
ul li .nav-link:hover{
    color: var(--orange);
}
</style>







