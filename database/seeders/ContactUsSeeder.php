<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ContactUs;
use Illuminate\Database\Seeder;
use App\Notifications\ContactUsNotification;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
    
        // Get all admin users
        $admins = User::where('role', 'admin')->get();

        // Create 20 fake contact messages
        for ($i = 0; $i < 20; $i++) {
            $contact = ContactUs::create([
                'name'       => $faker->name,
                'email'      => $faker->unique()->safeEmail,
                'phone'      => $faker->phoneNumber,
                'subject'    => $faker->sentence(6),
                'message'    => $faker->paragraph(2),
                'ip_address' => $faker->ipv4,
                'status'     => 'pending', 
            ]);

            foreach ($admins as $admin) {
                $admin->notify((new ContactUsNotification($contact))->delay(now()));
                //* Mail won't be sent if your Notification class doesn't include "mail" in via()
            }
        }
    }
}
