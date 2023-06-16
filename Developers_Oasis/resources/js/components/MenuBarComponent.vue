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
            <router-link to="/Experts" class="nav-link">
                Experts
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/Departments" class="nav-link">
                Departments
            </router-link>
        </li>

    </ul>
</template>
<script setup>
</script>

<style scoped>
    router-link{
        font-size: larger;
        font-weight: bold;
    }
</style>
