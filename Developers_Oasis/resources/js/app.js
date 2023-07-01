/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import 'vuetify/styles';
import * as Vue from 'vue';
import { createApp } from 'vue';
import axios from 'axios'
import VueAxios from 'vue-axios'
import router from "./routes/index.js";


// Vuetify
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    components,
    directives,
})

import PrimeVue from 'primevue/config';
import Toast from 'vue-toastification';
import "vue-toastification/dist/index.css";


/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance, so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

import PostComponent from './components/PostComponents/PostComponent.vue';
app.component('post-component',PostComponent);

import AddPostComponent from "./components/PostComponents/AddPostComponent.vue";
app.component('addpost-component',AddPostComponent);

import AllpostsComponent from "./components/PostComponents/AllpostsComponent.vue";
app.component('allposts-component',AllpostsComponent);

import MenuBarComponent from "./components/MenuBarComponent.vue";
app.component('menubar-component',MenuBarComponent);

import LoginComponent from "./components/AdminComponents/LoginComponent.vue";
app.component('login-component',LoginComponent);

import AdminHeaderComponent from "./components/AdminComponents/AdminHeaderComponent.vue";
app.component('adminheader-component',AdminHeaderComponent);


import DashBoardComponent from "./components/AdminComponents/DashBoardComponent.vue";
app.component('dashboard-component',DashBoardComponent);

import MainComponent from './components/MainComponent.vue'
app.component('main-component', MainComponent)


import ExpertList from "./components/ExpertComponents/ExpertList.vue";
app.component('expert-component',ExpertList);

import ExpertForm from "./components/AdminComponents/ExpertForm.vue";
app.component('addexpert-component',ExpertForm);

import ExpertDetail from "./components/ExpertComponents/ExpertDetail.vue";
app.component('expert-detail-component',ExpertDetail);

import ServicesComponent from "./components/services/ServicesComponent.vue";
app.component('services-component',ServicesComponent);

import departmentlist from "./components/DepartmentComponents/departmentlist.vue";
app.component('department-component',departmentlist);

import ServiceDetailsComponent from "./components/services/ServiceDetailsComponent.vue";
app.component('services-details', ServiceDetailsComponent)

import StarRating from 'vue-star-rating';
app.component('StarRating', StarRating)

import Profile from "./components/Profile/Profile.vue";
app.component('Profile',Profile);

import ExpertProfile from "./components/Profile/ExpertProfile.vue";
app.component('expert-Profile',ExpertProfile);

import UserProfile from "./components/Profile/UserProfile.vue";
app.component('user-profile',UserProfile);

import SuccessPaymentComponent from "./components/Payment/SuccessPaymentComponent.vue";
app.component('success-payment', SuccessPaymentComponent);

import ErrorPaymentComponent from "./components/Payment/ErrorPaymentComponent.vue";
app.component('error-payment', ErrorPaymentComponent)

import AllExpertsTable from "./components/AdminComponents/AllExpertsTable.vue";
app.component('allexperts-table',AllExpertsTable);

import AllDepartmentsTable from "./components/AdminComponents/AllDepartmentsTable.vue";
app.component('alldepartments-table',AllDepartmentsTable);

import allPostsTable from "./components/AdminComponents/AllPostsTable.vue";
app.component('allposts-table',allPostsTable);

import AllServicesTable from "./components/AdminComponents/AllServicesTable.vue";
app.component('allservices-table',AllServicesTable);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to an HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */
app.use(router);
app.use(VueAxios, axios);
app.use(PrimeVue);
app.use(vuetify);
app.use(Toast);
app.mount('#app');
