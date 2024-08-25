<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTestEmail extends Command
{
    protected $signature = 'email:test';
    protected $description = 'Send a test email';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Mail::raw('This is a test email', function ($message) {
            $message->to('sivastarchandran@gmail.com')
                    ->subject('Test Email');
        });

        $this->info('Test email sent!');
    }
}
