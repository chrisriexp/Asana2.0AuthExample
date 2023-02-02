import './bootstrap';
import './axiosConfig';
import {createApp} from 'vue'
import App from '../App.vue'
import '../css/app.css'
import '../css/tailwind.css'
import {createRouter, createWebHistory} from 'vue-router';
import NotFound from './views/NotFound.vue'
import Login from './views/Login.vue'
import Dashboard from './views/Dashboard.vue'
import ReportError from './views/ReportError.vue'
import Tasks from './views/Tasks.vue'
import Notes from './views/Notes.vue'
import Reminders from './views/Reminders.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/:catchAll(.*)",
            name: "NotFound",
            component: NotFound,
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/dashboard',
            name: 'Dashboard',
            component: Dashboard,
            beforeEnter: validateAccessToken
        },
        {
            path: '/report-error',
            name: 'ReportError',
            component: ReportError
        },
        {
            path: '/tasks',
            name: 'Tasks',
            component: Tasks,
            beforeEnter: validateAccessToken
        },
        {
            path: '/notes',
            name: 'Notes',
            component: Notes
        },
        {
            path: '/reminders',
            name: 'Reminders',
            component: Reminders
        }
    ],
})

function validateAccessToken(to, from, next) {
    const accessToken = localStorage.getItem('token');
    if (!accessToken) {
        next({ name: "Login" });
        return;
    }

    axios.get('/api/token/validate')
    .then(response => {
        if (response.data.valid) {
            next();
        } else {
            next({ name: "Login" });
        }
    })
    .catch(error => {
        console.error(error);
        next({ name: "Login" });
    });
}

createApp(App).use(router).mount("#app")