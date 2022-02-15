<template>
  
  <main>
    <div class="container">
       
       <div>
         <h1>{{ title }}</h1>

        <PostItem 
          v-for="post in posts"
          :key="`post${post.id}`"
          :post="post"
        />

        <button
          @click="getPosts(pages.current - 1)"
          :disabled="pages.current === 1"
        >prev</button>

        <button class="btn-numbers"
          v-for="page in pages.last"
          :key="`button${page}`"
          @click="getPosts(page)"
          :disabled="pages.current === page"
        >{{ page }}</button>

        <button
          @click="getPosts(pages.current + 1)"
          :disabled="pages.current === pages.last"

        >next</button>

        
       </div>

        <Sidebar 
          :tags="tags"
          :categories="categories"
          @getPostCategory="getPostCategory"
          @getPostTag="getPostTag"
          @getAllPosts="getPosts"
        />

    </div>

    

  </main>

</template>

<script>

import PostItem from '../partials/PostItem.vue';
import Sidebar from '../partials/Sidebar.vue';

export default {
  name: 'Posts',

  components: {
    PostItem,
    Sidebar,
  },
  data(){
    return{
      apiUrl: 'http://127.0.0.1:8000/api/posts',
      posts: null,
      pages: {},
      tags: [],
      categories: [],
      title: 'I miei post',
    }
  },
  mounted(){
    this.getPosts(this.apiUrl);
  },
  methods:{
    getPostTag(slug_tag){
      axios.get(this.apiUrl + '/posttag/' + slug_tag)
      .then(res =>{
        this.posts = res.data.tag.posts;
        this.title = "I miei post per il tag: " + res.data.tag.name;
      })
    },
    getPostCategory(slug_category){
      axios.get(this.apiUrl + '/postcategory/' + slug_category)
      .then(res =>{
        this.posts = res.data.category.posts;
        this.title = "I miei post per la categoria: " + res.data.category.name;
      })
    },
    getPosts(page = 1){
      this.posts = null;
      axios.get(this.apiUrl + '?page=' + page)
      .then(res => {
        this.posts = res.data.posts.data;
        this.categories = res.data.categories;
        this.tags = res.data.tags;
        this.pages = {
          current: res.data.posts.current_page,
          last: res.data.posts.last_page,
        }
      })
    }
  }
}
</script>

<style lang="scss" scoped>
main{
  .container{
    display: flex;
  }
  padding: 30px 0;
  h1{
    margin-bottom: 20px;
  }
  button{
    padding: 5px 10px;
    
  }
  .btn-numbers{
    margin: 5px;
  }
}

</style>