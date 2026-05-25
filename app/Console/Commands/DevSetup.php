<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DevSetup extends Command
{
    protected $signature = 'dev:setup';

    protected $description = 'Setup the Dev account credentials (encrypted)';

    public function handle(): void
    {
        $this->info('Dev Setup — credentials will be encrypted and stored securely.');

        $firstName = $this->ask('First name');
        $lastName = $this->ask('Last name');
        $email = $this->ask('Email');
        $password = $this->secret('Password');
        $secretKey = $this->secret('Your secret decryption key (remember this, it is never stored)');

        $credentials = json_encode([
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' => $password,
        ]);

        $encrypted = $this->encrypt($credentials, $secretKey);

        file_put_contents(storage_path('app/.dev'), $encrypted);

        $this->info('✅ Dev credentials encrypted and saved to vendor');
        $this->warn('⚠️  Never forget your secret key - it is not stored anywhere.');
    }

    private function encrypt(string $data, string $key): string
    {
        $key = hash('sha256', $key, true);
        $iv = random_bytes(16);
        $encrypted = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);

        return base64_encode($iv).'||'.$encrypted;
    }

    public static function decrypt(string $data, string $key): ?array
    {
        try {
            $key = hash('sha256', $key, true);
            [$iv, $encrypted] = explode('||', $data, 2);
            $iv = base64_decode($iv);

            $decrypted = openssl_decrypt($encrypted, 'AES-256-CBC', $key, 0, $iv);

            if ($decrypted === false) {
                return null;
            }

            return json_decode($decrypted, true);
        } catch (\Exception $e) {
            return null;
        }
    }
}
