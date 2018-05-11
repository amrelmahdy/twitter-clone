import Vue from 'vue'
import VueRouter from 'vue-router'
import $ from 'jquery'
import store from './store'


import { router } from './routes'

Vue.use(VueRouter)
window.$ = $

let app = new Vue({
    router,
    store,
    data: {
        'msg' : 'this is just a msg by vue'
    }
}).$mount('#app')