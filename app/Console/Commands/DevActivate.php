<?php

namespace App\Console\Commands;

use App\Models\Scopes\HideDevScope;
use App\Models\User;
use Illuminate\Console\Command;

class DevActivate extends Command
{
   protected $signature = 'dev:activate';
    protected $description = 'Recreate the dev account using your secret key';

    public function handle(): void
    {
        $this->info('Dev Account Activation');

        $secretKey = $this->secret('Enter your secret key');

        $filePath = storage_path('app/.dev');

        if (!file_exists($filePath)) {
            $this->error('❌ Credentials file not found. Run php artisan dev:setup first.');
            return;
        }

        $encrypted = file_get_contents($filePath);
        $credentials = DevSetup::decrypt($encrypted, $secretKey);

        if (!$credentials) {
            $this->error('❌ Wrong secret key or corrupted file.');
            return;
        }

        $exists = User::withoutGlobalScope(HideDevScope::class)
            ->where('role', 'dev')
            ->exists();

        if ($exists) {
            $this->warn('⚠️  Dev account already exists.');
            return;
        }

        User::withoutGlobalScope(HideDevScope::class)
            ->create([
                'firstName' => $credentials['firstName'],
                'lastName'  => $credentials['lastName'],
                'email'     => $credentials['email'],
                'password'  => bcrypt($credentials['password']),
                'role'      => 'dev',
            ]);

        $this->info('✅ Dev account recreated successfully.');
    }
}
