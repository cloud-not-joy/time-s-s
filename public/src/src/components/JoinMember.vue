<template>
  <div class="JoinMember card">
    <p class="title center">参与活动成员</p>
    <p class="text">共计{{ store.joinedCount }}人参与抽奖，到达400人即可提前开奖</p>
    <ul class="ul">
      <li v-for="(item, index) in store.joinedList" v-bind:key="index">
        <img :src="item.avatar" />
      </li>
    </ul>
  </div>
</template>

<script>
import store from '@/store/index.js'
export default {
  name: 'PrizeJoinMemberInfo',
  data () {
    return {
      store: store
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

      img {
        display: inline-block;
        width: 64px;
        height: 64px;
      }
    }
  }
}
</style>
