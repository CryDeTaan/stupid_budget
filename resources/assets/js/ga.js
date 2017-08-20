import Vue from 'vue';
import router from './routes';
import VueAnalytics from 'vue-analytics';

Vue.use(VueAnalytics, {
    id: 'UA-103335841-1',
    router
});