<template>
    <div class="basic">
        <section class="home" id="home">
            <div class="content">
                <h3>Welcome to <span>Developers</span> World</h3>
                <p>Solve your coding challenges with us </p>
                <router-link to="/addpost" class="btn">ask now</router-link>
            </div>
        </section>

        <!-- <section class="experts" id="experts">
            <h1 class="heading">Our <span>Experts</span></h1>
            <div class="box-container">
                <div class="box" v-for="expert in filteredExperts" :key="expert.id">
                    <img src="https://bootstrapious.com/i/snippets/sn-team/teacher-4.jpg" alt="" width="150"
                        class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                    <h3>{{ expert.user.name }}</h3>
                    <p>Bio : {{ expert.bio }}</p>
                    <p >Department : {{ expert.department.name }}</p>
                </div>
            </div>
        </section> -->
        <section >
            <h1 class="heading">Our <span>Experts</span></h1>
            <div class="all_experts">
                <div class="expert" v-for="expert in filteredExperts" :key="expert.id">
                    <img src="https://bootstrapious.com/i/snippets/sn-team/teacher-4.jpg" alt="" width="150"
                            class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                    <div class="expert-info">
                        <h4 class="expert-name">{{ expert.user.name }}</h4>
                        <p> {{ expert.bio }}</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="departments" id="departments">
            <h1 class="heading">Our <span>Departments</span></h1>
            <div class="d-flex flex-wrap justify-content-center mx-auto px-5">
                <template v-for="department in departments.data" :key="department.id">
                    <v-card class="col-8 col-sm-5 col-md-4 col-lg-3 m-3 rounded-4">
                        <v-card-text>
                            <h2 class="font-weight-bold mb-2">{{ department.name }}</h2>
                            <div class="text-grey">{{ department.description }}</div>
                        </v-card-text>
                    </v-card>
                </template>
            </div>
        </section>
    </div>
</template>

<script>
import Card from 'primevue/card';
export default {
    components: {
        Card
    },
    data() {
        return {
            experts: [],
            searchInput: "",// Search input property
            departments: [],
        };
    },
    mounted() {
        this.fetchExperts();
        axios
        .get(`http://localhost:8000/api/departments`)
        .then(response => {
            this.departments = response.data;
            // console.log(this.departments);
        })
        .catch(error => {
            console.log(error);
        });

    },
    computed: {
        // Computed property to filter experts based on search input
        filteredExperts() {
            if (!this.searchInput) {
                return this.experts;
            }
            const search = this.searchInput.toLowerCase();
            return this.experts.filter(
                expert =>
                    expert.user.name.toLowerCase().includes(search) ||
                    expert.user.email.toLowerCase().includes(search) ||
                    expert.department.name.toLowerCase().includes(search)
            );
        }
        },
    methods: {
        fetchExperts() {
            axios
                .get("/api/experts?include=department")
                .then(response => {
                    this.experts = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
    }
};
</script>

<style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Merriweather+Sans&display=swap');
    .basic{
        background: #73818e;
    }
    .btn {
        margin-top: 1rem;
        display: inline-block;
        padding: .8rem 3rem;
        font-size: 1.7rem;
        border-radius: .5rem;
        border: .2rem solid var(--black);
        color: var(--black);
        cursor: pointer;
        background: none;
    }
    .btn:hover {
    background: var(--orange);
    color: #fff;
    }
    .heading {
        text-align: center;
        padding: 2rem 0;
        padding-bottom: 3rem;
        font-size: 2.5rem;
        color: var(--black);
    }
    .heading span {
        background: var(--orange);
        color: #fff;
        display: inline-block;
        padding: .5rem 3rem;
        clip-path: polygon(100% 0, 93% 50%, 100% 99%, 0% 100%, 7% 50%, 0% 0%);
    }
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
        font-size: 2rem;
    }
    .home .content span {
        color: var(--orange);
    }
    .home .content p{
        color: var(--light-color);
        font-size: 1.1rem;
        padding: 1rem 0;
        line-height: 1.8;
    }
    .experts .box-container{
        display: grid;
        grid-template-columns: repeat(auto-fit,minmax(15rem,1fr));
        gap:1.5rem;
    }
    .experts .box-container .box{
        padding: 3rem 2rem;
        background: #fff;
        outline: var(--outline);
        outline-offset: -1rem;
        text-align: center;
        box-shadow: var(--box-shadow);
    }
    /* .experts .box-container .box:hover{
        outline: var(--outline-hover);
        outline-offset: 0rem;
    } */
    /* .experts .box-container .box img{
        margin: 1rem 0;
        height: 9rem;
    }
    .experts .box-container .box h3{
        font-size: 1.5rem;
        line-height: 1.8;
        counter-reset: var(--black);
    }
    .experts .box-container .box p{
        font-size: 1rem;
        line-height: 1.8;
        counter-reset: var(--light-color);
        padding: 1rem 0;
    } */
    .all_experts{
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
    }
    .expert{
        overflow: hidden;
        background: #ffffff;
        color: #21201e;
        text-align: center;
        width: 240px;
        height: 340px;
        padding: 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 1.2rem;
        margin: 2rem;
    }
    .expert:hover img{
        scale: 1.1;
    }
    .expert:hover{
        box-shadow: 5px 15px 25px #eeeeee;
    }
    .expert img{
        margin: 1rem;
        transition: all 0.2s;
    }
    .departments div template:hover{
        box-shadow: 5px 15px 25px #eeeeee;
    }

</style>






