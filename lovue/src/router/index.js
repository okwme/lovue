import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'

Vue.use(Router)

// var wordpress = require('../../static/wordpress.js')

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '*',
      props: true,
      name: 'Home',
      component: Home
    }
  ]
})
