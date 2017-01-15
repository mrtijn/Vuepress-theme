import Vue from 'vue';
import vueRouter from 'vue-router';
Vue.use(vueRouter);

import sampleElement from '../element.vue';
import Page from '../page.vue';
import Single from '../single.vue';
import notFound from '../notFound.vue';
// Vue.component('sampleElement', sampleElement);
// DEFINE CUSTOM ROUTES
const routes = [
  {name: 'home', path: '/', component: Page},
  {name: 'post', path: '/blog/*', component: Single},
  {path: '*', component: Page},
];

export default new vueRouter({
  mode: 'history',
  routes
})
