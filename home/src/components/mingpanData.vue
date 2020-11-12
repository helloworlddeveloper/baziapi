<template>
  <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 col-xxl-11">
    <div class="
    d-flex justify-content-between
     flex-wrap flex-md-nowrap align-items-center
      pt-4 pb-2 mb-3 border-bottom bg-secondary"
         style="position:sticky; right: 0; top:64px; z-index: 200">
      <div style="width: 100%;">
        <h1 class="h3">
          mingPanData
          <span style="margin-left: 1rem; color: #dedfb2; font-size: 1.2rem">mingPanTotal : {{ mingPanTotal }}</span>
          <div class="input-group" style="max-width: 330px; float: right">
            <input v-model="searchInput" type="text" class="form-control" placeholder="input item" aria-label="Recipient's username" aria-describedby="button-addon2">
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
          <th width="5%">UID</th>
          <th width="5%">Owner</th>
          <th width="10%">Birthday</th>
          <th width="5%">Gender</th>
          <th width="7%">Name</th>
          <th width="7%">Call</th>
          <th width="10%">Born</th>
          <th width="6%">Area</th>
          <th width="15%">Type</th>
          <th width="15%">Desc</th>
          <th width="8%">Ctime</th>
          <th width="8%">Utime</th>
        </tr>
        </thead>
        <tbody>
        <tr style="height: 3rem;line-height: 3rem"
            v-for="(item,index) in this.mingPanTableData" :key="index"
        >
          <th width="5%" class="text-truncate">{{ item.id }}</th>
          <td width="5%" class="text-truncate">{{ item.user_id }}</td>
          <td width="5%" class="text-truncate">{{ item.owner[0].username }}</td>
          <td width="10%" style="color: pink; font-weight: lighter" class="text-truncate">{{ item.bak1 }}</td>
          <td width="5%" class="text-truncate">{{ item.sex }}</td>
          <td width="7%" class="text-truncate">{{ item.name }}</td>
          <td width="7%" class="text-truncate">{{ item.call }}</td>
          <td width="10%" class="text-truncate">{{ item.born }}</td>
          <td width="6%" class="text-truncate">{{ item.area }}</td>
          <td width="15%" class="text-truncate">{{ item.type }}</td>
          <td width="15%" class="text-truncate">{{ item.desc }}</td>
          <td width="8%" class="text-truncate">{{ item.created_at }}</td>
          <td width="8%" class="text-truncate">{{ item.updated_at }}</td>
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
  </main>
</template>

<script>
import {post} from "@/utilis/request";
import Progress from "@/common/Progress";

export default {
  name: "mingPanData",
  components: {Progress},
  data() {
    return {
      mingPanTotal: '',
      searchInput: '',

      isButton: true,
      isProgress: false,
      buttonDisabled: false,
      mingPanTableData: [],
      token: '',

      page: '',
      links: '',
    }
  },
  created() {
    this.token = localStorage.getItem('admin_access_token')

    if (localStorage.getItem('admin_mingPan_table_data') === null) {
      this.mingPanTableData = []
      this.getData()
    } else {
      this.mingPanTableData = JSON.parse(localStorage.getItem('admin_mingPan_table_data'))
      this.mingPanTotal = localStorage.getItem('mingPanTotal')
      this.links = JSON.parse(localStorage.getItem('links'))
    }
  },
  methods: {
    pagination(index) {
      let arr = Object.keys(this.$refs);
      let i = arr[arr.length - 1]

      if (index !== 0 && index !== (this.links.length - 1)) {
        localStorage.setItem('index', index)
        this.getData(index)
      } else if (index === 0) {
        this.page = parseInt(localStorage.getItem('index')) - 1
        localStorage.setItem('index', this.page)
        this.getData(this.page)
      } else if (index === (this.links.length - 1)) {
        this.page = parseInt(localStorage.getItem('index')) + 1
        if (this.page >= (this.links.length - 1)) {
          this.page = (this.links.length - 2)
        }
        localStorage.setItem('index', this.page)
        this.getData(this.page)
      }

      if (parseInt(localStorage.getItem('index')) === 1) {
        this.$refs.lis0.style.display = 'none'
      } else {
        this.$refs.lis0.style.display = 'inline'
      }

      if (parseInt(localStorage.getItem('index')) === (this.links.length - 2)) {
        this.$refs[i].style.display = 'none'
      } else {
        this.$refs[i].style.display = 'inline'
      }
    },
    getData(page) {
      if (typeof page !== "number") {
        page = localStorage.getItem('index')
      }
      this.isProgress = true
      this.buttonDisabled = true
      post('admin/mingPan',
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
              localStorage.setItem('admin_mingPan_table_data', JSON.stringify(response.data.data.data))
              this.mingPanTableData = JSON.parse(localStorage.getItem('admin_mingPan_table_data'))
              localStorage.setItem('mingPanTotal', response.data.total)
              this.mingPanTotal = localStorage.getItem('mingPanTotal')

              localStorage.setItem('links', JSON.stringify(response.data.data.links))
              this.links = JSON.parse(localStorage.getItem('links'))
            }
            this.$message('success', response.data.message)
          })
          .catch(error => {
            this.isProgress = false
            this.buttonDisabled = false
            this.$message('error', error)
          })
    },
  },
}
</script>

<style scoped>
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