require('./bootstrap');

import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';

Vue.config.productionTip = false;

// Initialize and use Vuetify
const vuetifyOptions = {};
Vue.use(Vuetify);

Vue.component('food-index-component', require('./pages/foods/Index.vue').default);

const app = new Vue({
    el: '#app',
    icons: {
        iconfont: 'mdi',
    },
    vuetify: new Vuetify(vuetifyOptions),
});

