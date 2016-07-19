<style media="screen" lang="sass">
  .frontpage{
    height: 100vh;
    width: 100vw;
    background-color: #000;
    overflow: hidden;
    figure{
      width: 400px;
      float: right;
      position: relative;
      img{
        width: 100%;
        animation: fadeIn 1s;
        @keyframes fadeIn{
          0%{opacity: 0; transform: translateX(100px);}
          100%{opacity: 1;transform: translateX(0px);}
        }
      }

      figcaption{
        color: #FFF;
        position: absolute;
        left: -40vw;
        top: 60px;
        font-weight: 300;
        h1{
          font-size: 2rem;
          text-transform: uppercase;
          font-weight: 800;
          margin-bottom: 0;
        }
        h2{
          font-weight: 300;
          margin: 0;
        }
      }
    }
  }
</style>

<template>
  <div class="frontpage">
    <figure>
      <img :src="theme_path + '/assets/img/frans.jpg'" alt="" />
      <figcaption>
        <h1>Frans van Viegen</h1>
        <h2>Photographic Narratives</h2>
      </figcaption>
    </figure>
  </div>
</template>

<script>
  export default {
    data(){
      return {
        theme_path: wp.theme_path,
      }
    }
  }
</script>
