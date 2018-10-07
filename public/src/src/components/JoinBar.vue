<template>
  <div class="JoinBar">
    <p class="help-tips" v-if="store.helpNick && store.joinStatus === 0">
      <img :src="store.helpAvatar" />
      <span>{{ store.helpNick }}</span>
      <span>邀请你参与活动</span>
    </p>
    <img v-if="store.joinStatus === 0" v-on:click="joinHandle" src="../assets/join.png" />
    <img v-if="store.joinStatus === 1" v-on:click="shareHandle" src="../assets/invite.png" />
    <p>目前已邀请<span class="red-font">{{ store.inviteCount }}</span>位好友参与，你共有<span class="red-font">{{ store.winningRate }}%</span>机会中奖</p>
  </div>
</template>

<script>
import store from '@/store/index.js'
import api from '@/util/api.js'
export default {
  name: 'JoinBar',
  data () {
    return {
      store: store
    }
  },
  methods: {
    joinHandle () {
      api.userJoin().then((data) => {
        console.log(data.data)
        this.store.isShowJoinedAlert = true
        this.store.joinStatus = 1
      })
      if (this.store.helpUserId) {
        api.help({
          to_user_id: this.store.helpUserId
        }).then((data) => {
          console.log(data)
        })
      }
    },
    shareHandle () {
      this.store.isShowInviteTips = true
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
.JoinBar {
  position: fixed;
  bottom: 0px;
  width: 750px;
  background-color: #ffffff;
  box-shadow: 0px 0px 10px 0px #cecece;
  text-align: center;
  padding: 20px 0px;

  p {
    padding-top: 6px;
    font-size: 24px;
    color: #666666;
  }
  .help-tips {
    padding: 12px;
    img {
      vertical-align: middle;
      width: 48px;
      height: 48px;
    }
  }
}
</style>
