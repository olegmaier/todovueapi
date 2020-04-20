
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import '@mdi/font/css/materialdesignicons.css'
import Vue from 'vue'

import vuetify from './plugins/vuetify' // path to vuetify export
import VueRouter from 'vue-router'

Vue.component('appvue', require('./App.vue'));
Vue.use(VueRouter)



const routes=[
    {path: '/', component: require('./App.vue'), name:'Home'},
    {path: '/tasks', component: require('./components/tasks.vue'), name:'tasks'},
    {path: '/users', component: require('./components/users.vue'), name:'users'},
]
const router=new VueRouter({
    mode: 'history', 
    routes: routes
})

new Vue({
  vuetify,
  router
}).$mount('#app')