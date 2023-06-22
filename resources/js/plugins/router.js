import VueRouter from 'vue-router';
import AdminLayout from "../layouts/AdminLayout";
import DashboardPage from "../pages/admin/DashboardPage.vue";
import MenuPage from "../pages/admin/MenuPage.vue";
import PagesPage from "../pages/admin/PagesPage.vue";
import ToursPage from "../pages/admin/ToursPage.vue";
import PostsPage from "../pages/admin/PostsPage.vue";
import FileManagerPage from "../pages/admin/FileManagerPage";
import NotFoundPage from "../pages/admin/NotFoundPage";
import UsersPage from "../pages/admin/UsersPage";
import CountriesPage from "../pages/admin/CountriesPage.vue";
import OrdersPage from "../pages/admin/OrdersPage.vue";
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
                    path: 'menu',
                    name: 'admin.menu',
                    component: MenuPage,
                },
                {
                    path: 'pages',
                    name: 'admin.pages',
                    component: PagesPage,
                },
                {
                    path: 'tours',
                    name: 'admin.tours',
                    component: ToursPage,
                },
                {
                    path: 'posts',
                    name: 'admin.posts',
                    component: PostsPage,
                },
                {
                    path: 'countries',
                    name: 'admin.countries',
                    component: CountriesPage,
                },
                {
                    path: 'orders',
                    name: 'admin.orders',
                    component: OrdersPage,
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
