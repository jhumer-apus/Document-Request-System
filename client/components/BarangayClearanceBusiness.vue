<template>
  <div>
        <img src="~/assets/images/DESIGN.jpg" class="block">
        <div class="absolute top-0 right-0 pt-4">
             <div class="flex items-center m-auto justify-around">
                <br>
                <div class="text-base text-white leading-tight">
                    <p>Republic of the Philippines</p>
                    <p>Province of Lanao Del Norte</p>
                    <p>Municipality of<b> Lala</b></p>
                    <p>Barangay <b>Maranding</b></p>
                </div>
                <br>
            </div>
            <div class="mt-16">
                <h1>BARANGAY CLEARANCE</h1>
                <h1 class="variation">(BUSINESS)</h1>
            </div>
            <div class="grid grid-cols-3 gap-x-8 bg-transparent mt-16">
                <div class="pl-16">
                    <div class="par">
                        <p class="officials_name">Hon. Jeoffy M.Fung</p>
                        <p>Punong Barangay</p>
                        <p>Commitee on Transportation, Peace and Order, Disaster Risk Reduction and Management</p>
                    </div>
                    <div class="par">
                        <p class="officials_name">Hon. Graciano S. Termis Jr.</p>
                        <p>Commitee on Agriculture &amp; on Environmental Management</p>
                    </div>
                    <div class="par">
                        <p class="officials_name">Hon. Roseller S. Fiel II</p>
                        <p>Commitee on Education, Cultures and Arts, Tourism, Information and Communication Technology</p>
                    </div>
                    <div class="par">
                        <p class="officials_name">Hon. Marites G. Procianos</p>
                        <p>Commitee on Finance, Appropriations, Ways and Means &amp; on Cooperative</p>
                    </div>
                    <div class="par">
                        <p class="officials_name">Hon. Lucky Jade G. de Guzman</p>
                        <p>Commitee on Health, Sanitation, and Solid Waste Management</p>
                    </div>
                    <div class="par">
                        <p class="officials_name">Hon. Arturo G. Arcillas</p>
                        <p>Commitee on Laws, Rules, Legislative Relation, Municipal and Barangay Affairs</p>
                    </div>
                    <div class="par">
                        <p class="officials_name">Hon. Peddy N. Baculao</p>
                        <p>Commitee on Economic Enterprises, &amp; Trade and Industry</p>
                    </div>
                    <div class="par">
                        <p class="officials_name">Hon. Allan S Guzman</p>
                        <p>Committee on Ways and Means, Women and Children</p>
                    </div>
                    <div class="par">
                        <p class="officials_name">Hon. John Michael Y Quilbrance</p>
                        <p>Committee on Youth, Sports Devleopment Games and Amusement</p>
                    </div>
                    <div class="par">
                        <p class="officials_name">Mr. Melvin C. Rabago</p>
                        <p>Barangay Treasurer</p>
                    </div>
                    <div class="par">
                        <p class="officials_name">Michelle Ann C. Masecampo</p>
                        <p>Barangay Secretary</p>
                    </div><br>
                    <div class="text-orange-500 italic font-bold text-sm">
                        Not valid with erasures and w/o Barangay Official Seal
                    </div>
                </div>

                <div class="col-span-2 text-justify pr-16 leading-normal">
                    <p class="par_content"><b>BUSINESS CLEARANCE</b> is hereby granted to {{user.full_name}}, {{getAge(user.birthdate)}} years old, {{capitalize(user.sex)}}, {{capitalize(user.civil_status)}} and is a bona-fide resident of {{user.purok}}, {{user.barangay}}, {{user.municipality}}, {{user.province}}, owner of the business named _____________________________________ located at Purok _________, Maranding, Lala, Lanao del Norte, upon payment of the required license fees, subject to provisions of existing laws, unless sooner revoked or canceled for</p><br>

                    <p class="par_content"><b>THIS CLEARANCE, </b>together with the official receipts issued by the office of the Barangay Treaurer shall be displayed in conspicuous place where the business is being conducted.</p><br>

                    <p class="par_content">Givin this <span class="font-bold">{{currentDate()}} day of {{currentMonth()}}, {{currentYear()}}</span> at Barangay Maranding, Lala, Lanao del Norte, Philippines</p><br>

                    <p></p>


                    <div class="w-fit ml-72">
                        <p>Approved by:</p>
                        <br>
                        <p class="underline font-bold">JEOFFY M. FUNG</p>
                        <p class="text-center">Punong Barangay</p>
                    </div>
                    <div class="printed-by">
                        Printed by: {{user.admin_name}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
import jsPDF from'jspdf'
import backgroundImage from '~/assets/images/Maranding_Logo.png'
export default {
    props:['user'],
 data(){
        return{
            spinning:false,
            // user:{
            //     full_name: 'Jhumer Ojales Apus',
            //     age:'23',
            //     sex: 'male',
            //     civil_status:'single',
            //     call_address:'Mr.',
            //     purok:'Purok-9',
            //     barangay:'Maranding',
            //     municipality:'Lala',
            //     province:'Lanao Del Norte',
            //     pronouns:'he',
            //     pronouns_second:'his',
            //     purpose:'scholarship',
            //     birthdate:'2000-02-22',
            //     birthplace:'Cubao, Quezon City',
            //     mothers_firstname:'Jeniza',
            //     mothers_middlename:'Ihan',
            //     mothers_lastname:'Ojales',
            //     fathers_firstname:'Rumer',
            //     fathers_middlename:'Dadole',
            //     fathers_lastname:'Apus'

            // }
        }
    },
mounted(){
    
},

methods:{
    getAge(birthdate){

        var today = new Date();
        var birthDate = new Date(birthdate);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;

    },
    capitalize(word){
        return word.charAt(0).toUpperCase() + word.slice(1)
    },
    currentMonth(){
        let month = new Date().getMonth()
        return moment(month+1,'M').format('MMMM')
    },
    currentDate(){
        let date = new Date().getDate()
        let suffix = this.nthNumber(date)
        return date+suffix
    },
    currentYear(){
        let year = new Date().getFullYear()
        return year
    },
    nthNumber(number){
        if (number > 3 && number < 21) return "th";
        switch (number % 10) {
            case 1:
            return "st";
            case 2:
            return "nd";
            case 3:
            return "rd";
            default:
            return "th";
        }
    },
}
}
</script>

<style scoped>

.officials_name{
    @apply font-semibold text-sky-700
}
h1{
    font-weight: 900;
    font-size:40px;
    @apply text-black text-center leading-tight
}
h2{
    @apply font-semibold
}
.par{
    font-size:11px;
    @apply m-auto mb-4 leading-tight; 
}
.par_content{
    @apply indent-10    
}
.thumb{
    @apply border border-black w-24 h-24
}
.variation{
    font-weight: 900;
    font-size:30px;
}
</style>