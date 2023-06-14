<template>
  <div class="main-container">
    <h1>Register Residents</h1>
    <SearchOnly
      @search="search"
      @changeSearch="changeSearch"
      placeholder="Search name(first name last name)"
    /><br>
    <FilterResidents @filter="filter" @changeValue="changeValue"/>
    <RegisterResidentsTable :data="data"/>
    <Pagination 
      :currentPage="currentPage"
      :lastPage="lastPage"
      @paginate="paginate"
    />
    <Spin v-if="spinning"/>
  </div>
</template>

<script>
import moment from 'moment'
export default {
    layout: 'admin',
    data(){
      return{
        data:[],
        currentPage: 1,
        lastPage:1,
        spinning:false,
        searchName:"",
        filterSex:[],
        filterCivilStatus:[]
      }
    },
    mounted(){
      this.fetchResidents(this.currentPage)
    },
    methods:{
      paginate(value){
        switch(value){
          case "prev":
            var pageNumber = this.currentPage-1
            break;
          case"next":
            var pageNumber = this.currentPage+1
            break;
          default:
            var pageNumber = this.currentPage
        }
        this.fetchResidents(pageNumber)
      },
      async fetchResidents(pageNumber){
        this.spinning = true
        var params = {
          search:this.searchName,
          sex:this.filterSex,
          civilStatus: this.filterCivilStatus

        }
        await this.$axios.get('/admin/residents/get-all-residents?page=' + pageNumber, {params}).then(response=>{
          this.data = response.data.data
          this.currentPage = response.data.current_page
          this.lastPage = response.data.last_page
          this.spinning = false
        }).catch(err=>{
          this.spinning = false
        })
      },
    filter(value){
      this.filterSex = value.sex
      this.filterCivilStatus = value.civilStatus
      this.currentPage = 1
      this.fetchResidents(this.currentPage)

    },
    search(value){
      this.searchName = value
      this.currentPage = 1
      this.fetchResidents(this.currentPage)
    },
    changeSearch(value){
      this.searchName = value
    },
    changeValue(value){
        this.filterSex = value.sex
        this.filterCivilStatus = value.civilStatus
    }
  },

}
</script>

<style scoped>
.main-container{
  @apply pt-12 px-12 pb-12 text-black min-h-screen
}
h1{
  @apply text-2xl font-bold text-black
}
.newRequest{
  @apply text-right text-lg text-sky-700 font-bold
}

</style>