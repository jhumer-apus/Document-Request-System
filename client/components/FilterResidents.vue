<template>
  <div class="space-x-8">
    <label>
        <input type="checkbox" v-model="sex" value="male" class="w-fit"/>
        Male
    </label>
    <label>
        <input type="checkbox" v-model="sex" value="female" class="w-fit"/>
        Female
    </label>
    <label>
        <input type="checkbox" v-model="civilStatus" value="single" class="w-fit"/>
        Single
    </label>
    <label>
        <input type="checkbox" v-model="civilStatus" value="married" class="w-fit"/>
        Married
    </label>
    <label>
        <input type="checkbox" v-model="civilStatus" value="widow" class="w-fit"/>
        Widow
    </label>
    <label>
        <input type="checkbox" v-model="civilStatus" value="separate" class="w-fit"/>
        Separate
    </label>
    <button class="py-1 px-4 rounded-md bg-yellow-500 text-white" @click="filter">Search</button>
  </div>
</template>

<script>
export default {
    data(){
        return{
            sex:[],
            civilStatus:[]
        }
    },
    methods:{
        filter(){
            let value = {
                sex:this.sex,
                civilStatus:this.civilStatus
            }
            this.$emit("filter",value)
        }
    },
    watch:{
        sex(){
            let value = {
                sex:this.sex,
                civilStatus:this.civilStatus
            }
            this.$emit("changeValue",value)
        },
        civilStatus(){
            let value = {
                sex:this.sex,
                civilStatus:this.civilStatus
            }
            this.$emit("changeValue",value)
        }
    }
}
</script>

<style>

</style>