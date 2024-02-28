import { createRouter, createWebHistory } from 'vue-router';
import routes from './routes';
import BeforeEachGuard from '../guards/BeforeEachGuard';

const router =  createRouter({
    history: createWebHistory(),
    routes,
});
router.beforeEach(BeforeEachGuard);

export default router;