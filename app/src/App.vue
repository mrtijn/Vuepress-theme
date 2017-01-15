<template>
  <div id="app">
    <ul>
      <router-link :to="{path: '/'}">Home</router-link>
      <router-link :to="{path: '/voorbeeld-pagina'}">Voorbeeld pagina</router-link>
      <router-link :to="{path: '/portfolio'}">Portfolio</router-link>
    </ul>
    <transition name="fade" mode="out-in">
      <router-view class="view"></router-view>
    </transition>
  </div>
</template>
