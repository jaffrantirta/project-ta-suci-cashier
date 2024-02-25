<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'buat:owner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::create([
            'name' => 'Owner',
            'email' => 'owner@admin',
            'password' => \Hash::make('password')
        ]);

        $user->assignRole('owner');

        $this->info("Owner sudah dibuat. email nya 'owner@admin' dan password nya 'password'");
    }
}
