<template>
  <div style="height: 6px">
    <div class="progress" style="height: 6px" v-show="isProgress">
      <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated"
           role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
           style="width: 100%"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Progress",
  props: {
    isProgress: Boolean,
  },
}
</script>

<style scoped>

</style>