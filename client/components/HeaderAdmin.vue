<template>
    <div class="sticky top-0 bg-red-600 pl-4 pr-8 flex justify-between items-center h-16 py-4 w-full">
        <div class="text-2xl">
            <font-awesome-icon :icon="['fas', 'bars']" size="lg" />
        </div>
        <div class="flex items-center">
            <img :src="getImgUrl()" class="rounded-full" width="50" height="50">
            <span class="text-xl ml-4">{{name}}</span>
        </div>
    </div>
  
</template>

<script>
export default {
    data(){
        return{
            name: this.$auth.state.user.first_name + " " + this.$auth.state.user.last_name,
            profilePicPath:""
        }
    },
    mounted(){
        this.getProfilePicture()
    },
    methods:{
        async getProfilePicture(){
            await this.$axios.get('/admin/profile-pic',{responseType: 'blob'}).then(response=>{
                const blob = new Blob([response.data],{type: "image/jpg"})
                const reader = new FileReader();
                reader.onload = (e) => {
                this.profilePicPath = e.target.result
                }
                reader.readAsDataURL(blob)
            })
        },
        getImgUrl(){
            let imgUrl = this.profilePicPath? this.profilePicPath: require("~/assets/images/Maranding_Logo.png")
        return imgUrl
      }
    }

}
</script>

<style>

</style>