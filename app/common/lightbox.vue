<style lang="sass">
  .lightbox{
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;

    .backdrop{
      position: absolute;
      height: 100%;
      width: 100%;
      background-color: rgba(0,0,0,0.4);
    }
    .lightbox__inner{
      width: 500px;
      position: relative;
      margin: 10% auto;
      img{
        max-width: 100%;
      }
    }
  }
</style>

<template>
  <div class="lightbox"  v-show="show">
    <div class="backdrop" @click="show = false"></div>
    <div class="lightbox__inner">
      <img :src="img" alt="" />
    </div>
  </div>
</template>

<script>
export default {
  props:{
    show: {
      type: Boolean,
      required: true,
      twoWay: true
    },
    img:{
      type: String
    }
  },
}
</script>
