<template>
    <header>
        <!-- <nav v-for="nav, index in navBar" :key="index"> -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Boolpress</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li v-for="nav, index in navBar" :key="index" class="nav-item">
                            <router-link :to="{name: nav.name}" class="nav-link" >{{nav.label}}</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- </nav> -->
    </header>
</template>

<script>
export default {
    name: 'Header',
    data() {
        return {
            navBar: [
                {
                    name: 'home',
                    label: 'Home'
                },
                {
                    name: 'about',
                    label: 'About'
                },
                {
                    name: 'blog',
                    label: 'Blog'
                }
            ]
        }
    }
}
</script>

<style lang="sass" scoped>

</style>