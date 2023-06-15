<template>

<div>
           <router-link :to="'/services'"  class="list-group-item  py-2 mx-4 ripple ">
                        <span>services</span>
                    </router-link>


                    <router-link :to="'/addpost'"  class="list-group-item mx-4  py-2 ripple ">
                        <span> posts</span>
                    </router-link>

                    <router-link :to="'/allposts'" class="list-group-item mx-4  py-2 ripple ">
                        <span>experts</span>
                    </router-link>

                <router-link :to="'/departments'" class="list-group-item mx-4  py-2 ripple ">
                    <span>departments</span>
                </router-link>


    </div>
</template>
<script setup>
</script>
