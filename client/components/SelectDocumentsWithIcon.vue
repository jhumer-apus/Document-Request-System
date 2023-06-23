<template>
    <div class="px-20 pb-8">
        <h1>Select type of document you would like to request</h1>
        <p>You can choose more than one document request at a time</p><br>
        <div class="rounded-2xl py-8 px-16 grid grid-cols-2 gap-x-16">
            <button v-for="doc in documents" :key="doc.id" class="doc-button" @click="select(doc)" :class="{selected:$store.state.request.selectedDocument.id == doc.id}">
                <div class="rounded-full h-16 w-16 bg-red-500 relative"><font-awesome-icon :icon="['fas', 'file-invoice']"  class="file-icon"/></div>
                <p><b>{{doc.name}}</b></p>
            </button>
        </div>
        <p class="error">{{error}}</p>
        <Spin v-if="spinning"/>
    </div>
</template>

<script>
export default {
    props:["error"],
    data(){
        return{
            documents:[],
            spinning:false,
        }
    },
    mounted(){
        this.getDocuments()
    },
    methods:{
        select(document){
            this.$store.commit('request/updateSelectedDocuments', {
                selectedDocument: document,
            });
        },
        async getDocuments(){
            this.spinning = true
            await this.$axios.get('/user/request/documents').then(response=>{
                this.documents = response.data
                this.spinning = false
            }).catch(err=>{
                this.spinning = false
            })
        }
    }

}
</script>

<style scoped>
/* input[type=checkbox]{
    accent-color: yellow;
    @apply w-8 h-8 
}
input[type=checkbox]:after{
    border: solid white;
} */
h1{
  @apply text-3xl font-bold
}
input[type='radio'] { 
     transform: scale(1.5); 
 }
 .file-icon{
    font-size:30px;
    @apply text-white mt-4
 }
.doc-button{
    @apply flex items-center space-x-2 mt-4 bg-white rounded-lg p-4 border border-black
}

.selected{ 
    @apply border-red-700 bg-red-300 
}
</style>