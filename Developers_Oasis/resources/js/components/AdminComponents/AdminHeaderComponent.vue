<template>
<div>



    <router-link :to="'/admin/dashboard/services'"  class="list-group-item  py-2 mx-4 ripple ">
        <span>services</span>
    </router-link>


    <router-link :to="'/admin/dashboard/allposts'"  class="list-group-item mx-4  py-2 ripple ">
        <span> posts</span>
    </router-link>

    <router-link :to="'/admin/dashboard/experts'" class="list-group-item mx-4  py-2 ripple ">
        <span>experts</span>
    </router-link>

    <router-link :to="'/admin/dashboard/departments'" class="list-group-item mx-4  py-2 ripple ">
        <span>departments</span>
    </router-link>
</div>
</template>
<script setup>
</script>
