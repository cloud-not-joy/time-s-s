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
    const userid = this.getQueryString('userid')
    if (userid) {
      this.store.helpNick = this.getQueryString('nick')
      this.store.helpUserId = userid
      this.store.helpAvatar = this.getQueryString('avatar')
    }
    api.userInfo().then((data) => {
      const code = data.data.code
      if (code !== 1) {
        window.location.href = `http://time.mimicpark.tech/api/user?callback=${encodeURIComponent(window.location.href)}`
        return
      }
      data = data.data.data
      this.store.joinStatus = Number(data.is_join)
      this.store.inviteCount = Number(data.help_num)
      this.store.userId = Number(data.user_id)
      this.store.nick = data.nickname
      this.store.avatar = data.avatar
      const rate = this.store.inviteCount * 0.025 + 0.025
      if (rate > 1) {
        this.store.winningRate = 100
      } else {
        this.store.winningRate = rate * 100
      }
      api.userShare({url: window.location.href.split('#')[0]}).then((data) => {
        const config = JSON.parse(data.data.data)
        console.log(config)
        window.wx.config(config)
        window.wx.ready(() => {
          window.wx.onMenuShareTimeline({
            title: '你的好友邀请你来抽取吃货福利',
            desc: '福利多多，机会多多',
            link: `http://time.mimicpark.tech/dist/index.html?nick=${encodeURIComponent(this.store.nick)}&userid=${this.store.userId}&avatar=${this.store.avatar}`,
            imgUrl: 'http://time.mimicpark.tech/image/timeshare.jpg'
          }, (res) => {
          })
          window.wx.onMenuShareAppMessage({
            title: '你的好友邀请你来抽取吃货福利',
            desc: '福利多多，机会多多',
            link: `http://time.mimicpark.tech/dist/index.html?nick=${encodeURIComponent(this.store.nick)}&userid=${this.store.userId}&avatar=${this.store.avatar}`,
            imgUrl: 'http://time.mimicpark.tech/image/timeshare.jpg'
          }, (res) => {
          })
          // window.wx.updateAppMessageShareData({
          //   title: '你的好友邀请你来抽取吃货福利',
          //   desc: '福利多多，机会多多',
          //   link: `http://time.mimicpark.tech/dist/index.html?nick=${this.store.nick}&userid=${this.store.userId}&avatar=${this.store.avatar}`,
          //   imgUrl: 'http://img0.ph.126.net/t3kXj_tyyoRvUaVB9yCMkQ==/1821987524348614419.jpg'
          // }, (res) => {
          // })
          // window.wx.updateTimelineShareData({
          //   title: '你的好友邀请你来抽取吃货福利',
          //   desc: '福利多多，机会多多',
          //   link: `http://time.mimicpark.tech/dist/index.html?nick=${this.store.nick}&userid=${this.store.userId}&avatar=${this.store.avatar}`,
          //   imgUrl: 'http://img0.ph.126.net/t3kXj_tyyoRvUaVB9yCMkQ==/1821987524348614419.jpg'
          // }, (res) => {
          // })
        })
      })
    })
    api.joinUsers().then((data) => {
      data = data.data
      if (data.code === 0) {
        return
      }
      this.store.joinedCount = data.count
      this.store.joinedList = data.data
      console.log(data)
    })
  },
  methods: {
    closeInviteTip () {
      this.store.isShowInviteTips = false
    },
    getQueryString (name) {
      var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)')
      var r = window.location.search.substr(1).match(reg)
      if (r != null) return unescape(r[2])
      return null
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
  font-size: 28px;
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
