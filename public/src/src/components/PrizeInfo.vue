<template>
  <div class="PrizeInfo card">
    <p class="title">奖品说明</p>
    <ul>
      <li>1、100元代金券适用于全场菜品，锅底、油碟、酒水除外；</li>
      <li>2、限1人以上使用，1桌限用1张；</li>
      <li>3、不与店内其他优惠同享；</li>
      <li>4、有效期至2018年10月14日；</li>
      <li>5、使用无需预约；</li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'PrizeInfo',
  data () {
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
.PrizeInfo {
  ul {
    li {
      // font-size: 24px;
      color: #666666;
      margin-top: 12px;
    }
  }
}
</style>
