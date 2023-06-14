import {createRouter,createWebHistory} from 'vue-router';
import MainComponent from '../components/MainComponent.vue';
import PostComponent from '../components/UserComponents/PostComponent.vue';
import AddPostComponent from '../components/UserComponents/AddPostComponent.vue'
import ExpertList from "../components/ExpertComponents/ExpertList.vue";
import ExpertForm from "../components/ExpertComponents/ExpertForm.vue";
import ExpertDetail from "../components/ExpertComponents/ExpertDetail.vue";


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
    {
        path:'/experts',
        component:ExpertList
    },    {
        path:'/addexpert',
        component:ExpertForm
    },    {
        path:'/expert/:id',
        component:ExpertDetail
    },

]
const router=createRouter({
    routes:routes,
    history:createWebHistory()
})
export default router;
