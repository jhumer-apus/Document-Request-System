<template>
  <div class="modal" @click.self="$emit('closeModal')">
    <div class="content">
        <h1 class="text-3xl font-bold">REQUEST NO.{{renderID(details.id)}}</h1>
        <div class="grid grid-cols-3 gap-x-8">
            <div class="col-span-2">
                <div class="border-t border-slate-300 grid grid-cols-2">
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
                <h2>Purpose of Transaction</h2>
                <div class="bg-stone-200 p-4 rounded-md border border-stone-500 mt-2">
                    {{details.purpose}}
                </div><br>
            </div>
        </div>
        <hr class="w-full"><br>
        <div class="grid grid-cols-3 gap-x-8">
            <div class="col-span-2">
                <h1><b>Requested Document</b></h1>
                <div class="p-4 border flex justify-between border-slate-500 mt-2 items-center h-fit">
                    <p>{{details.document_name}}</p>
                    <button class="text-white bg-blue-400 py-2 px-4 rounded-md flex space-x-2 items-center" @click="$emit('viewDocument')" v-if="details.document_name!='Cedula'"><font-awesome-icon :icon="['fas', 'eye']" /><p>View</p></button>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-x-4 border border-slate-500 p-4">
                <h2>Particular</h2>
                <h2>Amount</h2>
                <p>{{details.document_name}}</p>
                <p>{{details.document_fee}}</p>
                <p><b>Total</b></p>
                <p>{{details.document_fee}}</p>

            </div>
        </div>
        <button class="flex items-center space-x-2 text-red-500 w-fit" @click="isMistake = true">
            <p>*Made a Mistake?</p><font-awesome-icon :icon="['fas', 'pen-to-square']"/>
        </button><br>
        <div class="m-auto flex w-fit space-x-4 items-center">
            <input type="checkbox" v-on:change="changeCheck" class="w-fit">
            <p>Document successfully printed</p>
        </div><br>
        <div class="w-fit m-auto space-x-4">
            <button class="bg-slate-300 p-2 w-32" @click="$emit('closeModal')">Cancel</button>
            <button class="bg-blue-500 p-2 w-32 text-white" @click="confirmModal = true">Complete</button>
        </div>
    </div>
    <RejectionModal v-if="isMistake" :details="details" @close="isMistake=false" @rejected="rejected"/>
    <ConfirmationModal message="Are you sure you want to mark this request as completed?" @close="confirmModal = false" @yes="complete" v-if="confirmModal" />
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
            currentPath:'',
            comment:'',
            spinning:false,
            selectComment:'',
            comment:'',
            confirmModal:false,
            isMistake:false

        }
    },
    mounted(){
    
    },
    methods:{
        changeCheck(e){
            if(e.target.checked){
                this.comment = "Document succesfully printed"
            }else{
                this.comment = ''
            }
        },
        async viewFile(filename){
            await this.$axios.get('/admin/request/get-pdf/'+filename,{responseType: 'blob'}).then(response=>{
                const blob = new Blob([response.data],{type: "application/pdf"})
                const objectUrl = window.URL.createObjectURL(blob)
                window.open(objectUrl);
            })
        },
        showImage(path){
            this.currentPath = path
            this.viewImage = true

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
        },
        async complete(){
            this.confirmModal = false
            this.spinning = true
            var params ={
                id: this.details.id,
                status: 'completed',
                comment: this.comment,
                document: this.details.document_name,
                fee: this.details.document_fee
            }
            await this.$axios.put('/admin/request/update-status', params).then(response=>{
                this.$store.commit('trigger/updateRefreshRequestTable',this.$store.state.trigger.refreshRequestTable+1)
                this.$emit('closeModal')
                this.spinning = false
            }).catch(err=>{
                this.$store.commit('trigger/updateRefreshRequestTable',this.$store.state.trigger.refreshRequestTable+1)
                this.$emit('closeModal')
                this.spinning = false
            })
        },
        rejected(){
            this.$emit('closeModal')
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

</style>