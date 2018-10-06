<template>
  <div class="head-info">
    <img class="poster" src="http://img0.ph.126.net/t3kXj_tyyoRvUaVB9yCMkQ==/1821987524348614419.jpg" />
    <div class="card">
      <p class="title">《大丈夫》火锅酒100元代金券10张</p>
      <p class="price"><span class="red-font">¥<span class="now">0 </span></span><span class="old">¥100元</span></p>
      <hr class="hr">
      <div class="right-info">
        <p class="time">2018-09-14 14:00</p>
        <p>自动开奖</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HeadInfo',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.poster {
  display: block;
  width: 100%;
  height: 375px;
}
.right-info {
  margin-top: 20px;
  text-align: right;
  color: #666666;
  font-size: 24px;
}
.price {
  line-height: 2;
  font-size: 24px;
  color: #666666;
}
.now {
  font-size: 44px;
}
.old {
  text-decoration: line-through;
}
</style>
