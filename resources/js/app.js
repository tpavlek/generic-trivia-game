/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

let EchoInstance = new Echo({
    broadcaster: 'pusher',
    key: "generic-trivia-game-key",
    wsHost: window.location.hostname,
    wsPort: 6001,
    disableStats: true,
    namespace: '',
});

import Vue from 'vue';
import Vuex from 'vuex';
import VueEcho from 'vue-echo';

Vue.use(Vuex);
Vue.use(VueEcho, EchoInstance);

const store = new Vuex.Store({
    state: {
        sessionId: null,
        players: [],
        categories: [],
    },
    mutations: {
        joinSession(state, sessionId) {
            state.sessionId = sessionId;
        },
        addPlayer(state, player) {
            state.players.push(player);
        },
        removePlayer(state, player) {
            state.players = state.players.filter(existing => existing.id != player.id);
        },
        loadCategories(state, categories) {
            state.categories = categories;
        },
    }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    store,
    VueEcho,
    el: '#app',
});
