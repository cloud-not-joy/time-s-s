<template>
  <div class="page">
    <HeadInfo></HeadInfo>
    <Customer></Customer>
    <ImageInfo></ImageInfo>
    <Rules></Rules>
    <PrizeInfo></PrizeInfo>
    <JoinBar></JoinBar>
    <JoinMember></JoinMember>
    <JoinedAlert v-if="store.isShowJoinedAlert"></JoinedAlert>
    <InviteTip :close="closeInviteTip" v-if="store.isShowInviteTips"></InviteTip>
  </div>
</template>

<script>
import HeadInfo from '@/components/HeadInfo.vue'
import Customer from '@/components/Customer.vue'
import ImageInfo from '@/components/ImageInfo.vue'
import Rules from '@/components/Rules.vue'
import PrizeInfo from '@/components/PrizeInfo.vue'
import JoinBar from '@/components/JoinBar.vue'
import JoinedAlert from '@/components/JoinedAlert.vue'
import InviteTip from '@/components/InviteTip.vue'
import JoinMember from '@/components/JoinMember.vue'
import store from '@/store/index.js'
import api from '@/util/api.js'
export default {
  name: 'App',
  data () {
    return {
      isShowInviteTips: false,
      store: store
    }
  },
  components: {
    HeadInfo,
    Customer,
    ImageInfo,
    Rules,
    PrizeInfo,
    JoinBar,
    JoinedAlert,
    InviteTip,
    JoinMember
  },
  mounted () {
    api.userInfo().then((data) => {
      console.log(data.data)
    })
  },
  methods: {
    closeInviteTip () {
      this.store.isShowInviteTips = false
    }
  }
}
</script>

<style>
* {
  margin: 0px;
  padding: 0px;
  box-sizing: border-box;
  margin-block-start: 0;
  margin-block-end: 0;
}
body {
  position: relative;
  max-width: 750px;
  margin: 0 auto;
}
.page {
  position: relative;
  max-width: 750px;
  margin: 0 auto;
  background-color: #eeeeee;
  margin-bottom: 160px;
}
ul, li {
  list-style: none;
}
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
.title {
  text-align: left;
  font-size: 36px;
  color: #333333;
  font-weight: 500;
}
.title2 {
  font-size: 32px;
}
.card {
  padding: 30px;
  background-color: #ffffff;
  margin-bottom: 12px;
}
hr {
  display: block;
  height: 0.5px;
  background-color: #999999;
}
.red-font {
  color: #f14a46;
}
.green-font {
  color: #009944;
}
</style>
