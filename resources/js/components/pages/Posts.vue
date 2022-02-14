<template>
  
  <main>
    <div class="container">
       
       <div>
         <h1>i miei post</h1>

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
      apiUrl: 'http://127.0.0.1:8000/api/posts?page=',
      posts: null,
      pages: {},
      tags: [],
      categories: [],
    }
  },
  mounted(){
    this.getPosts(this.apiUrl);
  },
  methods:{
    getPosts(page = 1){
      axios.get(this.apiUrl + page)
      .then(res => {
        this.posts = res.data.posts.data;
        this.categories = res.data.categories;
        this.tags = res.data.tags;
        console.log(this.categories, this.tags);
        this.pages = {
          current: res.data.current_page,
          last: res.data.last_page,
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