<template>
  <div class="modal">
      <div class="container">
      <h1>Request Submitted</h1><br>
      <font-awesome-icon :icon="['fas', 'circle-check']" class="check-icon"/><br><br>
      <p>Your request has been submitted!</p><br>
      <div class="w-fit m-auto">
            <button class="bg-red-500 text-white text-3xl px-24 py-2 text-center rounded-xl" @click="$router.push('/user/dashboard')">Done</button>
      </div><br>
      <p @click="$emit('requestAgain')" class="link">Request another document</p>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>
h1{
  @apply text-sky-900 text-3xl font-bold
}
p{
  @apply text-slate-500
}
.container{
  @apply m-auto w-fit text-center md:mt-48 bg-white py-20 md:px-32 rounded-xl
}
.check-icon{
  font-size:100px;
  @apply text-green-500
}
.link{
  @apply text-blue-500 cursor-pointer text-blue-500
}
</style>