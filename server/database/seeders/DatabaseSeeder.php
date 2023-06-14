<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use App\Models\Document;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'email' => 'user@edokumento.com',
            'first_name' => 'User',
            'middle_name' => 'User',
            'last_name' => 'User',
            'birthdate' => '2000-02-22',
            'sex' => 'male',
            'civil_status' => 'single',
            'suffix' => '',
            'citizenship' => 'Filipino',
            'mobile_number' => '09751304307',
            'purok' => '',
            'barangay' => '',
            'municipality' => '',
            'province' => '',
            'zip_code' => '',
            'mothers_firstname' => 'User',
            'mothers_middlename' => 'User',
            'mothers_lastname' => 'User',
            'fathers_firstname' => 'User',
            'fathers_middlename' => 'User',
            'fathers_lastname' => 'User',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);
        User::create([
            'email' => 'user1@edokumento.com',
            'first_name' => 'User 1',
            'middle_name' => 'User 1',
            'last_name' => 'User 1',
            'birthdate' => '2000-02-22',
            'sex' => 'male',
            'civil_status' => 'single',
            'suffix' => '',
            'citizenship' => 'Filipino',
            'mobile_number' => '09751304307',
            'purok' => '',
            'barangay' => '',
            'municipality' => '',
            'province' => '',
            'zip_code' => '',
            'mothers_firstname' => 'User',
            'mothers_middlename' => 'User',
            'mothers_lastname' => 'User',
            'fathers_firstname' => 'User',
            'fathers_middlename' => 'User',
            'fathers_lastname' => 'User',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);

        User::create([
            'email' => 'user2@edokumento.com',
            'first_name' => 'User 2',
            'middle_name' => 'User 2',
            'last_name' => 'User 2',
            'birthdate' => '2000-02-22',
            'sex' => 'male',
            'civil_status' => 'single',
            'suffix' => '',
            'citizenship' => 'Filipino',
            'mobile_number' => '09751304307',
            'purok' => '',
            'barangay' => '',
            'municipality' => '',
            'province' => '',
            'zip_code' => '',
            'mothers_firstname' => 'User',
            'mothers_middlename' => 'User',
            'mothers_lastname' => 'User',
            'fathers_firstname' => 'User',
            'fathers_middlename' => 'User',
            'fathers_lastname' => 'User',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);

        User::create([
            'email' => 'user3@edokumento.com',
            'first_name' => 'User 3',
            'middle_name' => 'User 3',
            'last_name' => 'User 3',
            'birthdate' => '2000-02-22',
            'sex' => 'male',
            'civil_status' => 'single',
            'suffix' => '',
            'citizenship' => 'Filipino',
            'mobile_number' => '09751304307',
            'purok' => '',
            'barangay' => '',
            'municipality' => '',
            'province' => '',
            'zip_code' => '',
            'mothers_firstname' => 'User',
            'mothers_middlename' => 'User',
            'mothers_lastname' => 'User',
            'fathers_firstname' => 'User',
            'fathers_middlename' => 'User',
            'fathers_lastname' => 'User',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);

        //admin
        Admin::create([
            'email' => 'admin@edokumento.com',
            'first_name' => 'Admin',
            'middle_name' => 'Admin',
            'last_name' => 'Admin',
            'birthdate' => '2000-02-22',
            'sex' => 'male',
            'civil_status' => 'single',
            'suffix' => '',
            'position' => 'Admin',
            'citizenship' => 'Filipino',
            'mobile_number' => '09751304307',
            'purok' => '',
            'barangay' => '',
            'municipality' => '',
            'province' => '',
            'zip_code' => '',
            'mothers_firstname' => 'Admin',
            'mothers_middlename' => 'Admin',
            'mothers_lastname' => 'Admin',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);

        Admin::create([
            'email' => 'admin1@edokumento.com',
            'first_name' => 'Admin 1',
            'middle_name' => 'Admin 1',
            'last_name' => 'Admin 1',
            'birthdate' => '2000-02-22',
            'sex' => 'male',
            'civil_status' => 'single',
            'suffix' => '',
            'position' => 'Admin',
            'citizenship' => 'Filipino',
            'mobile_number' => '09751304307',
            'purok' => '',
            'barangay' => '',
            'municipality' => '',
            'province' => '',
            'zip_code' => '',
            'mothers_firstname' => 'Admin',
            'mothers_middlename' => 'Admin',
            'mothers_lastname' => 'Admin',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);
        Admin::create([
            'email' => 'admin2@edokumento.com',
            'first_name' => 'Admin 2',
            'middle_name' => 'Admin 2',
            'last_name' => 'Admin 2',
            'birthdate' => '2000-02-22',
            'sex' => 'male',
            'civil_status' => 'single',
            'suffix' => '',
            'position' => 'Admin',
            'citizenship' => 'Filipino',
            'mobile_number' => '09751304307',
            'purok' => '',
            'barangay' => '',
            'municipality' => '',
            'province' => '',
            'zip_code' => '',
            'mothers_firstname' => 'Admin',
            'mothers_middlename' => 'Admin',
            'mothers_lastname' => 'Admin',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);
        Admin::create([
            'email' => 'admin3@edokumento.com',
            'first_name' => 'Admin 3',
            'middle_name' => 'Admin 3',
            'last_name' => 'Admin 3',
            'birthdate' => '2000-02-22',
            'sex' => 'male',
            'civil_status' => 'single',
            'suffix' => '',
            'position' => 'Admin',
            'citizenship' => 'Filipino',
            'mobile_number' => '09751304307',
            'purok' => '',
            'barangay' => '',
            'municipality' => '',
            'province' => '',
            'zip_code' => '',
            'mothers_firstname' => 'Admin',
            'mothers_middlename' => 'Admin',
            'mothers_lastname' => 'Admin',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);
        

        Document::create([
            'name'=>'Cedula',
            'description' => 'Lorem ipsum',
            'fee' => 35.00
        ]);

        Document::create([
            'name'=>'Barangay Permit',
            'description' => 'Lorem ipsum',
            'fee' => 00.00
        ]);

        Document::create([
            'name'=>'Barangay Clearance',
            'description' => 'Lorem ipsum',
            'fee' => 100.00
        ]);

        Document::create([
            'name'=>'Barangay Business Clearance',
            'description' => 'Lorem ipsum',
            'fee' => 330.00
        ]);

        Document::create([
            'name'=>'Certificate of Residency',
            'description' => 'Lorem ipsum',
            'fee' => 00.00
        ]);

        Document::create([
            'name'=>'Certificate of Indigency',
            'description' => 'Lorem ipsum',
            'fee' => 00.00
        ]);
    
    }
}
