import axios from 'axios'
import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

const state = {
    markers: []
}

const getters = {
    allMarkers: state => {
        return state.markers
    }
}
const actions = {
    async fetchMarkers({
        commit
    }) {
        const response = await axios.get(
            '/api/markers/'
        )
        .then( data => console.log(data))
        .catch( e => console.log(e))
        commit( 'setMarkers', response.data )
    },
    async addMarkers( {commit }, markers ) {
        const response = await axios.post(
            '/api/marker/',
            { markers }
        )
        .then( data => console.log(data))
        .catch( e => console.log(e))
        commit( 'setMarkers', markers )
    },
    async deleteMarker({ commit }, id) {
        await axios.delete( `/api/marker/delete/${id}` )
        .then( data => console.log(data))
        .catch( e => console.log(e))
        commit( 'removeMarker', id )
    },
}
const mutations = {
    setMarkers: ( state, markers ) => ( state.markers = markers ),
    //newMarker: ( state ) => state.markers.unshift( marker ),
    removeMarker: ( state, id ) => ( state.markers = state.markers.filter(marker => marker.id !== id )),
}
export default new Vuex.Store({
    state,
    getters,
    actions,
    mutations
})
