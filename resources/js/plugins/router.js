import VueRouter from 'vue-router';
import AdminLayout from "../layouts/AdminLayout";
import DashboardPage from "../pages/admin/DashboardPage.vue";
import PagesPage from "../pages/admin/PagesPage.vue";
import FileManagerPage from "../pages/admin/FileManagerPage";
import NotFoundPage from "../pages/admin/NotFoundPage";
import UsersPage from "../pages/admin/UsersPage";
import SettingsPage from "../pages/admin/SettingsPage";

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/admin',
            component: AdminLayout,
            meta: { requiresAuth: true, mustHaveRole: 'admin' },
            children: [
                {
                    path: '/',
                    name: 'admin.dashboard',
                    component: DashboardPage,
                },
                {
                    path: 'pages',
                    name: 'admin.pages',
                    component: PagesPage,
                },
                {
                    path: 'fm',
                    name: 'admin.fm',
                    component: FileManagerPage,
                },
                {
                    path: 'users',
                    name: 'admin.users',
                    component: UsersPage,
                },
                {
                    path: 'settings',
                    name: 'admin.settings',
                    component: SettingsPage,
                },
                {
                    path: '*',
                    name: 'Not Found',
                    component: NotFoundPage
                }
            ]
        }
    ]
});

router.beforeEach((to, from, next) => {
    next();
});

export default router;
