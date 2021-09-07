import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

import FilteredMusicians from './components/FilteredMusicians';
import Home from './pages/Home';
import MusicianProfile from './pages/MusicianProfile';
import MessageConfirm from './pages/MessageConfirm';
import ReviewConfirm from './pages/ReviewConfirm';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/musicians/:slug',
            name: 'musicians',
            component: FilteredMusicians
        },
        {
            path: '/musician/:slug',
            name: 'musician',
            component: MusicianProfile
        },
        {
            path: '/message-confirm',
            name: 'message-confirm',
            component: MessageConfirm
        },
        {
            path: '/review-confirm',
            name: 'review-confirm',
            component: ReviewConfirm
        }
    ]
});

export default router;