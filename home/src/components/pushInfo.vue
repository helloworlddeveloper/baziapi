<template>
  <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 col-xxl-11">
    <div class="
    d-flex justify-content-between
     flex-wrap flex-md-nowrap align-items-center
      pt-4 pb-2 mb-3 border-bottom">
      <div style="width: 100%;">
        <h1 class="h3">
          pushInfo
          <span style="margin-left: 1rem; color: #dedfb2; font-size: 1.2rem">MessageTotal : {{ messageTotal }}</span>
          <div class="input-group" style="max-width: 330px; float: right">
            <input v-model="searchInput" type="text" class="form-control" placeholder="input item" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button @click="getData(data='')" :disabled="buttonDisabled" class="btn btn-outline-secondary bg-light" type="button" id="button-addon2">
              <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-arrow-repeat" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                <path fill-rule="evenodd"
                      d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
              </svg>
            </button>
            <span @click="add" class="control" style="color: white; margin-left: 1rem;margin-right: 1rem;">
            <svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-cloud-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                    d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
              <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
            </svg>
          </span>
          </div>
        </h1>
      </div>
    </div>

    <Progress :is-progress="isProgress"/>

    <div class="table-responsive" style="height: 81vh;">
      <table class="table table-hover text-white">
        <thead style="position: sticky;top: 0;background-color:#0e6e82;">
        <tr>
          <th width="5%">ID</th>
          <th width="5%">UID</th>
          <th width="5%">UType</th>
          <th width="10%">UName</th>
          <th width="15%">Title</th>
          <th width="15%">Message</th>
          <th width="10%">MType</th>
          <th width="8%">IsR</th>
          <th width="8%">IsRe</th>
          <th width="12%">STime</th>
          <th width="12%">RTime</th>
          <th width="12%">ReTime</th>
          <th width="12%">CTime</th>
          <th width="15%">Control</th>
        </tr>
        </thead>
        <tbody>
        <tr style="height: 3rem;line-height: 3rem;" v-for="(item,index) in this.messageData" :key="index">
          <th width="5%" class="text-truncate">{{ item.id }}</th>
          <td width="5%" class="text-truncate">{{ item.uid }}</td>
          <td width="5%" class="text-truncate">{{ item.usertype }}</td>
          <td width="10%" class="text-truncate">{{ item.bak_1 }}</td>
          <td width="15%" style="color: pink; font-weight: lighter" class="text-truncate">{{ item.title }}</td>
          <td width="15%" class="text-truncate">{{ item.message }}</td>
          <td width="10%" class="text-truncate">{{ item.message_type }}</td>
          <td width="8%" class="text-truncate">{{ item.isread }}</td>
          <td width="8%" class="text-truncate">{{ item.isrevoke }}</td>
          <td width="12%" class="text-truncate">{{ item.sendtime }}</td>
          <td width="12%" class="text-truncate">{{ item.readtime }}</td>
          <td width="12%" class="text-truncate">{{ item.revoketime }}</td>
          <td width="12%" class="text-truncate">{{ item.created_at }}</td>
          <td width="15%" class="text-truncate">
            <span class="control" @click="edit(item)">
              <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd"
                      d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
              </svg>
            </span>
            <span class="control" @click="del(item)" style="color: gainsboro">
              <svg width="1.7em" height="1.7em" viewBox="0 0 16 16" class="bi bi-x-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
              </svg>
            </span>
            <span class="control" @click="send(item)" style="color: greenyellow">
              <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-envelope" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
              </svg>
            </span>
          </td>
        </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="dialog" tabindex="-1" aria-hidden="true" style="top: 20%">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header text-dark">
            <h5 class="modal-title">{{ modalTitle }}</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>

          <div v-if="modalTitle==='Del Message'" class="modal-body bg-danger">
            <h5 class="p-3 mb-2 text-white text-center">此操作不可撤销，确定删除嘛？</h5>
          </div>

          <div v-else-if="modalTitle==='Send Message'" class="modal-body bg-danger">
            <h5 class="p-3 mb-2 text-white text-center">此操作不可撤销，确定发送嘛？</h5>
          </div>

          <div v-else class="modal-body text-dark" style="padding: 1rem 3rem 1rem 3rem">

            <div v-if="this.modalData.id" class="row">
              <label class="col-3 col-form-label">ID</label>
              <div class="col-9">
                <input disabled class="form-control" required v-model="modalData.id"/>
              </div>
            </div>

            <div class="row">
              <label class="col-3 col-form-label">信息类型</label>
              <div class="col-9">
                <select class="form-select" v-model="modalData.message_type">
                  <option selected v-text="modalData.message_type"></option>
                  <option>公共信息</option>
                  <option>私有信息</option>
                </select>
              </div>
            </div>

            <div v-if="this.privateShow" class="row">
              <label class="col-3 col-form-label">私有推送：用户ID</label>
              <div class="col-9">
                <input class="form-control" required v-model="modalData.uid"/>
              </div>
            </div>

            <div v-if="this.privateShow" class="row">
              <label class="col-3 col-form-label">私有推送：账号名称</label>
              <div class="col-9">
                <input class="form-control" required v-model="modalData.bak_1"/>
              </div>
            </div>

            <div class="row" v-if="this.modalData.isrevoke">
              <label class="col-3 col-form-label">是否撤销</label>
              <div class="col-9">
                <select class="form-select" v-model="modalData.isrevoke">
                  <option selected v-text="modalData.isrevoke"></option>
                  <option>默认显示</option>
                  <option>已撤销</option>
                </select>
              </div>
            </div>

            <div class="row">
              <label style="margin-top: 1rem; color: deeppink" class="col-3 col-form-label">信息标题</label>
              <div style="margin-top: 1rem" class="col-9">
                <input class="form-control" required v-model="modalData.title"/>
              </div>
            </div>

            <div class="row">
              <label class="col-3 col-form-label" style="color: deeppink">信息内容</label>
              <div class="col-9">
                <textarea class="form-control" v-model="modalData.message"></textarea>
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button v-if="isButton" type="button" class="btn btn-primary" @click="control">Submit</button>
            <button v-else class="btn btn-primary" type="button" disabled>
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Loading...
            </button>
          </div>

        </div>
      </div>
    </div>
  </main>
