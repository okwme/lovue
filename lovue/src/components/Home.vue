<template>
<div>
  <h1><router-link :to='{name:"Home"}'>{{wordpress.name}}</router-link></h1>
  <div v-if='location'>
  show one
  </div>
  <div v-else>
    <div v-for='post in wordpress.posts.posts'>
    {{post}}
    <router-link :to='{path: post.post_name}'>{{post.post_title}}</router-link>
    </div>
  </div>
</div>
</template>

<script>
// var wordpress = require('../../static/wordpress.js')
// import wordpress from '../../static/wordpress'
console.log(wordpress)
export default {

  name: 'Home',
  props: ['attr'],
  data () {
    return {
      wordpress
    };
  },
  mounted () {
    console.log(this)
  },
  computed: {
    location () {
      var vm = this
      var postkey = this.wordpress.posts.posts.findIndex(function (post) {
        return post.post_name === vm.attr
      })
      if (postkey > -1) {
        return this.wordpress.posts.posts[postkey]
      }

      var pagekey = this.wordpress.pages.posts.findIndex(function (post) {
        return post.post_name === vm.attr
      })
      if (pagekey > -1) {
        return this.wordpress.pages.posts[pagekey]
      }
      return false
    }
  }
};
</script>

<style lang="css" scoped>
</style>