<template>
    <section class="container">
        <h2>Ci dicpaice, la pagina che stai cercando non esiste :(</h2>
        <span>
            Forse stavi cercando 
            <router-link :to="{name: 'blog'}">Blog</router-link>
        </span>
    </section>
</template>

<script>
    export default {
        name: 'NotFound'
    }
</script>