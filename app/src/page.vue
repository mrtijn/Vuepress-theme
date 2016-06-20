<style>

</style>

<template>
  <div class="page" v-bind:style="{backgroundColor: page.acf.background_color}">
      <h1 class="entry-title">{{ page.title.rendered }}</h1>

      <div class="entry-content">
          {{{ page.content.rendered }}}
      </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            page: {
                id: 0,
                slug: '',
                title: { rendered: '' },
                content: { rendered: '' },
                acf: {
                  background_color : '#FFF'
                }
            }
        }
    },
    methods: {
        getPage(name) {
            return this.$http.get(wp.root + 'wp/v2/pages/?filter[name]=' + name).then((response) => {
                this.page = response.data[0];
                this.$dispatch('page-title', this.page.title.rendered);
            });
        }
    },
    route: {
      activate: function(transition){
        return this.getPage(transition.to.slug);
      }
    }
}
</script>
