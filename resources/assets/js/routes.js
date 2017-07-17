import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        redirect: '/budget'
        // component: require('./views/Dashboard.vue')

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
        path: '/budget',
        component: require('./views/Categories.vue')

    }
];


export default new VueRouter({
    routes,
    path: '/budget',
    linkActiveClass: 'is-active'

});
