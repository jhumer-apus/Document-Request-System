<template>
  <div class="modal">
    <div class="content text-center">
        <h1>Confirmation Required</h1><br>  
        <font-awesome-icon :icon="['fas', 'circle-exclamation']" class="warning"/><br><br>
        <p>{{message}}</p><br>
        <div class="m-auto space-x-4">
            <button class="bg-slate-200 w-32 py-2 rounded-md" @click="$emit('close')">No</button>
            <button class="bg-green-500 text-white w-32 py-2 rounded-md" @click="$emit('yes')">Yes</button>
        </div>
    </div>
  </div>
</template>

<script>
export default {
    props:['message']

}
</script>

<style scoped>
.warning{
    font-size:90px;
    @apply text-red-600
}
h1{
    @apply text-2xl font-bold
}

</style>