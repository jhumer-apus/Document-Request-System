<template>
    <div class="tooltip-container">
    <font-awesome-icon :icon="['fas', 'circle-question']" class="tooltip-icon"/>
    <div class="tooltip-text">
        <ul>
            <li v-for="(element,i) in data" :key="i">{{element}}</li>
        </ul>
    </div>
</div>
</template>

<script>
export default {
    props:["data"],

}
</script>

<style scoped>
.tooltip-icon{
    font-size:25px;
}
.tooltip-container{
    @apply w-fit relative flex items-center
}
.tooltip-container:hover .tooltip-text{
    @apply visible
}
.tooltip-text{
    left:105%;
    @apply absolute bg-slate-600 text-white px-8 rounded-lg z-10 invisible py-4
}
ul{
    @apply list-disc
}
li{
    @apply w-48
}

</style>