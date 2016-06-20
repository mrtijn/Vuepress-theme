<style media="screen" lang="sass">
</style>
<template>
  <div class="posts">
      <Post v-for="post in posts" :post="post" keep-alive></Post>
      <router-view class="view" transition="post"></router-view>
  </div>
</template>

<script>
  import $ from 'jQuery';
  import TweenMax from 'gsap';
  export default{
    data(){
      return {
        posts : []
      }
    },
    methods: {
      getPosts() {
        return this.$http.get(wp.root + 'wp/v2/posts').then(function(response) {
            this.posts = response.data;
            this.$dispatch('page-title', '');
        }, function(response) {
            console.log(response);
        });
      }
    },
    transitions:{
      post: {
        enter: function(el, done){
          console.log('enter');
        },
        leave: function(el, done){
          done();
        }
      }
    },
    route: {
      activate: function(){
        return this.getPosts();
      }
    }

  }
</script>
