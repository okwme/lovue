<template>
<div>
  <header class='grid'>
    <div :id='"menu-item-" + menuItem.post_name' :class='menuClasses' v-for='menuItem in wordpress.menus["main-menu"]'>
      <router-link v-if='menuItem.target === ""' :to='{path: menuItem.url}'>{{menuItem.title}}</router-link>
      <a v-else :target='menuItem.target' :href='menuItem.url'>{{menuItem.title}}</a>
    </div>
  </header>
  <div v-if='location'>
   <component v-bind:is="location.post_type" :post='location'></component>
  </div>
  <div v-else>
    <div v-for='post in wordpress.posts.posts'>
    <router-link :to='{path: post.permalink}'>{{post.post_title}}</router-link>
    </div>
  </div>
</div>
</template>

<script>

import Post from '@/components/Post'
import Page from '@/components/Page'

export default {

  name: 'Home',
  props: ['attr'],
  data () {
    return {
      wordpress
    };
  },
  components: {
    Post,
    Page
  },
  mounted () {
    // console.log(this)
  },
  computed: {
    menuClasses () {
      var menuClasses = {}
      menuClasses['col-1-' + this.wordpress.menus['main-menu'].length] = true
      return menuClasses
    },
    location () {
      var vm = this
      var postkey = this.wordpress.posts.posts.findIndex(function (post) {
        return post.permalink === vm.$route.path || post.permalink === vm.$route.path + '/'
      })
      if (postkey > -1) {
        return this.wordpress.posts.posts[postkey]
      }

      var pagekey = this.wordpress.pages.posts.findIndex(function (post) {
        return post.permalink === vm.$route.path || post.permalink === vm.$route.path + '/'
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