# Document-Request-System

Note: This system was created for the thesis purpose only. 3 college students hired me to create a system based on their topic.

# Description

The Document Request System is an innovative platform that allows users to conveniently request various Barangay documents from Barangay administrators without the need for in-person visits to the Barangay or municipal office. This streamlined process not only saves time but also minimizes physical contact, enhancing accessibility for residents. While certain documents may require specific prerequisites or identification, the system empowers administrators to efficiently review and approve or decline requests, ensuring the smooth and secure delivery of essential documents.

## Techstacks
1.Nuxt2 as frontend
2.Laravel as backend
3.MySQL as  dbms

# Setting up

## Requirements
1. Nodejs installed version 14-16
2. MySQL installed
3. Composer latest installed

## Installation

### Cloning 
1. Open terminal
2. Create a folder app_projects
3. Under app_ projects directory copy and paste https://github.com/jhumer-apus/Document-Request-System.git
4. Type "cd Document Request System"
   
### Frontend
1. Under Document Request System System type "cd client"
2. Setup env file you can use env sample file for your basis. Note configuration is challenging it requires experience/knowledge on a framework. Troubleshooting also is required. If need help contact the developer
3. Under client directory type "npm install"

### Backend
1. Under Document Request System System type "cd server"
2. Under server directory type "composer install"
3. Setup env file you can use env sample file for your basis. Note configuration is challenging it requires experience/knowledge on a framework. Troubleshooting also is required. If need help contact the developer
4. Type "php artisan migrate:fresh"
5. Type "php artisan db:seed"

## Running the system

### Frontend
1. Under client directory "npm run build"
2. After build type "npm run start"


### Backend
1. Under server directory "php artisan serve"
2. Open a new terminal and under server directory type "php artisan queue:work" this is for sending emails

Open the browser and type "localhost:3000"

Voila your system runs

Need help? You can contact the developer at https://www.facebook.com/jhumer.apus.1/


