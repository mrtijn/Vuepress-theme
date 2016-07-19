<style lang="scss" scoped>
  header{
    position: relative;;
    z-index: 999999;
    background-color: #000;
    width: 100%;
    padding: 20px;
    .site-title{
      display: inline-block;

      a{
        display: inline-block;
        padding: 15px;
        color: #FFF;
        text-decoration: none;
      }
    }
    ul{
      float: right;
      list-style: none;
      margin: 0;
      li{
        display: inline-block;
        a{
          display: block;
          padding: 15px;
          color: #FFF;
          text-decoration: none;
          &.current-menu-item{
            text-decoration:  underline;
          }
        }
      }
    }

    &:after{
      clear: both;
      display: block;
      content: '';
    }
  }
</style>

<template>
  <header>
      <div class="site-title">
        <a v-link="{path: '/'}">{{site_name}}</a>
          <loader></loader>
      </div>
      <ul>
        <li v-for="item in items">
          <a v-link="{path: convertToSlug(item.url), activeClass: 'current-menu-item', exact: true}" >{{item.title}}</a>
        </li>
      </ul>
  </header>

</template>

<script>
    import Vue from 'vue';
    import Loader from './common/loader.vue';
    Vue.component('loader', Loader);
    export default {
        ready() {
            this.getPages();
        },
        data() {
            return {
                base_path: wp.base_path,
                site_name: wp.site_name,
                is_home: false,
                items: []
            }
        },
        methods: {
            getPages() {
                this.$http.get(wp.root + 'menus/v1/menus/navigation').then(function(response) {
                    this.items = response.data.items;
                });
            },
            convertToSlug(string){
              return string.replace(wp.base_url, '');
            }
        }
    }
</script>
