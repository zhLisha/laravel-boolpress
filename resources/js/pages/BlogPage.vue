<template>
    <section class="container">
        <h2>Blog Page</h2>
        <Posts />
    </section>
</template>

<script>
import Posts from '../components/Posts.vue';

export default {
    name: 'BlogPage',
    components: {
        Posts
    }
}
</script>