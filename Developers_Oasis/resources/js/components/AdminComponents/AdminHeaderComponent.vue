<template>
<div >



    <router-link :to="'/admin/dashboard/services'"
                 class="list-group-item  py-2 mx-4 ripple  menu_item">
        <Button>services</Button>
    </router-link>


    <router-link :to="'/admin/dashboard/allposts'"  class="list-group-item mx-4  py-2 ripple menu_item ">
        <span> posts</span>
    </router-link>

    <router-link :to="'/admin/dashboard/experts'" class="list-group-item mx-4  py-2 ripple menu_item">
        <span>experts</span>
    </router-link>

    <router-link :to="'/admin/dashboard/departments'" class="list-group-item mx-4  py-2 ripple menu_item">
        <span>departments</span>
    </router-link>
</div>
</template>
<script setup>
</script>

<style scoped>
.menu_item{
    border:1px solid green;
    margin:10px;
    padding:10px;
    border-radius:10px
}
.menu_item:hover{
    background-color:green;
    color:white
}
</style>
