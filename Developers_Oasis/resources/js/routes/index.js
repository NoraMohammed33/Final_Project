import {createRouter,createWebHistory} from 'vue-router';
import MainComponent from '../components/MainComponent.vue';
import PostComponent from '../components/UserComponents/PostComponent.vue';
import AddPostComponent from '../components/UserComponents/AddPostComponent.vue'


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
        path:'/addpost',
        component:AddPostComponent
    },

]
const router=createRouter({
    routes:routes,
    history:createWebHistory()
})
export default router;
