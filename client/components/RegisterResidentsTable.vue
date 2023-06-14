<template>
  <div>
    <table class="table-history">
        <thead class="border-y text-left">
            <th>Full Name</th>
            <th>Registration Date</th>
            <th>Sex</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Address</th>
        </thead>
   
    <tr v-for="resident in data" :key="resident.id" class="cursor-pointer" @click="showModal(resident.id)">
        <td>{{resident.first_name}} {{resident.middle_name}} {{resident.last_name}}, </td>
        <td>{{wordDate(resident.email_verified_at)}}</td>
        <td>{{capitalize(resident.sex)}}</td>
        <td>{{resident.mobile_number}}</td>
        <td>{{resident.email}}</td>
        <td>{{resident.purok+", "+resident.barangay+", "+resident.municipality+", "+resident.province}}</td>
    </tr>

    </table>
    <ShowResidentDetailsModal v-if="showInfo" :resident_id="resident_id"/>
  </div>
</template>

<script>
import moment from 'moment'
export default {
    props:['data'],
    data(){
        return{
            showInfo:false,
            resident_id:""
        }
    },
    methods:{
        capitalize(word){
            return word.charAt(0).toUpperCase() + word.slice(1)
        },
        wordDate(date){
          return moment(date).format('MMMM d, YYYY');
        },
        showModal(id){
            this.resident_id=id
            this.showInfo = true

        }
    }

}
</script>

<style scoped>
table{
    border-collapse: separate;
    border-spacing: 0 8px; 
    @apply w-full
}
th{
    @apply p-8
}
tr{
    background:white;
}
td{
    @apply w-fit p-8
}
.pending{
    @apply bg-yellow-400 w-fit text-white px-8 py-2 rounded-2xl
}
.rejected{
    @apply bg-red-500 w-fit text-white px-8 py-2 rounded-2xl
}
.approved{
    @apply bg-green-400 w-fit text-white px-8 py-2 rounded-2xl
}
.completed{
    @apply bg-blue-500 w-fit text-white px-8 py-2 rounded-2xl
}
.processing{
    @apply bg-stone-500 w-fit text-white px-8 py-2 rounded-2xl
}
</style>