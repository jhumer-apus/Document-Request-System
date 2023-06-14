<template>
  <div class="search-container">
        <font-awesome-icon :icon="['fas', 'magnifying-glass']" />
        <input type="text" v-model="searchValue"  :placeholder="placeholder" @keyup.enter="$emit('search',searchValue)">
  </div>
</template>

<script>
export default {
    emits:['search'],
    props:['placeholder'],
    data(){
        return{
            searchValue:"",
        }
    },
    watch:{
        searchValue(){
            this.$emit("changeSearch",this.searchValue)
        }
    }
}
</script>

<style scoped>

.search-container{
    @apply py-2 px-4 rounded-xl bg-white shadow-xl text-lg flex text-black items-center
}
.search-container > input{
    @apply focus:outline-none border-none w-full
}
</style>