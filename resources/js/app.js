
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.use(require('vue-moment'));
import VueFormWizard from 'vue-form-wizard'
import VueSweetalert2 from 'vue-sweetalert2'
import VueSelect from 'vue-cool-select'
import VueClip from 'vue-clip'
import Loading from 'vue-loading-overlay'
import Toasted from 'vue-toasted';
import VueContentPlaceholders from 'vue-content-placeholders'
import Multiselect from 'vue-multiselect'
import 'vue-loading-overlay/dist/vue-loading.css'
import 'vue-multiselect/dist/vue-multiselect.min.css'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'

Vue.component('multiselect', Multiselect)
Vue.use(VueFormWizard)
Vue.use(VueSweetalert2)
Vue.use(VueSelect)
Vue.use(VueClip)
Vue.use(Loading)
Vue.use(Toasted)
Vue.toasted.register('error', message => message, {
    position : 'bottom-center',
    duration : 3000
})
Vue.use(VueContentPlaceholders)



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


//aspirantes
Vue.component('aspirantes-registro', require('./components/aspirantes/Aspirantes.vue').default);
Vue.component('aspirantes-index', require('./components/aspirantes/Index.vue').default);



// Layout
Vue.component('sidebar', require('./components/layout/Sidebar.vue').default);

// Dashboard
Vue.component('users-count', require('./components/dashboard/UsersCount.vue').default);
Vue.component('roles-count', require('./components/dashboard/RolesCount.vue').default);

// Profile
Vue.component('profile', require('./components/profile/Profile.vue').default);
Vue.component('profile-password', require('./components/profile/Password.vue').default);

// Users
Vue.component('users-index', require('./components/users/Index.vue').default);
Vue.component('users-create', require('./components/users/Create.vue').default);
Vue.component('users-edit', require('./components/users/Edit.vue').default);

// Roles
Vue.component('roles-index', require('./components/roles/Index.vue').default);
Vue.component('roles-create', require('./components/roles/Create.vue').default);
Vue.component('roles-edit', require('./components/roles/Edit.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
