<template>
  <div class="float-right" style="cursor: pointer" @click="logout">
    <svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z"/>
      <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z"/>
    </svg>
  </div>
</template>

<script>
import {post} from "@/utilis/request";

export default {
  name: "Logout",
  methods: {
    logout() {
      post('admin/logout', {}, {
        headers: {
          'Authorization': 'Bearer ' + localStorage.getItem('admin_access_token'),
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        }
      })
          .then(response => {
            if (response.status === 200) {
              this.$message('success', response.data.message)
              localStorage.setItem('admin_access_token', '')
              this.$router.push('/')
            }
          })
          .catch(error => {
            this.$router.push('/')
            this.$message('error', error)
          })
    }
  }
}
</script>

<style scoped>

</style>