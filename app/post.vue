<style media="screen">

</style>

<template>
  <div class="post" v-bind:style="{backgroundColor: post.acf.background_color}" >
    <h1 class="entry-title" v-if="isSingle">{{ post.title.rendered }}</h1>
    <h2 class="entry-title" v-else><a v-link="{ path: base_path + post.slug }">{{ post.title.rendered }}</a></h2>

    <div class="entry-content">
        {{{ post.content.rendered }}}
    </div>
  </div>
</template>

<script>
  import $ from 'jQuery';
  export default {
    props: {
      post:{
        type: Object,
        default(){
          return {
            id: 0,
            acf: {
              background_color: '#FFF'
            },
            slug: '',
            title: { rendered: ''},
            content: {rendered : ''}
          }
        }
      }
    },
    ready() {

    },
    data(){
      return {
        base_path: wp.base_path,
        isSingle: false
      }
    },
    methods: {
      getPost(name) {
        return this.$http.get(wp.root + 'wp/v2/posts/?filter[name]=' + name)
        .then(function(response) {
            this.post = response.data[0];
            this.isSingle = true;
            this.$dispatch('page-title', this.post.title.rendered);
        }, function(response) {
            console.log('error' + response);
        });
      }
    },
    route: {
      activate: function(transition){
          return this.getPost(transition.to.params.slug)
      }
    }

  }
</script>
