<template>
  <div class="modal" @click.self="$emit('close')">
    <div class="content">
        <h2 class="mb-2 font-semibold">Comments/Remarks(Rejection of Request Only)</h2>
        <select v-model="selectComment">
            <option value="Incomplete or Incorrect Information">Incomplete or Incorrect Information</option>
            <option value="Insufficient Requirements">Insufficient Requirement</option>
            <option value="Invalid or Expired Documentation">Invalid or Expired Documentation</option>
            <option value="Non-Compliance with Legal Requirements">Non-Compliance with Legal Requirements</option>
            <option value="Duplicate Request">Duplicate Request</option>
            <option value="Other Reasons">Other Reasons</option>
        </select><br><br>
        <textarea rows="4" v-model="comment" v-if="otherReasons"></textarea><br>
        <div class="flex space-x-4 m-auto w-fit">
            <button class="bg-slate-400 text-black p-2 w-32 rounded-md" @click="$emit('close')">Cancel</button>
            <button class="bg-red-500 text-white p-2 w-32 rounded-md" @click="confirmModal = true">Reject</button>
        </div>
    </div>
    <ConfirmationModal message="Oops! Made a mistake? Do you want to REJECT this request" @close="confirmModal = false" @yes="submit" v-if="confirmModal" />
    <Spin v-if="spinning" />
  </div>
</template>

<script>
export default {
    props:['details'],
    data(){
        return{
            selectComment:'',
            comment:'',
            otherReasons:false,
            confirmModal:false,
            spinning:false,
        }
    },
    watch:{
        selectComment(){
            if(this.selectComment == "Other Reasons"){
                this.comment = ""
                this.otherReasons = true
            }
            else{
                this.otherReasons = false
                this.comment = this.selectComment
            }
            console.log(this.comment);
        },
        async submit(){
            this.confirmModal = false
            this.spinning = true
            var params ={
                id: this.details.id,
                status: 'rejected',
                comment: this.comment,
                fee: this.details.document_fee
            }
            await this.$axios.put('/admin/request/update-status', params).then(response=>{
                this.$store.commit('trigger/updateRefreshRequestTable',this.$store.state.trigger.refreshRequestTable+1)
                this.$emit('rejected')
                this.spinning = false
            }).catch(err=>{
                this.$store.commit('trigger/updateRefreshRequestTable',this.$store.state.trigger.refreshRequestTable+1)
                this.$emit('rejected')
                this.spinning = false
            })
        }
    },
}
</script>

<style scoped>
select, option{
    @apply border border-black p-2
}

</style>