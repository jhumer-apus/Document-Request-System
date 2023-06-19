<template>
    <div class="bg-slate-100 min-h-screen pb-20 text-black">
        <div class="md:flex items-center text-xl space-x-8 w-fit m-auto my-16 text-slate-400 font-semibold">
            <span :class="{highlight:page==1}">Select Document</span>
            <font-awesome-icon :icon="['fas', 'angle-right']" />
            <span :class="{highlight:page==2}">Fill-out Request Form</span>
            <font-awesome-icon :icon="['fas', 'angle-right']" />
            <span :class="{highlight:page==3}">Schedule Pick-up Date</span>
            <font-awesome-icon :icon="['fas', 'angle-right']" />
            <span :class="{highlight:page==4}">Review &amp; Submit</span>
        </div>
        <SelectDocuments :error="errorPageOne" v-if="page==1"/>
        <RequestForm :error="errorPageTwo" v-if="page==2"/>
        <PickUpSchedule :error="errorPageThree" v-if="page==3"/>
        <ReviewRequest v-if="page==4"/>
        <RequestSaveSuccessful v-if="donePage" @requestAgain="done"/>
        <div class="m-auto mt-4 space-x-4 w-fit">
            <button class="bg-stone-500 text-white px-20 py-2 rounded-lg" v-if="page==1" @click="$router.push('/user/dashboard')">Cancel</button>
            <button class="bg-stone-500 text-white px-20 py-2 rounded-lg" v-if="page>1 && page<=4" @click="page--">Back</button>
            <button class="bg-red-500 text-white px-20 py-2 rounded-lg" v-if="page<4" @click="nextPage" >Next</button>
            <button class="bg-red-500 text-white px-20 py-2 rounded-lg" v-if="page==4" @click="submitRequest" :disabled="!this.$store.state.request.isCertify">Save</button>
        </div>
        <Spin v-if="spinning"/>
        <ConfirmationModal :message="'Confirm selected schedule '+appoinmentDate()+ ' '+$store.state.request.meridiem+'?'" @close="confirmModal = false" @yes="setPickUpDate" v-if="confirmModal" />
    </div>
</template>

<script>
import moment from 'moment'
export default {
    layout: 'user',
    data(){
        return{
            page:1,
            buttonStatus: "isButtonDisabled",
            errorPageOne:"",
            errorPageTwo:"",
            errorPageThree:"",
            spinning:false,
            donePage:false,
            confirmModal:false,
        }
    },
    mounted(){
            this.$store.commit('request/updateFormData', {
                formData: new FormData(),
            });
    },
    methods:{
        appoinmentDate(){
            let date = new Date(this.$store.state.request.selectedDate)
            return moment(date).format('MMMM DD, yyyy')
        },
        nextPage(){
            if(this.page==1){
                let selectedDocument = this.$store.state.request.selectedDocument
                if(!selectedDocument){
                    this.errorPageOne="Please select alteast one document to request"
                }
                else{
                    this.errorPageOne = ""
                    this.page++
                }
            }
            else if(this.page==2){
                let form = this.$store.state.request
                if(!form.purpose || !form.validIDName){
                    this.errorPageTwo="Please fill up the the missing fields"
                }
                else{
                    this.errorPageTwo = ""
                    this.page++
                }
            }
            else if(this.page==3){
                this.confirmModal = true

            }
        },
        setPickUpDate(){
            this.confirmModal = false
            let pickUpDate = this.$store.state.request
            if(!pickUpDate.selectedDate || !pickUpDate.meridiem){
                this.errorPageThree="Please select a date"
            }
            else{
                this.errorPageThree = ""
                this.page++
            }

        },
        async submitRequest(){
            this.spinning = true
            await this.$axios.post('/user/request/submit-request', this.$store.state.request.formData).then(response=>{
                this.donePage = true
                this.spinning = false
            }).catch(err=>{
                console.log(err)
                this.spinning = false
            })
        },
        done(){
            this.page = 1
            this.donePage = false
        }
    }
}
</script>

<style scoped>
h1{
  @apply text-3xl font-bold
}
.highlight{
  @apply text-black
}

</style>