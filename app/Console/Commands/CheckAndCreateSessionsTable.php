<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CheckAndCreateSessionsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sessions:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and create the sessions table if it does not exist';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!Schema::hasTable('sessions')) {
            $this->info('Sessions table does not exist. Creating it now...');
            
            Schema::create('sessions', function ($table) {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->longText('payload');
                $table->integer('last_activity')->index();
            });
            
            $this->info('Sessions table created successfully.');
        } else {
            $this->info('Sessions table already exists.');
        }
        
        // Check if 'cache' table exists and create it if not
        if (!Schema::hasTable('cache')) {
            $this->info('Cache table does not exist. Creating it now...');
            
            Schema::create('cache', function ($table) {
                $table->string('key')->primary();
                $table->mediumText('value');
                $table->integer('expiration');
            });
            
            $this->info('Cache table created successfully.');
        } else {
            $this->info('Cache table already exists.');
        }
        
        // Check if 'cache_locks' table exists and create it if not
        if (!Schema::hasTable('cache_locks')) {
            $this->info('Cache locks table does not exist. Creating it now...');
            
            Schema::create('cache_locks', function ($table) {
                $table->string('key')->primary();
                $table->string('owner');
                $table->integer('expiration');
            });
            
            $this->info('Cache locks table created successfully.');
        } else {
            $this->info('Cache locks table already exists.');
        }
    }
}
