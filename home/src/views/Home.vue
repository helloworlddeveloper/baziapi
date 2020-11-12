<template>
  <Head/>
  <div class="container-fluid text-light bg-secondary">
    <div class="row">
      <Side/>
      <home-index v-if="$route.name==='Home'"/>
      <router-view/>
    </div>
  </div>
</template>

<script>
import Head from "@/components/Head";
import Side from "@/components/Side";
import HomeIndex from "@/components/homeIndex";

export default {
  name: "Home",
  components: {HomeIndex, Side, Head}
}
</script>

<style scoped>
.container-fluid {
  margin: 0;
  padding: 0;
  position: relative
}
</style>