import { createRouter, createWebHistory } from 'vue-router';
import MainComponent from '../components/MainComponent.vue';
import ServicesComponent from "../components/services/ServicesComponent.vue";
import PostComponent from '../components/UserComponents/PostComponent.vue';
import AddPostComponent from '../components/UserComponents/AddPostComponent.vue'


const routes = [

    {
        path: '/',
        component: MainComponent
    },
    {
        path: '/posts',
        component: PostComponent
    },
    {
        path: '/services',
        component: ServicesComponent
    },

    {
        path: '/addpost',
        component: AddPostComponent
    },
    {
        path: '/departments',
        component: departmentlist
    },

]
const router = createRouter({
    routes: routes,
    history: createWebHistory()
})
export default router;
