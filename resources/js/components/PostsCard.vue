<template>
        <div class="card">
            <!-- <img src="..." class="card-img-top" alt="..."> -->
            <div class="card-body">
                <h5 class="card-title">{{ post.title }}</h5>
                <p class="card-text">{{ cutText(post.content) }}</p>
                <!-- <a href="#" class="btn btn-primary">Clicca per vedere il post</a> -->
                <router-link :to="{name: 'single-post', params: {slug: post.slug}}" class="btn btn-primary">Clicca per vedere il post</router-link>
            </div>
        </div>
</template>

<script>
export default {
    name: 'PostsCard',
    props: {
        post: Object
    },

    methods: {
        //    Cut text content if > then 60
       cutText(content) {
            if(content.length > 60) {
                return content.slice(0, 60) + '...';
            }

            return content;
        }
    }
}
</script>