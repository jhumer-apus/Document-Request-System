<template>
  <div class="modal" @click.self="$emit('closeModal')">
    <div class="content">
        <h1 class="text-3xl font-bold">REQUEST NO.{{renderID(details.id)}}</h1>
        <div class="grid grid-cols-3 gap-x-8">
            <div class="col-span-2">
                <div class="border-y border-slate-500 grid grid-cols-2">
                    <p>Full Name:</p>
                    <p class="font-semibold">{{details.first_name}} {{details.middle_name}} {{details.last_name}}</p>
                    <p>Age:</p>
                    <p class="font-semibold">{{getAge(details.birthdate)}}</p>
                    <p>Birthdate:</p>
                    <p class="font-semibold">{{details.birthdate}}</p>
                    <p>Sex/Gender:</p>
                    <p class="font-semibold">{{capitalize(details.sex)}}</p>
                    <p>Civil Status:</p>
                    <p class="font-semibold">{{capitalize(details.civil_status)}}</p>
                    <p>Complete Address:</p>
                    <p class="font-semibold">{{details.purok + ", " + details.barangay + ", " + details.municipality + ", " + details.province}}</p>
                    <p>Email:</p>
                    <p class="font-semibold">{{details.email}}</p>
                    <p>Mobile Number:</p>
                    <p class="font-semibold">{{details.mobile_number}}</p>
                </div><br>
                <h2>Requested Document</h2>
                <div class="p-4 border border-slate-500 mt-2 rounded-md">
                    <p>{{details.document_name}}</p>
                </div>
                
            </div>
            <div>
                <h2>Pick-up Schedule</h2>
                <div class="border border-blue-500 rounded-md p-2 flex items-center space-x-4 mt-2">
                    <font-awesome-icon :icon="['fas', 'calendar']" class="calendar-icon"/>
                    <div>
                        <p class="text-slate-500">Date</p>
                        <p class="font-semibold">{{getStringDate(details.schedule)}} {{details.meridiem}}</p>
                    </div>
                </div><br>
                <h2>Valid ID</h2>
                <div class="doc-container">
                    <div class="doc-wrapper">
                        <div class="flex items-center space-x-4 w-fit">
                            
                            <div v-if="details.id_type=='image/jpg' || details.id_type.split('/')[0] =='image'">
                                <font-awesome-icon :icon="['fas', 'image']" class="text-blue-500 icon" />
                            </div>
                            <div  v-if="details.id_type=='application/pdf' || details.id_type.split('/')[1] =='pdf'">
                                <font-awesome-icon :icon="['fas', 'file-pdf']" class="text-purple-500 icon" />
                            </div>

                            <p class="font-semibold">{{details.id_name}}</p>
                        </div>
                        <button class="view-file" @click="showFile(details.id_path, details.id_type)">View</button>
                    </div>
                    
                    <div v-if="details.id_type=='pdf'"></div>
                </div><br>
                <h2>Requirements/Prerequisite of Request</h2>
                <div class="doc-container" v-for="document in details.request_supporting_dcouments" :key="document.id">
                    <div class="doc-wrapper">
                        <div class="flex items-center space-x-4 w-fit">

                            <div v-if="document.type=='image/jpg' || document.type.split('/')[0] =='image'">
                                <font-awesome-icon :icon="['fas', 'image']" class="text-blue-500 icon" />
                            </div>
                            <div  v-if="document.type=='application/pdf' || document.type.split('/')[1] =='pdf'">
                                <font-awesome-icon :icon="['fas', 'file-pdf']" class="text-purple-500 icon" />
                            </div>

                            <p class="font-semibold">{{document.original_name}}</p>
                        </div>
                        <button class="view-file" @click="showFile(document.path, document.type)">View</button>
                    </div>
                </div>
            </div>
        </div>
        <h2>Purpose of Transaction</h2>
        <div class="bg-stone-200 p-4 rounded-md border border-stone-500 mt-2">
            {{details.purpose}}
        </div><br>
    </div>
    <ViewImage v-if="viewImage" :path="currentPath" @closeImage="viewImage=false"/>
    <Spin v-if="spinning"/>
  </div>
</template>

<script>
import moment from 'moment'
export default {
    props:['details'],
    emits:['closeModal'],
    data(){
        return{
            data:[],
            viewImage:false,
            comment:'',
            spinning:false,
        }
    },
    mounted(){

    },
    methods:{
        async submit(status,request_number, document_name){
            this.spinning =true
            var params = {
                id: this.details.id,
                status: status,
                comment:this.comment,
                document: this.details.document_name

            }
            await this.$axios.put('/admin/request/update-status',params).then(response=>{
                this.$store.commit('trigger/updateRefreshRequestTable',this.$store.state.trigger.refreshRequestTable+1)
                this.$emit('closeModal')
                this.spinning =false
            }).catch(err=>{
                this.$store.commit('trigger/updateRefreshRequestTable',this.$store.state.trigger.refreshRequestTable+1)
                this.$emit('closeModal')
                this.spinning =false
            })
        },
        async showFile(path,type){
            this.spinning = true
            var params={
                path:path
            }
            await this.$axios.get('/admin/request/get-file',{responseType: 'blob', params:params}).then(response=>{
                const blob = new Blob([response.data],{type: type})
                const objectUrl = window.URL.createObjectURL(blob)
                window.open(objectUrl);
                this.spinning = false
            })
        },
        renderID(id){
            const charID = id.toString()
            if(charID.length<6){
                const zerosToAdd = 6 - charID.length
                let stringID = ""
                for(let i = 0; i < zerosToAdd; i++){
                    stringID += "0"
                    
                }
                stringID = stringID + charID
                return stringID 
            }
            return id
        },
        getAge(birthdate){

                var today = new Date();
                var birthDate = new Date(birthdate);
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age;

        },
        capitalize(word){
            return word.charAt(0).toUpperCase() + word.slice(1)
        },
        getStringDate(date){
            return moment(date).format('MMMM DD, yyyy')
        }
    }
}
</script>

<style scoped>
h2{
    @apply font-semibold text-xl
}
.calendar-icon{
    font-size:40px;
    @apply text-sky-900
}
.doc-container{
    @apply p-2 border-slate-300 rounded-md border mt-2 flex items-center space-x-4 justify-between
}
.doc-wrapper{
    @apply flex items-center space-x-4 justify-between w-full
}
.view-file{
    @apply py-2 px-4 rounded-md bg-blue-500 text-white
}
.status-button{
    @apply py-2 w-36 rounded-md
}
.thumbs-icon{
    @apply text-2xl text-white
}
.status-wrapper{
    @apply flex items-center space-x-4 w-fit m-auto
}
.icon{
    font-size:30px;
}
</style>