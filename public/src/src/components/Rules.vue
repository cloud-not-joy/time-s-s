<template>
  <div class="Rules card">
    <p class="title">中奖规则</p>
    <ul class="rule-ul">
      <li>1、点击立即抽，即可获得1次抽奖机会；</li>
      <li>2、每1位好友通过你的链接参加活动，即可增加2.5%的中奖概率；邀请39位好友参与，可直接获得本期奖品；</li>
      <li>3、活动将于9月14日14点开奖；到达400人即可提前开奖</li>
      <li>4、中奖信息将在本页面公布，微信公众号同步推送；</li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'Rules',
  data () {
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
.Rules {
  background-color: #ffffff;
}
.rule-ul {
  color: #666666;
  // font-size: 24px;
  li {
    margin-top: 12px;
  }
}
</style>
