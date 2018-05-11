import VueRouter from 'vue-router'
// views
import Home from './views/Home.vue'



const routes = [
    {
        path: '/',
        component: Home
    }
]


const router = new VueRouter({
    routes,
    mode: 'history'
})


export { router }