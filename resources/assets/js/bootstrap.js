import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import Form from './utilities/Form';
import moment from 'moment';
import { gsap, TweenMax } from 'gsap';
import ga from './ga';

window.Vue = Vue;
Vue.use(
    VueRouter
);
window.axios = axios;
window.moment = moment;
window.Form = Form;
window.gsap = gsap;
window.ga = ga;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

