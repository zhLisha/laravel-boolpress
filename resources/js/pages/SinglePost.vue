<template>
    <section>
        <div class="container">
            <div v-if="details">
                <h1>{{details.title}}</h1>

                <div class="category-tags">
                    <div class="category" v-if="details.category">
                        <span>
                            <strong>Cateogoria: </strong>
                        </span>
                        <span v-for="item, index in details" :key="index" class="badge rounded-pill bg-success text-dark mr-2">{{item.title}}</span>
                    </div>
                    <div class="tags" v-if="details.tags.length > 0">
                        <span>
                            <strong>Tags: </strong>
                        </span>
                        <span v-for="item, index in details.tags" :key="index" class="badge rounded-pill bg-info text-dark mr-2"> {{item.name}}</span>
                    </div>
                </div>

                <!-- Image -->
                <div class="image">
                    <img v-if="details.cover" :src="details.cover" :alt="details.title">
                </div>

                <div class="content">
                    <p>{{details.content}}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
// import Axios from 'axios';

export default {
    name: 'SinglePost',
    data() {
        return {
            details: null
        };
    },

    methods: {
        getDetailsApi() {
            axios.get('/api/blog/' + this.$route.params.slug)
            .then((response) => {
                this.details = response.data.results;
            })
        }
    },

    mounted() {
       this.getDetailsApi();
    }
}
</script>

<style lang="scss" scoped>
    .category-tags {
        margin-bottom: 20px;
    }
</style>