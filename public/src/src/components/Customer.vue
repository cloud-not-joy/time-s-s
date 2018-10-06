<template>
  <div class="customer card">
    <p class="name title title2">适用商户</p>
    <p class="post-and-name">
      <img class="poster" src="http://img0.ph.126.net/t3kXj_tyyoRvUaVB9yCMkQ==/1821987524348614419.jpg" />
      <span class="title title2">大丈夫火锅</span>
    </p>
    <hr>
    <ul class="contact-info">
      <li>
        <img src="../assets/images/add-icon_03.png" />
        <p>地址：紫荆北街85号(大世界第5街私串日料对面)</p>
      </li>
      <li>
        <img src="../assets/images/phone-icon_03.png" />
        <p>电话：19938498171</p>
      </li>
      <li>
        <img src="../assets/images/time-icon.png" />
        <p>营业时间：17:30-00:00</p>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'Customer',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
.poster {
  width: 115px;
  height: 115px;
}
.post-and-name {
  margin: 30px 0px 30px 0;
  .title {
    margin-left: 12px;
    vertical-align: top;
    line-height: 115px;
  }
}
.contact-info {
  margin-top: 30px;
  li {
    margin-top: 12px;
  }
  img {
    vertical-align: top;
  }
  p {
    display: inline-block;
    vertical-align: top;
    color: #333333;
    font-size: 24px;
    margin-left: 6px;
  }
}
</style>
