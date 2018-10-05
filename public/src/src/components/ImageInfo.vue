<template>
  <div class="ImageInfo card">
    <img src="http://img2.ph.126.net/wdDNWHC3mOkMbyxoU_yQyA==/3312116051054550527.jpg" />
    <img src="http://img2.ph.126.net/wdDNWHC3mOkMbyxoU_yQyA==/3312116051054550527.jpg" />
    <p class="link">
      <span>更多图文详情</span><img src="../assets/read-link.png" />
    </p>
  </div>
</template>

<script>
export default {
  name: 'ImageInfo',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
.ImageInfo {
  position: relative;
  font-size: 0px;
  width: 750px;
  img {
    display: block;
    width: 100%;
    margin: 0 auto;
  }
  .link {
    text-align: right;
    font-size: 36px;
    margin-top: 24px;
    color: #f14a46;
    img {
      display: inline-block;
      width: 16px;
      margin-left: 10px;
      vertical-align: middle;
    }
  }
}
</style>
