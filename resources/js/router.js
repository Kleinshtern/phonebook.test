import { createRouter, createWebHistory } from 'vue-router';

import phonebookRoutes from "@/routes/phonebookRoutes.js";
import {useAuthStore} from "@/stores/authStore.js";
import authRoutes from "@/routes/authRoutes.js";

const routes = [
    ...authRoutes,
    ...phonebookRoutes
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const authStore = useAuthStore();

    if (to.meta.auth && !authStore.isAuthenticated) {
        await authStore.fetchUser();

        if (!authStore.isAuthenticated) {
            return next({ name: 'Login' });
        }
    }
    next();
});

export default router;
