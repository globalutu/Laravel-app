<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    protected $signature = 'email:test';
    protected $description = 'Test email sending configuration';

    public function handle()
    {
        try {
            Mail::raw('This is a test email.', function ($message) {
                $message->to('recipient@example.com')
                        ->subject('Test Email');
            });

            $this->info('Test email sent successfully!');
        } catch (\Exception $e) {
            $this->error('Failed to send test email: '.$e->getMessage());
        }
    }
}
