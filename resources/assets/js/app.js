
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import '@mdi/font/css/materialdesignicons.css'
import Vue from 'vue'
import vuetify from './plugins/vuetify' // path to vuetify export

Vue.component('appvue', require('./App.vue'));


new Vue({
  vuetify,
}).$mount('#app')