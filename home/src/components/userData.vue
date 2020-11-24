<template>
  <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 col-xxl-11">
    <div class="
    d-flex justify-content-between
     flex-wrap flex-md-nowrap align-items-center
      pt-4 pb-2 mb-3 border-bottom bg-secondary"
         style="position:sticky; right: 0; top:64px; z-index: 200">
      <div style="width: 100%;">
        <h1 class="h3">
          userData
          <span style="margin-left: 1rem; color: #dedfb2; font-size: .9rem">总数 : {{ total }}</span>
          <span style="margin-left: 1rem; color: #dedfb2; font-size: .9rem">激活 : {{ activeTotal }}</span>
          <span style="margin-left: 1rem; color: #dedfb2; font-size: .9rem">受限 : {{ xTotal }}</span>
          <span style="margin-left: 1rem; color: white; font-size: .9rem">会员 : {{ membersTotal }}</span>
          <div class="input-group" style="max-width: 330px; float:right;">
            <input v-model="searchInput" type="text" class="form-control" placeholder="input something" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button @click="getData" :disabled="buttonDisabled" class="btn btn-outline-secondary bg-light" type="button" id="button-addon2">Search</button>
          </div>
        </h1>
      </div>
    </div>

    <Progress :is-progress="isProgress"/>

    <div class="table-responsive" style="height: 69vh;">
      <table class="table table-hover text-white">
        <thead style="position: sticky;top: 0;background-color:#0e6e82;">
        <tr>
          <th width="5%">ID</th>
          <th width="8%">Username</th>
          <th width="8%">Email</th>
          <th width="10%">IP</th>
          <th width="5%">Type</th>
          <th width="5%">Activity</th>
          <th width="10%">Title</th>
          <th width="5%">Total</th>
          <th width="8%">Ctime</th>
          <th width="8%">Utime</th>
          <th width="8%">Control</th>
        </tr>
        </thead>
        <tbody>
        <tr style="height: 3rem;line-height: 3rem"
            v-for="(item,index) in this.tableData" :key="index"
        >
          <th width="5%" class="text-truncate">{{ item.id }}</th>
          <td width="8%" class="text-truncate">{{ item.username }}</td>
          <td width="8%" class="text-truncate">{{ item.email }}</td>
          <td width="10%" class="text-truncate">{{ item.user_ip }}</td>
          <td width="5%" class="text-truncate">{{ item.user_type }}</td>
          <td width="5%" class="text-truncate">{{ item.is_activity }}</td>
          <td width="10%" class="text-truncate">{{ item.storage_3 }}</td>
          <td width="5%" class="text-truncate" style="color: pink; font-weight: lighter">{{ item.mingpantotal }}</td>
          <td width="8%" class="text-truncate">{{ item.created_at }}</td>
          <td width="8%" class="text-truncate">{{ item.updated_at }}</td>
          <td width="8%" class="text-truncate">
            <span class="control" @click="edit(item)">
              <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd"
                      d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
              </svg>
            </span>
            <span class="control" aria-disabled="true">
              <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-x-square del" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                <path fill-rule="evenodd"
                      d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
              </svg>
            </span>

            <span class="control" @click="pushMessage(item)" style="color: pink">
            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-chat-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                    d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
              <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
            </svg>
            </span>
          </td>
        </tr>
        </tbody>
      </table>
    </div>

    <nav aria-label="Page navigation example"
         style="margin-top: 2rem"
    >
      <ul class="pagination justify-content-center">
        <li
            v-for="(item,index) in links"
            :key="index"
            class="page-item"
            :class="{active:item.active}"
            @click="pagination(index)"
            :ref="'lis'+index"
        >
          <span style="cursor: pointer" class="page-link">
            <span v-html="item.label"></span>
          </span>
        </li>
      </ul>
    </nav>
    <!-- Modal -->
    <div class="modal fade" id="editDialog" tabindex="-1" aria-hidden="true" style="top: 20%">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header text-dark">
            <h5 class="modal-title">Edit UserData</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-dark" style="padding: 1rem 3rem 1rem 3rem">

            <div class="row">
              <label class="col-3 col-form-label">username</label>
              <div class="col-9">
                <input class="form-control" v-model="editModalData.username"/>
              </div>
            </div>

            <div class="row">
              <label class="col-3 col-form-label">email</label>
              <div class="col-9">
                <input class="form-control" v-model="editModalData.email"/>
              </div>
            </div>

            <div class="row">
              <label class="col-3 col-form-label">type</label>
              <div class="col-9">
                <select class="form-select" v-model="editModalData.user_type">
                  <option selected v-text="editModalData.user_type"></option>
                  <option>0</option>
                  <option>1</option>
                  <option>9</option>
                </select>
              </div>
            </div>

            <div class="row">
              <label class="col-3 col-form-label">activity</label>
              <div class="col-9">
                <select class="form-select" v-model="editModalData.is_activity">
                  <option selected v-text="editModalData.is_activity"></option>
                  <option>0</option>
                  <option>1</option>
                </select>
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button v-if="isButton" type="button" class="btn btn-primary" @click="editSave">Save changes</button>
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
  name: "userData",
  components: {Progress},
  data() {
    return {
      total: '',
      activeTotal: '',
      xTotal: '',
      membersTotal: '',
      searchInput: '',

      editModal: '',
      editModalData: {
        username: '',
        email: '',
        user_type: '',
        is_activity: '',
      },

      isButton: true,
      isProgress: false,
      buttonDisabled: false,
      tableData: [],
      token: '',

      page: '',
      links: '',
    }
  },
  created() {
    this.token = localStorage.getItem('admin_access_token')

    if (localStorage.getItem('admin_table_data') === null) {
      this.tableData = []
      this.getData()
    } else {
      this.tableData = JSON.parse(localStorage.getItem('admin_table_data'))
      this.total = localStorage.getItem('total')
      this.activeTotal = localStorage.getItem('activeTotal')
      this.xTotal = localStorage.getItem('xTotal')
      this.membersTotal = localStorage.getItem('membersTotal')
      this.links = JSON.parse(localStorage.getItem('userLinks'))
    }
  },
  methods: {
    pagination(index) {
      let arr = Object.keys(this.$refs);
      let i = arr[arr.length - 1]

      if (index !== 0 && index !== (this.links.length - 1)) {
        localStorage.setItem('userIndex', index)
        this.getData(index)
      } else if (index === 0) {
        this.page = parseInt(localStorage.getItem('userIndex')) - 1
        localStorage.setItem('userIndex', this.page)
        this.getData(this.page)
      } else if (index === (this.links.length - 1)) {
        this.page = parseInt(localStorage.getItem('userIndex')) + 1
        if (this.page >= (this.links.length - 1)) {
          this.page = (this.links.length - 2)
        }
        localStorage.setItem('userIndex', this.page)
        this.getData(this.page)
      }

      if (parseInt(localStorage.getItem('userIndex')) === 1) {
        this.$refs.lis0.style.display = 'none'
      } else {
        this.$refs.lis0.style.display = 'inline'
      }

      if (parseInt(localStorage.getItem('userIndex')) === (this.links.length - 2)) {
        this.$refs[i].style.display = 'none'
      } else {
        this.$refs[i].style.display = 'inline'
      }
    },
    getData(page) {
      if (typeof page !== "number") {
        page = localStorage.getItem('userIndex')
      }
      this.isProgress = true
      this.buttonDisabled = true
      post('admin/usersAll',
          {page: page, input: this.searchInput},
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
              localStorage.setItem('admin_table_data', JSON.stringify(response.data.data.data))
              this.tableData = JSON.parse(localStorage.getItem('admin_table_data'))

              localStorage.setItem('total', response.data.total)
              localStorage.setItem('activeTotal', response.data.activeTotal)
              localStorage.setItem('xTotal', response.data.xTotal)
              localStorage.setItem('membersTotal', response.data.membersTotal)

              this.total = localStorage.getItem('total')
              this.activeTotal = localStorage.getItem('activeTotal')
              this.xTotal = localStorage.getItem('xTotal')
              this.membersTotal = localStorage.getItem('membersTotal')

              localStorage.setItem('userLinks', JSON.stringify(response.data.data.links))
              this.links = JSON.parse(localStorage.getItem('userLinks'))
            }
            // this.$message('success', response.data.message)
          })
          .catch(error => {
            this.isProgress = false
            this.buttonDisabled = false
            this.$message('error', error)
          })
    },
    edit(e) {
      this.editModal.show()
      this.editModalData.id = e.id
      this.editModalData.username = e.username
      this.editModalData.email = e.email
      this.editModalData.user_type = e.user_type
      this.editModalData.is_activity = e.is_activity
    },
    editSave() {
      this.isButton = false
      post('admin/edit',
          {
            'id': this.editModalData.id,
            'username': this.editModalData.username,
            'email': this.editModalData.email,
            'user_type': this.editModalData.user_type,
            'is_activity': this.editModalData.is_activity,
          },
          {headers: {'Authorization': 'Bearer ' + this.token, 'Content-Type': 'application/json', 'Accept': 'application/json'}})
          .then(response => {
            if (response.status === 200) {
              this.getData()
              // this.$message('success', response.data.message)
              this.editModal.hide()
            }
            this.isButton = true
          })
          .catch(error => {
            this.isButton = true
            this.$message('error', error)
          })
    },
    pushMessage(e) {
      this.$store.commit('messageMutations', {
        uid: e.id,
        username: e.username,
        usertype: e.user_type,
      })
      this.$router.push({name: 'pushInfo'})
    },
  },
  mounted() {
    this.$nextTick(function () {
          /* global bootstrap */
          this.editModal = new bootstrap.Modal(document.getElementById('editDialog'), {
            backdrop: 'static'
          })
        }
    )
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