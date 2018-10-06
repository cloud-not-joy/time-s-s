<template>
  <div class="JoinedAlert">
    <div class="mask">
      <div class="alert">
        <img class="star" src="../assets/start-icon.png" />
        <p class="title green-font">参与成功</p>
        <div class="tips">
          <p>你已获得1次抽奖机会</p>
          <p>每邀请1位好友参与，可增加2.5%的中将概率</p>
          <p>邀请39位好友参与，可直接获得本期奖品</p>
        </div>
        <img v-on:click="inviteHandle" class="invite" src="../assets/invite.png" />
        <div class="tips">
          <p>*中奖信息最迟于9月14日14点在本页面公布</p>
          <p>微信公众号同步推送</p>
          <p>公众号：木润公园</p>
        </div>
        <img v-on:click="closeHandle" class="close" src="../assets/close-icon.png" />
      </div>
    </div>
  </div>
</template>

<script>
import store from '@/store/index.js'
export default {
  name: 'JoinedAlert',
  data () {
    return {
      store: store
    }
  },
  methods: {
    inviteHandle () {
      this.store.isShowInviteTips = true
    },
    closeHandle () {
      this.store.isShowJoinedAlert = false
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
.JoinedAlert {
  position: fixed;
  top: 0px;
  left: 0px;
  right: 0px;
  bottom: 0px;
  .mask {
    position: absolute;
    top: 0px;
    left: 0px;
    right: 0px;
    bottom: 0px;
    background-color: rgba(0, 0, 0, 0.7);
  }
  .alert {
    position: absolute;
    text-align: center;
    width: 600px;
    background-color: #ffffff;
    border-radius: 20px;
    left: 50%;
    top: 50%;
    transform: translate3d(-50%, -50%, 0);
    font-size: 26px;
    color: #333333;
    padding-bottom: 30px;
  }
  .star {
    position: absolute;
    top: 0px;
    left: 50%;
    transform: translate3d(-50%, -50%, 0);
  }
  .title {
    margin-top: 100px;
    margin-bottom: 30px;
    text-align: center;
    font-size: 36px;
    font-weight: 500;
  }
  p {
    line-height: 1.67;
  }
  .invite {
    padding: 30px 0px;
  }
  .close {
    position: absolute;
    bottom: -100px;
    left: 50%;
    transform: translate3d(-50%, 0, 0);
  }
}
</style>
