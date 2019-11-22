require('./bootstrap')

import Vue from 'vue'
import { Icon }   from 'leaflet'
import VueRouter  from 'vue-router'
import Vuex  from 'vuex'
import { routes }  from './components/routes'
import store from './components/store'
import App from './components/App'
import 'leaflet/dist/leaflet.css'

Vue.use( VueRouter )
Vue.use( Vuex )

const router = new VueRouter({
    routes,
    mode: 'history'
})
delete Icon.Default.prototype._getIconUrl

Icon.Default.mergeOptions({
    iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
    iconUrl: require('leaflet/dist/images/marker-icon.png'),
    shadowUrl: require('leaflet/dist/images/marker-shadow.png')
});
const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        App
    }
})
