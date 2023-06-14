import {createRouter,createWebHistory} from 'vue-router';
import MainComponent from '../components/MainComponent.vue';
import ServicesComponent from "../components/services/ServicesComponent.vue";
import PostComponent from '../components/UserComponents/PostComponent.vue';
import AddPostComponent from '../components/UserComponents/AddPostComponent.vue'
import dashBoardComponent from "../components/AdminComponents/DashBoardComponent.vue";


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

    {
        path:'/addpost',
        component:AddPostComponent
    }

]
const router=createRouter({
    routes:routes,
    history:createWebHistory()
})
export default router;
