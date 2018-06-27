/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.use(require('vue-resource'));

Vue.use(require('vue-chat-scroll'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('friend', require('./components/Friend.vue'));

Vue.component('notification', require('./components/Notification.vue'));

Vue.component('unreadnots', require('./components/UnreadNots.vue'));

Vue.component('post', require('./components/Post.vue'));

Vue.component('feed', require('./components/Feed.vue'));

Vue.component('like', require('./components/Like.vue'));

Vue.component('init', require('./components/Init.vue'));

Vue.component('search', require('./components/Search.vue'));

Vue.component('chat', require('./components/Chat.vue'))

import { store } from './store'

const app = new Vue({
    el: '#app',
    store
});