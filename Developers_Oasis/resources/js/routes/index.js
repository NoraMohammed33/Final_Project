import {createRouter,createWebHistory} from 'vue-router';
import MainComponent from '../components/MainComponent.vue';
import PostComponent from '../components/PostComponent.vue';
import ServicesComponent from "../components/services/ServicesComponent.vue";

const routes=[

    {
        path:'/',
        component:MainComponent
    },
    {
        path:'/post',
        component:PostComponent
    },
    {
        path:'/services',
        component:ServicesComponent
    },

]
const router=createRouter({
    routes:routes,
    history:createWebHistory()
})
export default router;
