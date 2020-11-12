<template>
  <div class="container-fluid text-light vh-100 bg-secondary bg-gradient">
    <div class="row justify-content-center">
      <div class="col-10 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 align-self-center mt-6 shadow" style="padding: 45px">
        <form>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Acc</label>
            <input v-model="form.username" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input v-model="form.password" type="password" class="form-control" id="exampleInputPassword1">
          </div>
          <button v-if="isButton" @click.stop="login" type="submit" class="btn btn-primary">Submit</button>
          <button v-else class="btn btn-primary" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import {post} from '@/utilis/request'

export default {
  name: 'Login',
  data() {
    return {
      isButton: true,
      form: {
        username: '',
        password: '',
      }
    }
  },
  methods: {
    login() {
      this.isButton = false
      post('admin8341login',
          this.form,
          {headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}})
          .then(response => {
            if (response.status === 200) {
              this.$message('success', response.data.message)
              localStorage.setItem('admin_access_token', response.data.data.access_token)
              localStorage.setItem('admin_username', response.data.user.username)
              this.$router.push('/home')
            }
            this.isButton = true
          })
          .catch(error => {
            this.isButton = true
            this.$message('error', error)
          })
    }
  }
}
</script>

<style slot-scope="">

</style>
