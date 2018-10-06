<template>
  <div class="JoinMember card">
    <p class="title center">参与活动成员</p>
    <p class="text">共计xx人参与抽奖，到达400人即可提前开奖</p>
    <ul class="ul">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'PrizeJoinMemberInfo',
  data () {
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
.JoinMember {
  text-align: center;
  .center {
    text-align: center;
  }
  .text {
    margin-top: 24px;
    font-size: 24px;
    color: #666666;
  }
  .ul {
    width: 620px;
    margin: 30px auto;
    text-align: left;
    li {
      display: inline-block;
      margin: 2px;
      width: 64px;
      height: 64px;
      background-color: red;
    }
  }
}
</style>
