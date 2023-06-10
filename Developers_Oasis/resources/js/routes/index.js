import {createRouter,createWebHistory} from 'vue-router';
import MainComponent from '../components/MainComponent.vue';
import PostComponent from '../components/PostComponent.vue';


const routes=[

    {
        path:'/',
        component:MainComponent
    },
    {
        path:'/post',
        component:PostComponent
    },
  
]
const router=createRouter({
    routes:routes,
    history:createWebHistory()
})
export default router;
