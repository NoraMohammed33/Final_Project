import { createRouter, createWebHistory } from 'vue-router';
import MainComponent from '../components/MainComponent.vue';
import ServicesComponent from "../components/services/ServicesComponent.vue";
import PostComponent from '../components/UserComponents/PostComponent.vue';
import AddPostComponent from '../components/UserComponents/AddPostComponent.vue'
<<<<<<< HEAD
import dashBoardComponent from "../components/AdminComponents/DashBoardComponent.vue";
=======
import ExpertList from "../components/ExpertComponents/ExpertList.vue";
import ExpertForm from "../components/ExpertComponents/ExpertForm.vue";
import ExpertDetail from "../components/ExpertComponents/ExpertDetail.vue";
>>>>>>> 804762ec8d9fbda7bac369dfd94ae785369e8aab


const routes = [

    {
        path: '/',
        component: MainComponent
    },
    {
<<<<<<< HEAD
        path:'/post',
        component:PostComponent
=======
        path: '/posts',
        component: PostComponent
>>>>>>> 804762ec8d9fbda7bac369dfd94ae785369e8aab
    },
    {
        path: '/services',
        component: ServicesComponent
    },

    {
<<<<<<< HEAD
        path:'/addpost',
        component:AddPostComponent
    }
=======
        path: '/addpost',
        component: AddPostComponent
    },
    {
        path: '/departments',
        component: departmentlist
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
>>>>>>> 804762ec8d9fbda7bac369dfd94ae785369e8aab

]
const router = createRouter({
    routes: routes,
    history: createWebHistory()
})
export default router;
