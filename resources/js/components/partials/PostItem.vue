<template>
  
  <article>
    <h3>
      <router-link :to="{name: 'detail', params:{slug: post.slug}}">{{ post.title}}</router-link>
    </h3>
    <p class="date">{{ formatDate }}</p>
    <p class="text">{{ post.content }}</p>
  </article>

</template>

<script>
export default {
  name: 'PostItem',
  
  props: {
    'post': Object
  },

  computed: {
    formatDate(){
      const d = new Date(this.post.created_at);
      let day = d.getDate();
      let month = d.getMonth() + 1;
      const year = d.getFullYear();

      if(day < 10) day = '0' + day;
      if(month < 10) month = '0' + month;

      return `${day} / ${month} / ${year}`;
    }
  }
}
</script>

<style lang="scss" scoped>
  article{
    margin-bottom: 30px;
    .date{
      margin: 5px 0;
      font-size: 12px;
      font-style: italic;
    }
    .text{
      padding: 5px 0;
    }
    a{
      color: blue;
      text-decoration: none;
      &:hover{
        text-decoration: underline;
      }
    }
  }
</style>