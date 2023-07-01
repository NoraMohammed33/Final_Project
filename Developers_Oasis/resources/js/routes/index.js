import { createRouter, createWebHistory } from 'vue-router';
import MainComponent from '../components/MainComponent.vue';
import ServicesComponent from "../components/services/ServicesComponent.vue";

import dashBoardComponent from "../components/AdminComponents/DashBoardComponent.vue";

import AddPostComponent from '../components/PostComponents/AddPostComponent.vue';
import AllpostsComponent from '../components/PostComponents/AllpostsComponent.vue';
import PostComponent from "../components/PostComponents/PostComponent.vue";

import ExpertList from "../components/ExpertComponents/ExpertList.vue";
import ExpertForm from "../components/AdminComponents/ExpertForm.vue";
import ExpertDetail from "../components/ExpertComponents/ExpertDetail.vue";
import departmentlist from "../components/DepartmentComponents/departmentlist.vue";
import exampleComponent from "../components/ExampleComponent.vue";
import expertList from "../components/ExpertComponents/ExpertList.vue";

import DepartmentExpertsComponent from "../components/DepartmentComponents/DepartmentExpertsComponent.vue";
import ServiceDetailsComponent from "../components/services/ServiceDetailsComponent.vue";
import UserProfile from "../components/Profile/UserProfile.vue";
import ExpertProfile from "../components/Profile/ExpertProfile.vue";
import SuccessPaymentComponent from "../components/Payment/SuccessPaymentComponent.vue";
import ErrorPaymentComponent from "../components/Payment/ErrorPaymentComponent.vue";
const routes = [

    {
        path: '/',
        component: MainComponent
    },
    {
        path: '/home',
        component: MainComponent
    },
    {
        path: '/user/profile/:id',
        name:'user-profile',
        component: UserProfile
    },
    {
        path: '/expert/profile/:id',
        name:'expert-profile',
        component: ExpertProfile
    },

    {

        path:'/posts',
        component:AllpostsComponent
    },
    {
        path: '/services',
        component: ServicesComponent
    },
    {
        path: '/services/:id',
        component: ServiceDetailsComponent
    },


    {

        path:'/addpost',
        component:AddPostComponent
    },
    {
        path: '/allposts',
        component: AllpostsComponent
    },
    {
        path:'/experts',
        component:ExpertList
    },
    {
        path:'/expert/:id',
        component:ExpertDetail
    },
    {
        path:'/posts/:id',
        component:PostComponent
    },
    {
        path:'/departments/:id',
        component:DepartmentExpertsComponent
    },
    {
        path:'/admin/dashboard',
        component: dashBoardComponent,
        children:[
            {
                path:'departments',
                component:departmentlist,
            },
            {
                path: 'allposts',
                component: AllpostsComponent
            },
            {
                path: 'services',
                component: ServicesComponent
            },
            {
                path: 'experts',
                component: expertList
            },
            {
                path:'addexpert',
                component:ExpertForm
            },
        ]

    },
    {
        path:'/departments',
        component:departmentlist
    },
    {
        path: '/success',
        component: SuccessPaymentComponent
    },
    {
        path: '/error',
        component: ErrorPaymentComponent
    }


]
const router = createRouter({
    routes: routes,
    history: createWebHistory()
})
export default router;
