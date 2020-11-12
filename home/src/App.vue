<template>
  <Message></Message>

  <router-view v-slot="{ Component }">
    <keep-alive include="Home,Login,userData,mingpanData">
      <component :is="Component"/>
    </keep-alive>
  </router-view>

</template>

<style lang="scss">
.fade-transform-leave-active,
.fade-transform-enter-active {
  transition: all 0.8s;
}

.fade-transform-enter {
  opacity: 0;
  transform: translatex(100%);
}

.fade-transform-leave-to {
  opacity: 0;
  transform: translatex(100%);
}

@import "~@/assets/main.css";
</style>
