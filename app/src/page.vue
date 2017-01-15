<template lang="html">
  <div class="page">
    <div class="content" v-html="page">
    </div>
  </div>
</template>

<script>
import $ from 'jQuery';
import TweenMax from 'gsap';
export default {
  data(){
    return{
      page: null
    }
  },
  created(){
    console.log(this.page);
    this.page = $('body').find('.view').html();
  },
  mounted(){
    $('.view').show();
    if(this.page == null){
      this.getPage();
    }
    let $this = this;
    $(document).on('click', 'a', function(e){
      e.preventDefault();
      let url = $(this).attr('href');
      console.log($this.$router)
        $this.$router.push({path: url});

    })
  },
  methods:{
    getPage(){
      // console.log(window.location.href);
      $.ajax({
        url: window.location.href,
        type: 'GET',
        cache: true
      })
      .done((data) => {
        let $data = $(data);

        this.page = $('.view', $data).html();
        $('.content').fadeIn(50);
        // console.log($data.find('div.page').innerHTML);
        // this.page = $data.find('#page').innerHTML;
        // console.log(data);
        // console.log($data);
      })
    }
  },
  beforeRouteLeave (to, from, next) {
    // $()

    next();
  },
  watch: {
      $route (to,from) {
        let $this = this;
        $('.content').fadeOut(50,function(){
            $this.getPage();
        });

      }
    }
}
</script>

<style lang="css">
</style>
