<template>
    <section>
        <h3>{{ pageTitle }}</h3>
        <!-- Cards -->
        <div class="row row-cols-3">
            <div v-for="singlePost in posts" :key="singlePost.id" class="col mt-4"> 
                <PostsCard :post="singlePost" />
            </div>
        </div>

        <!-- Pagination number -->
        <nav aria-label="Page navigation example" class="mt-4">
            <ul class="pagination">

                <!-- Previous Page-->
                <li class="page-item" :class="{'disabled': currentPage == firstPage}">
                    <a class="page-link" href="#" @click="getApiPosts(currentPage - 1)">Previous</a>
                </li>
                
                <!-- Pagination number -->
                <li v-for="n in lastPage" :key="n" class="page-item" :class="{'active': n === currentPage}">
                    <a class="page-link" @click="getApiPosts(n)" href="#">{{n}}</a>
                </li>

                <!-- Next Page -->
                <li class="page-item" :class="{'disabled': currentPage == lastPage}">
                    <a class="page-link"  @click="getApiPosts(currentPage + 1)" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </section>
</template>

<script>
import Axios from 'axios';
import PostsCard from '../components/PostsCard.vue';

export default {
    name: 'Posts',
    components: {
        PostsCard
    },

    data() {
        return {
            pageTitle: 'Lista dei post',
            posts: [],
            currentPage: 1,
            lastPage: null,
            firstPage: 1
        };
    },

    methods: {
       getApiPosts(pageNumber) {
            axios.get('/api/posts', {
                params: {
                    page: pageNumber
                }
            })
            .then((response) => {
                this.posts = response.data.results.data;
                this.currentPage = response.data.results.current_page;
                this.lastPage = response.data.results.last_page;
            });
       },
    },

    mounted() {
        this.getApiPosts(1);
    }
}

</script>