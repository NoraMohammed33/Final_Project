import { createRouter, createWebHistory } from 'vue-router';
import MainComponent from '../components/MainComponent.vue';
import ServicesComponent from "../components/services/ServicesComponent.vue";

import dashBoardComponent from "../components/AdminComponents/DashBoardComponent.vue";


import AddPostComponent from '../components/PostComponents/AddPostComponent.vue';
import AllpostsComponent from '../components/PostComponents/AllpostsComponent.vue';

import ExpertList from "../components/ExpertComponents/ExpertList.vue";
import ExpertForm from "../components/ExpertComponents/ExpertForm.vue";
import ExpertDetail from "../components/ExpertComponents/ExpertDetail.vue";
import departmentlist from "../components/DepartmentComponents/departmentlist.vue";
import exampleComponent from "../components/ExampleComponent.vue";

const routes = [

    {
        path: '/',
        component: MainComponent
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

        path:'/addpost',
        component:AddPostComponent
    },
    {
        path: '/allposts',
        component: AllpostsComponent
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
    },
    {
        path:'/expert/:id',
        component:ExpertDetail
    },


]
const router = createRouter({
    routes: routes,
    history: createWebHistory()
})
export default router;