</template>

<script>
import {post} from "@/utilis/request";
import Progress from "@/common/Progress";

export default {
  name: "pushInfo",
  components: {Progress},
  data() {
    return {
      token: '',

      messageTotal: '',
      messageData: [],
      searchInput: '',

      modal: '',
      modalTitle: '',
      modalData: {
        uid: '',
        usertype: '',
        title: '',
        message: '',
        message_type: '',
        isread: '',
        isrevoke: '',
        sendtime: '',
        readtime: '',
        revoketime: '',
        bak_1: '',
      },

      privateShow: false,
      isButton: true,
      isProgress: false,
      buttonDisabled: false,
    }
  },
  watch: {
    'modalData.message_type': function () {
      this.privateShow = this.modalData.message_type === '私有信息';

      if (this.modalData.message_type === '公共信息') {
        this.modalData.uid = ''
        this.modalData.usertype = ''
        this.modalData.bak_1 = ''
      }

    },
  },
  created() {
    this.token = localStorage.getItem('admin_access_token')

    if (localStorage.getItem('messageData') === null) {
      this.messageData = []
      this.getData()
    } else {
      this.messageData = JSON.parse(localStorage.getItem('messageData'))
      this.messageTotal = localStorage.getItem('messageTotal')
    }
  },
  methods: {
    getData(data = '', url = 'msgAll') {
      this.isProgress = true
      this.buttonDisabled = true
      post('admin/' + url,
          data,
          {
            headers: {
              'Authorization': 'Bearer ' + this.token,
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            }
          })
          .then(response => {
            this.isProgress = false
            this.buttonDisabled = false
            if (response.status === 200) {
              if (data === '') {
                localStorage.setItem('messageData', JSON.stringify(response.data.data))
                this.messageData = JSON.parse(localStorage.getItem('messageData'))
                localStorage.setItem('messageTotal', response.data.total)
                this.messageTotal = localStorage.getItem('messageTotal')
              } else {
                this.modal.hide()
                this.getData()
              }
            }
            this.$message('success', response.data.message)
          })
          .catch(error => {
            this.isProgress = false
            this.buttonDisabled = false
            this.$message('error', error)
          })
    },

    add() {
      this.modalTitle = 'Add Message'
      this.modal.show()
    },

    edit(e) {
      this.modalTitle = 'Edit Message'

      this.modalData.id = e.id
      this.modalData.title = e.title
      this.modalData.message = e.message
      this.modalData.message_type = e.message_type
      this.modalData.uid = e.uid
      this.modalData.bak_1 = e.bak_1
      this.modalData.isrevoke = e.isrevoke

      this.modal.show()
    },

    del(e) {
      this.modalTitle = 'Del Message'
      this.modalData.id = e.id
      this.modal.show()
    },

    send(e) {
      this.modalTitle = 'Send Message'
      this.modalData.id = e.id
      this.modalData.uid = e.uid
      this.modalData.message_type = e.message_type
      this.modal.show()
    },

    control() {
      switch (this.modalTitle) {
        case "Add Message":
          this.addHandle()
          break
        case "Edit Message":
          this.editHandle()
          break
        case "Del Message":
          this.delHandle()
          break
        case "Send Message":
          this.sendHandle()
          break
      }
    },

    addHandle() {
      this.getData(this.modalData, 'msgAdd')
    },

    editHandle() {
      this.getData(this.modalData, 'msgEdit')
    },

    delHandle() {
      this.getData(this.modalData, 'msgDel')
    },

    sendHandle() {
      this.getData(this.modalData, 'msgSend')
    },
  },
  mounted() {
    this.$nextTick(function () {
          /* global bootstrap */
          this.modal = new bootstrap.Modal(document.getElementById('dialog'), {
            backdrop: 'static'
          })

          //关闭对话框
          var that = this
          var myModal = document.getElementById('dialog')
          myModal.addEventListener('hide.bs.modal', function () {
            that.modalData = {}
          })

          //获取User传过来的数据
          if (this.$store.state.message.uid) {
            this.modalData.uid = this.$store.state.message.uid
            this.modalData.bak_1 = this.$store.state.message.username
            this.modalData.usertype = this.$store.state.message.usertype
            this.modalData.message_type = '私有信息'
            this.add()
          }
        }
    )
  },
  beforeRouteLeave() {
    // const answer = window.confirm('Do you really want to leave? you have unsaved changes!')
    // if (!answer) return false
    this.$store.commit('messageMutations', {
      uid: '',
      username: '',
      usertype: '',
    })
    this.modal.hide()
  }
}
</script>

<style scoped>
.control {
  cursor: pointer;
  color: orange;
  margin-left: 1rem;
}

.del {
  color: red;
  display: none;
}

.row {
  margin: 1rem 0;
}

table thead, tbody tr {
  display: table;
  width: 100%;
  table-layout: fixed;
}

::-webkit-scrollbar {
  width: 3px;
  background-color: darkslategrey;
}

/* 滚动槽 */
::-webkit-scrollbar-track {
  border-radius: 50%
}

/* 滚动条滑块 */
::-webkit-scrollbar-thumb {
  border-radius: 50%;
  background: yellow;
}
</style>