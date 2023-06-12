<template>
  <div id="pdf-content">
    Test
  </div>
  
  
</template>

<script>
import jsPDF from 'jspdf';
import imageBase64 from '~/assets/images/Maranding_Logo.png';
export default {
  mounted(){
    var loc = window.location.pathname;
    var dir = loc.substring(0, loc.lastIndexOf('/'));
    console.log("Current directory:", "../"+__dirname);
    this.$axios.post('/stored')
  }
}
</script>

<style scoped>
 
</style>