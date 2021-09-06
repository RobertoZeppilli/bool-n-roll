import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

import FilteredMusicians from './components/FilteredMusicians';
import Home from './pages/Home';
import MusicianProfile from './pages/MusicianProfile';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/musicians/:id',
            name: 'musicians',
            component: FilteredMusicians
        },
        {
            path: '/musician/:id',
            name: 'musician',
            component: MusicianProfile
        }
    ]
});

export default router;