import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import About from '../pages/About';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';

import usersIndex from '../components/users/index';
import usersCreate from '../components/users/create';
import usersEdit from '../components/users/edit';
import usersShow from '../components/users/show';

import rolesIndex from '../components/roles/index';
import rolesCreate from '../components/roles/create';
import rolesEdit from '../components/roles/edit';
import rolesShow from '../components/roles/show';

export const routes = [
    {
        name: 'home',
        path: '/',
        redirect: '/login'
    },
    {
        name: 'about',
        path: '/about',
        component: About
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'users',
        path: '/users',
        component: usersIndex
    },
    {
        name: 'user-create',
        path: '/users/create',
        component: usersCreate
    },
    {
        name: 'user-edit',
        path: '/users/edit/:id',
        component: usersEdit
    },
    {
        name: 'user-show',
        path: '/users/show/:id',
        component: usersShow
    },
    {
        name: 'roles',
        path: '/roles',
        component: rolesIndex
    },
    {
        name: 'role-create',
        path: '/roles/create',
        component: rolesCreate
    },
    {
        name: 'role-edit',
        path: '/roles/edit/:id',
        component: rolesEdit
    },
    {
        name: 'role-show',
        path: '/roles/show/:id',
        component: rolesShow
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
