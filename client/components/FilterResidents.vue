<template>
  <div class="space-x-8">
    <label>
        <input type="checkbox" v-model="filter" value="male" class="w-fit"/>
        Male
    </label>
    <label>
        <input type="checkbox" v-model="filter" value="female" class="w-fit"/>
        Female
    </label>
    <label>
        <input type="checkbox" v-model="filter" value="single" class="w-fit"/>
        Single
    </label>
    <label>
        <input type="checkbox" v-model="filter" value="married" class="w-fit"/>
        Married
    </label>
    <label>
        <input type="checkbox" v-model="filter" value="widow" class="w-fit"/>
        Widow
    </label>
    <label>
        <input type="checkbox" v-model="filter" value="separate" class="w-fit"/>
        Separate
    </label>
  </div>
</template>

<script>
export default {
    data(){
        return{
            filter:[]
        }
    }
}
</script>

<style>

</style>