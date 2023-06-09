<template>
    <div class="md:px-20 md:pb-4">
        <h1>Complete the Request Form</h1>
        <p class="font-medium">Make sure to not leave any field blank</p><br>
        <form class="w-full" @submit.prevent=""> 
            <div class="detail-container col-span-2">
                <p class="label">Full Name<span class="guide"> (First Name M.I. Last Name)</span></p>
                <div class="box">
                    {{data.first_name + " " + data.middle_initial + ". " + data.last_name}}
                </div>
            </div>
            <div class="detail-container">
                <p class="label">Age</p>
                <div class="box">
                    {{getAge(data.birthdate)}}
                </div>
            </div>
            <div class="detail-container">
                <p class="label">Birthdate <span class="guide">(yyyy-mm-dd)</span></p>
                <div class="box">
                    {{data.birthdate}}
                </div>
            </div>
            <div class="detail-container col-span-2">
                <p class="label">Complete Address<span class="guide"> (Street/Purok, Barangay, City/Municipality, Province)</span></p>
                <div class="box">
                    {{data.purok + ", " + data.barangay + ", " + data.municipality + ", " + data.province}}
                </div>
            </div>
            <div class="detail-container">
                <p class="label">Email</p>
                <div class="box">
                    {{data.email}}
                </div>
            </div>
            <div class="detail-container">
                <p class="label">Mobile Number</p>
                <div class="box">
                    {{data.mobile_number}}
                </div>
            </div>
            <label class="col-span-2">
                Purpose of Request
                <textarea class="mt-4 font-normal" v-model="purposeOfRequest" rows="6"></textarea>
            </label>
            <div class="detail-container col-span-2">
                <p class="label">Supporting Documents</p>
                <span class="guide">Upload photo/scanned copy of your supporting documents.</span>
            </div>
            <div class="flex items-center space-x-4 w-fit col-span-2">
                <label>
                    Valid ID <span class="guide">(Valid types are <b>jpg</b> and <b>png</b>)</span>
                </label>
                <Tooltip :data="idList"/>
            </div>
            <UploadFiles :limit="1" :isRequired="true" @passFiles="passID" id="forID" class="col-span-2"/>
            <div class="flex items-center space-x-4 w-fit col-span-2">
                <label>
                    Requirement/Prerequisite of Request <span class="guide">(Valid types are <b>jpg</b>, <b>png</b>, and <b>pdf</b>)</span>
                </label>
                <Tooltip :data="requirements"/>
            </div>
            <UploadFiles :limit="5" :isRequired="false" @passFiles="passDocuments" id="forDocuments" class="col-span-2"/>
            <p class="error">{{error}}</p>
        </form>
        <Spin v-if="spinning"/>
    </div>
</template>

<script>

export default {
    props:["error"],
    data(){
        return{
            data:'',
            purposeOfRequest:'',
            validID:'',
            supportingDocuments:'',
            requirements:[],
            spinning:false,
            idList:["Philippine Passport","Voter's ID","Driver's License","PRC License", "SSS ID", "GSIS UMID","Postal ID","School ID","TIN ID", "PhilHealth ID", "Senior Citizen ID"],
            requirements:""
        }
    },
    mounted(){
        this.getUser()
        switch(this.$store.state.request.selectedDocument.name){
            case "Barangay Clearance":
                this.requirements = ["Purok Clearance","Cedula"]
                break
            case "Barangay Permit":
                this.requirements = ["Cedula"]
                break
            case "Barangay Business Clearance":
                this.requirements = ["Purok Clearance","Barangay Clearance","Cedula"]
                break
            case "Certificate of Residency":
                this.requirements = ["Purok Clearance","Cedula"]
                break
            case "Certificate of Indigency":
                this.requirements = ["Purok Clearance","Ceddula"]
                break
            case "Cedula":
                this.requirements = ["Barangay Clearance"]
                break
            default:
                this.requirements = ["None"]
                break
        }
    },
    watch:{
        purposeOfRequest(){
            this.$store.commit('request/updatePurposeOfRequest', {
                purpose:this.purposeOfRequest
            });
        },
    },
    methods:{
        async getUser(){
            this.spinning = true
            await this.$axios.get('/user/get-details').then(response=>{
                this.data = response.data
                this.data.middle_initial = response.data.middle_name[0]
                this.$store.commit('request/updateForm', {
                    form: {
                        name: this.data.first_name + " " + this.data.middle_initial + ". " + this.data.last_name,
                        age: this.getAge(this.data.birthdate),
                        birthdate: this.data.birthdate,
                        address: this.data.purok + ", " + this.data.barangay + ", " + this.data.municipality + ", " + this.data.province,
                        email:this.data.email,
                        mobile_number:this.data.mobile_number,
                        sex:this.data.sex,
                        civil_status: this.data.civil_status
                    },
                });
                this.spinning = false
            }).catch(err=>{
                this.spinning = false
            })
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
        passID(files){
            this.validID = files[0]
            this.$store.commit('request/updateValidID', {
                validID: this.validID?this.validID:'',
                validIDName:this.validID? this.validID.name: ''
            });
        },

        passDocuments(files){
            this.supportingDocuments = files
            let supportingDocumentsName = []
            Object.keys(this.supportingDocuments).forEach((key, index) =>
                {
                    let name = this.supportingDocuments[key].name;
                    supportingDocumentsName.push(name)
                });
            this.$store.commit('request/updateSupportingDocuments', {
                supportingDocuments: this.supportingDocuments,
                supportingDocumentsName: supportingDocumentsName,
                numberOfSupportingDocuments: this.supportingDocuments.length
            });

        },
    }

}
</script>

<style scoped>
.label, label{
    @apply font-semibold text-xl
}
.guide{
    @apply text-slate-400 font-normal text-xl
}
.box{
    @apply py-2 px-4 border border-black rounded-lg mt-4 text-xl
}
form{
    @apply grid grid-cols-2 gap-4 bg-white p-8 md:rounded-xl
}
.detail-container{
    @apply mb-4
}
h1{
  @apply text-3xl font-bold
}
form{
    @apply w-full
}

</style>