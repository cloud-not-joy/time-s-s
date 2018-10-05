<template>
  <div class="InviteTip" v-on:click="closeHandle">
    <div class="mask"></div>
    <img class="tip" src="../assets/share-tip.png" />
  </div>
</template>

<script>
export default {
  name: 'JoinBar',
  data () {
    return {
    }
  },
  props: [
    'close'
  ],
  methods: {
    closeHandle () {
      this.close()
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
.InviteTip {
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
  .tip {
    position: absolute;
    top: 30px;
    right: 80px;
  }
}
</style>
