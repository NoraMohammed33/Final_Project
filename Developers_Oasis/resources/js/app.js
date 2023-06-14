/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import router from "./routes/index.js";

import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    components,
    directives
})

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

import PostComponent from './components/UserComponents/PostComponent.vue';
app.component('post-component',PostComponent);

import ServicesComponent from "./components/services/ServicesComponent.vue";
app.component('services-component', ServicesComponent)
import AddPostComponent from "./components/UserComponents/AddPostComponent.vue";
app.component('addpost-component',AddPostComponent);

import MenuBarComponent from "./components/MenuBarComponent.vue";
app.component('menubar-component',MenuBarComponent);

import LoginComponent from "./components/AdminComponents/LoginComponent.vue";
app.component('login-component',LoginComponent);

import DashBoardComponent from "./components/AdminComponents/DashBoardComponent.vue";
app.component('dashboard-component',DashBoardComponent);

import AdminHeaderComponent from "./components/AdminComponents/AdminHeaderComponent.vue";
app.component('adminheader-component',AdminHeaderComponent)

import MainComponent from './components/MainComponent.vue'
app.component('main-component', MainComponent)

import departmentlist from './components/DepartmentComponents/departmentlist.vue'
app.component('department-component', departmentlist)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.componeimport { vue } from '@vitejs/plugin-vue';
// nt(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */
app.use(router);
app.use(vuetify).mount('#app');
