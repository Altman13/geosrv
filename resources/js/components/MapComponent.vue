<template>
    <div class="row">
    <div class="map col-lg-6">
        <l-map :zoom="zoom" :center="center" @click="addMarker">
        <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
        <l-marker
                :lat-lng="marker.latlng"
                        v-for="marker in markers"
            :key="marker.id"
                        @click="emitMarkerClick"
        >
        <l-popup >
            <div>Почта: {{ marker.email}}</div><br/>
            <div>Комментарий: {{ marker.comment}}</div>
        </l-popup>
        </l-marker>
        </l-map>
    </div>
    <div class="col-lg-6" style="border: 2px solid black;">
        <form>
            <div class="form-group">
                <label for="mail">Email адрес</label>
                <input type="email" class="form-control" id="mail" placeholder="Необходимо указать почту" ref="email"/>
            </div>
            <div class="form-group">
                <label for="categories">Категории</label>
                <select class="form-control" id="categories" @change="handleChange">
                    <option value=1 data-value="Категория1">Категория1</option>
                    <option value=2 data-value="Категория2">Категория2</option>
                    <option value=3 data-value="Категория3">Категория3</option>
                    <option value=4 data-value="Категория4">Категория4</option>
                    <option value=5 data-value="Категория5">Категория5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="comment">Дополнительная информация</label>
                <textarea class="form-control" id="comment" rows="3" ref="comment"></textarea>
                <div class="row">
                    <button
                        type="button"
                        class="btn btn-success"
                        @click="add()"
                        style="display:block; margin-top:10px; margin-left:10px;">Добавить все маркеры в хранилище
                    </button>
                    <button
                        type="button"
                        class="btn btn-danger"
                        @click="del(index)"
                        style="display:block; margin-top:10px; margin-left:10px;">Удалить маркер
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>
</template>

<script>
import { LMap, LTileLayer, LMarker, LPopup } from "vue2-leaflet"
import axios from "axios"
import { mapActions } from "vuex"
import { error } from 'util'
import Vue from 'vue'

export default {
    props: {
        index: Number
    },
    data: function() {
    return {
        category: "",
        comment: "",
        content: "",
        email: "",
        zoom: 13,
        center: L.latLng(43.12165, 133.12347),
        url: "http://{s}.tile.osm.org/{z}/{x}/{y}.png",
        attribution:
            '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
        markers: [],

        };

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
    beforeUpdate() {
        console.log( "MapComponent update" )
    },

    methods: {

        ...mapActions( ["addMarkers", "deleteMarker"] ),

        addMarker(e) {
            if(!this.$refs.email.value){
                alert('Почта не может быть пустой')
                return false;
            }
            this.markers.push({
            email : this.$refs.email.value,
            latlng: e.latlng,
            category : this.category,
            comment : this.$refs.comment.value,
            })
            this.$refs.email.value=''
            this.$refs.comment.value=''
        },
        add(){
            this.addMarkers( this.markers )
        },
        del(index){
            this.markers.splice( index, 1 )
            this.deleteMarker( this.markers )
        },
        handleChange(e) {
            if( e.target.options.selectedIndex > -1 ) {
                this.category=e.target.options[e.target.options.selectedIndex].dataset.value
            }
        },
        emitMarkerClick () {
        this.$emit('marker-click')
        console.log('маркер нажат')
        },
    }
}
</script>
<style>
.map {
    height: 500px;
    width: 1000px;
}
</style>
