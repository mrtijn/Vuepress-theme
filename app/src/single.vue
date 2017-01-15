<template lang="html">
  <div class="single">
    <div class="content" v-html="page">

    </div>
  </div>
</template>

<script>
import $ from 'jQuery';
export default {
  data(){
    return{
      page: null
    }
  },
  created(){
    // this.page = $('body').find('.view').html();
    console.log('im a blog');

  },
  mounted(){
    $('.view').show();
    if(this.page == null){
      this.getPage();
    }
  },
  methods:{
    getPage(){
      console.log(window.location.href);
      $.ajax({
        url: window.location.href,
        type: 'GET',
        cache: true
      })
      .done((data) => {
        let $data = $(data);

        this.page = $('.view', $data).html();
        // $('.content').fadeIn();
        // console.log($data.find('div.page').innerHTML);
        // this.page = $data.find('#page').innerHTML;
        // console.log(data);
        // console.log($data);
      })
    }
  },
  watch: {
      $route (to,from) {
        let $this = this;
        // $('.content').fadeOut(50,function(){
            $this.getPage();
        // });

      }
    }
}
</script>

<style lang="css">
</style>
