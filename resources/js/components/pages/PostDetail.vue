<template>
  <main class="container">
    <h1>
      {{ post.title }}
    </h1>

    <h3 v-if="post.category">
      {{ post.category.name }}
    </h3>

    <h4 v-for="(tag, index) in post.tags" :key="`tags${index}`">
      {{ tag.name }}
    </h4>
    
    <p>
      {{ post.content }}
    </p>
  </main>
</template>

<script>
export default {
  name: 'PostDetail',

  data(){
    return {
      apiUrl: 'http://127.0.0.1:8000/api/posts/',
      post: {
        title: '',
        content: '',
        category: {},
        tags: [],
      }
    }
  },

  methods: {
    getApi(){
      axios.get(this.apiUrl + this.$route.params.slug)
      .then(res => {
        this.post = res.data;
        console.log(this.post);
      });
    }
  },

  mounted(){
    this.getApi();
  }
}
</script>

<style lang="scss" scoped>

.container{
  margin-top: 30px;
}

</style>