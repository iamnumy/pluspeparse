import { createRouter, createWebHistory } from 'vue-router';

import AccountStatement from "@/Components/views/AccountStatement.vue";
import LoginPage from "@/Components/views/LoginPage.vue";


const routes = [

    {
        path: '/',
        component: AccountStatement,
        meta: { tabName: 'AccountStatement' }

    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
