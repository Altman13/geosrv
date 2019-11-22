<template>
        <div class="row">
            <!-- {{allMarkers}} -->
        <div class="map col-lg-12">
            <l-map :zoom="zoom" :center="center">
            <l-marker
                v-for="marker in allMarkers"
                :key="marker.id" :lat-lng="marker.latlng">
                <l-popup >
                    <div>Почта: {{ marker.email}}</div><br/>
                    <div>Комментарий: {{ marker.comment}}</div>
                </l-popup>
            </l-marker>
            <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
            </l-map>
        </div>
        </div>
</template>

<script>

import { LMap, LTileLayer, LMarker, LPopup } from "vue2-leaflet"
import axios from "axios"
import { mapGetters } from "vuex"
import { error } from 'util'
import Vue from 'vue'

export default {
data: function () {
    return {
        zoom: 13,
        center: L.latLng(43.12165, 133.12347),
        url: "http://{s}.tile.osm.org/{z}/{x}/{y}.png",
        attribution:
            '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
        markers: []
    }
},
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LPopup
    },
    mounted() {
        console.log( "MapComponent mounted" )
    },
    computed: {
    ...mapGetters(['allMarkers'])
    },
    beforeUpdate () {
        console.log(state)
    }
}
</script>

<style>

</style>
