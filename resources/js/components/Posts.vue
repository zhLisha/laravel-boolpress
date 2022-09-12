<template>
    <section>
        <h2>{{ pageTitle }}</h2>
        <div class="row row-cols-3">
            <div v-for="post in posts" :key="post.id" class="col mt-4"> 
                <div class="card">
                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body">
                        <h5 class="card-title">{{ post.title }}</h5>
                        <p class="card-text">{{ cutText(post.content) }}</p>
                        <a href="#" class="btn btn-primary">Clicca per vedere il post</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Axios from 'axios';


export default {
    name: 'Posts',

    data() {
        return {
            pageTitle: 'Lista dei post',
            posts: []
        };
    },

    methods: {
       getApiPosts() {
            axios.get('/api/posts')
            .then((response) => {
                this.posts = response.data.results;
            });
       },

    //    Cut text content if > then 70
       cutText(content) {
            if(content.length > 70) {
                return content.slice(0, 70) + '...';
            }

            return content;
       }
    },

    mounted() {
        this.getApiPosts();
    }
}

</script>