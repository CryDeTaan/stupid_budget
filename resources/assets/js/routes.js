import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./views/Dashboard.vue')

    },
    {
        path: '/accounts',
        component: require('./views/Accounts.vue')

    },
    {
        path: '/income',
        component: require('./views/Income.vue')

    },
    {
        path: '/expenses',
        component: require('./views/Expenses.vue')

    },
    {
        path: '/categories',
        component: require('./views/Categories.vue')

    }
];


export default new VueRouter({
    routes,
    linkActiveClass: 'is-active'
});
