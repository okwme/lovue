<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'app'
}
</script>

<style lang="scss">
$max-width: 1440px;
$padding: 20px;
$mobile-max-width: 679px;
$mobile-padding: 10px;
$tablet-min-width: $mobile-max-width;
$tablet-max-width: 1040px;
@import './sass/_grid.scss';
html, body {
  padding:0;
  margin:0;
}
*{
  box-sizing: border-box;
}
</style>
