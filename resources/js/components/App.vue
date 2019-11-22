<template>
    <div>
        <p>
            <router-link to="/map">Добавить маркер</router-link>
            <router-link to="/allmarkers">Основная карта</router-link>
        </p>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    export default {}

</script>
