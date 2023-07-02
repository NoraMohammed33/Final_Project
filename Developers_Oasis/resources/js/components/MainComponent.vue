<template>
    <div>
        <section class="home" id="home">
            <div class="content">
                <h3>Welcome to <span>Developers</span> World</h3>
                <p>Solve your coding challenges with us </p>
                <router-link to="/addpost" class="btn">ask now</router-link>
            </div>
        </section>
        <section class="experts" id="experts">
            <h1 class="heading">Our <span>Experts</span></h1>
            <div class="box-container">
                <div class="box">
                    <img src="" alt="">
                </div>
            </div>
        </section>
    </div>

</template>

<script>
export default {

}
</script>

<style>
    .home{
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: url(./Z3BcMC.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center ;
        padding-top: 15rem;
        padding-bottom: 5rem;
    }
    .home .content{
        text-align: center;
        width: 60rem;
    }
    .home .content h3{
        color: var(--black);
        font-size: 3rem;
    }
    .home .content span {
        color: var(--orange);
    }
    .home .content p{
        color: var(--light-color);
        font-size: 1.8rem;
        padding: 1rem 0;
        line-height: 1.8;
    }

</style>






