<template>
  <nav id="sidebarMenu" class="col-md-3 col-lg-2 col-xxl-1 d-md-block bg-light sidebar collapse">
    <div class="position-sticky" style="margin-top: 63px">
      <div class="list-group" style="border-radius: 0;">
        <button
            v-for="(item,index) in list"
            :key="index"
            type="button"
            class="list-group-item list-group-item-action"
            :class="{'active':currentKey===item.key}"
            style="text-indent: 1rem"
            @click="to(item,index)"
        >
          {{ item.text }}
        </button>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "Side",
  data() {
    return {
      currentKey: '',
      list: [
        {text: '用户数据', to: 'userData', active: '', key: 0},
        {text: '命盘数据', to: 'mingpanData', active: '', key: 1},
        {text: '推送消息', to: 'pushInfo', active: '', key: 2},
        {text: '静态数据', to: 'System', active: '', key: 3},
        {text: '站内留言', to: 'Message', active: '', key: 4},
      ]
    }
  },
  watch: {
    '$route.name': function () {
      for (let i = 0; i < this.list.length; i++) {
        if (this.list[i].to === this.$route.name) {
          this.currentKey = this.list[i].key
        }
      }
    },
  },
  methods: {
    to(e, index) {
      this.$router.push({name: e.to})
      this.currentKey = index
    },
  },
  mounted() {
    for (let i = 0; i < this.list.length; i++) {
      if (this.list[i].to === this.$route.name) {
        this.currentKey = this.list[i].key
      }
    }
  }
}
</script>

<style scoped>
.list-group-item-action {
  height: 60px;
}
</style>