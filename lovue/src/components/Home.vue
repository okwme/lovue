<template>
<div>
  <h1>Home</h1>
  <pre>{{wordpress}}</pre>
</div>
</template>

<script>
// var wordpress = require('../../static/wordpress.js')
// import wordpress from '../../static/wordpress'
console.log(wordpress)
export default {

  name: 'Home',

  data () {
    return {
      wordpress
    };
  },
  computed: {
    location () {
      // console.log(this.$route)
    }
  }
};
</script>

<style lang="css" scoped>
</style>