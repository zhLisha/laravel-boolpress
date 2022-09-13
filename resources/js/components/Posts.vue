<template>
    <section>
        <h3>{{ pageTitle }}</h3>
        <!-- Cards -->
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


export default {
    name: 'Posts',

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

    //    Cut text content if > then 60
       cutText(content) {
            if(content.length > 60) {
                return content.slice(0, 60) + '...';
            }

            return content;
       }
    },

    mounted() {
        this.getApiPosts(1);
    }
}

</script>