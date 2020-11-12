<template>
  <transition name="slide-fade">
    <div class="alert alert-primary fixed-top shadow" role="alert"
         style="max-width:330px; margin: 0 auto; top:30px; z-index: 1999;"
         :class="color"
         v-if="isShow"
    >
      {{ message }}
    </div>
  </transition>
</template>

<script>
export default {
  name: "Message",
  computed: {
    isShow: {
      get() {
        return this.$store.state.alert.isShow
      },
      set(v) {
        this.$store.commit('alertMuta', {isShow: v})
      }
    },
    color: {
      get() {
        return this.$store.state.alert.color
      },
      set(v) {
        this.$store.commit('alertMuta', {color: v})
      }
    },
    message: {
      get() {
        return this.$store.state.alert.message
      },
      set(v) {
        this.$store.commit('alertMuta', {message: v})
      }
    },
    icon: {
      get() {
        return this.$store.state.alert.icon
      },
      set(v) {
        this.$store.commit('alertMuta', {icon: v})
      }
    },
  },
  mounted() {
    //把组件加载到BODY，切换页面的时候还会有提示
    this.$nextTick(() => {
      const body = document.querySelector("body");
      if (body.append) {
        body.append(this.$el);
      } else {
        body.appendChild(this.$el);
      }
    });
  }
}
</script>
<style slot-scope="">
.slide-fade-enter-active {
  transition: all 0.25s ease-out;
  transform: translateZ(0);
}

.slide-fade-leave-active {
  transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
  transform: translateZ(0);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translatey(-15px);
  opacity: 0;
}
</style>