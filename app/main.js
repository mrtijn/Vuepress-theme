// GET DEPENDENCIES
import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(require('vue-resource'));
Vue.use(VueRouter);


// DEV
Vue.config.debug = false;

//COMPONENTS

// GLOBALS
import Header from './header.vue';
Vue.component('theme-header', Header);
import Footer from './footer.vue';
Vue.component('theme-footer', Footer);
//PAGES
import Frontpage from './frontpage.vue';

import Post from './post.vue';

import Page from './page.vue';



//DEFINE APP
var App = Vue.extend({
  props:{
    isLoading : {
      type : Boolean,
      value: false
    }
  },
  template:
  '<div id="app">'+
  '<theme-header></theme-header>'+
  '<div class="view-container"><router-view class="view" transition></router-view></div>'+
  '</div>',
  methods: {
    updateTitle(pageTitle) {
      document.title = (pageTitle ? pageTitle + ' - ' : '') + wp.site_name;
    }
  },
  events: {
    'page-title': function(pageTitle) {
      this.updateTitle(pageTitle);
    }
  }
});

// ROUTES
var router = new VueRouter({
  hashbang: false,
  history: true,
  transitionOnLoad: false,
  root: '/fransvanviegen/'
});


// CREATE ROUTES FOR ALL PAGES
console.log(wp)
for (var key in wp.routes) {
  var route = wp.routes[key];
  router.on(route.slug, {
    component: Vue.component(capitalize(route.type)),
    slug: route.slug
  });
}
// DEFINE CUSTOM ROUTES
router.map({
  '/': {
    component: Frontpage
  },
  '/blog': {
    component: Posts,
    subRoutes: {
      '/:slug': {
        component: Post
      }
    }
  },
  '/work' : {
    component: Work,
    subRoutes: {
      '/:slug' : {
        component: Workitem
      }
    }
  },
  '*' : {
    component: {
      template: '<div>Page not found</div>'
    }
  }
})
// START ROUTER
router.start(App, '#app');
router.beforeEach(function (transition) {
  console.log(transition)
  if (transition.to.path === '/forbidden') {
    transition.abort()
  } else {
    transition.next()
  }
})
router.afterEach(function (transition) {
  console.log('Successfully navigated to: ' + transition.to.path)
})
// FUNCTIONS
function capitalize(string){
  return string.charAt(0).toUpperCase() + string.slice(1);
}

Vue.http.interceptors.push({

    request: function (request) {
        this.$root.$broadcast('isLoading', true);
        return request;
    },

    response: function (response) {
        this.$root.$broadcast('isLoading', false);
        return response;
    }

});
