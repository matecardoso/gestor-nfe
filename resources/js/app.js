/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

require('./components');

/**
 * Vue-laroute
 */

import VueLaroute from 'vue-laroute';
import routes from '../../public/js/laroute';

Vue.use(VueLaroute, {
    routes,
    accessor: '$routes', // Optional: the global variable for accessing the router
});

/**
 * Vue-router routes
 */

import VueRouter from 'vue-router'

Vue.use(VueRouter)

import rotas from './routes';

const router = new VueRouter({
    mode: 'history',
    routes: rotas,
});

/**
 * Vue mask input
 * v-money
 */
import VueTheMask from 'vue-the-mask'
import money from 'v-money'


Vue.use(VueTheMask)
Vue.use(money, {precision: 4})

/**
 * Vue-loading-overlay
 */
// Import component
import Loading from 'vue-loading-overlay';

// Init plugin
Vue.use(Loading);

/**
 * Vuelidate
 */
import Vuelidate from 'vuelidate';

Vue.use(Vuelidate);

/**
 * Directives
 */
require('./directives');

// Mixins
require('./mixins');

/**
 * Vuex
 */
import store from './store';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    store
});
