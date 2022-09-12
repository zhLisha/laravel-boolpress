<template>
    <div class="container">
        <a href="/admin">Admin privata</a>
        <h1>Ciao questa e' la pagina App.vue</h1>

        <Posts />
    </div>
</template>

<script>
import Axios from 'axios';
import Posts from '../components/Posts.vue';

export default {
    name: 'App',
    components: {
        Posts
    }
}

</script>